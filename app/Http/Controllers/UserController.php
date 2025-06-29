<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    // View & Update User Management
    public function index(){

        $data_user = User::get()->all();
        $data_puskesmas = Puskesmas::all();
        return view('admin.users',compact('data_user','data_puskesmas'));
    }

    public function index_puskesmas(){

        $data_user = User::where('puskesmas_id',auth()->user()->puskesmas_id)->get()->all();
        return view('puskesmas.users',compact('data_user'));
    }

    public function detail_view($id){

        $data_user = User::where('id',$id)->get()->first();
        $data_puskesmas = Puskesmas::all();

        return view('admin.users_details',compact('data_user','data_puskesmas'));

    }

    public function detail_view_puskesmas($id){

        $data_user = User::where('id',$id)->get()->first();
        return view('puskesmas.users_details',compact('data_user'));

    }
    
    // Store User 
    public function store(Request $request){

        // dd($request->all());
        
        // Cek apakah username sudah ada di tabel users
        $usernameExists = User::where('username', $request->user_username)->exists();

        if ($usernameExists) {
            // Jika username sudah ada, tampilkan pesan warning
            session()->flash('status', 'warning');
            session()->flash('message', 'User sudah ada, silakan buat user lain.');
            return redirect()->back()->withInput();  // Kembalikan input sebelumnya
        }
        // Simpan user baru ke database

        try {
            $user = User::create([
                'name' => $request->user_name,
                'username' => $request->user_username,
                'email' => $request->user_username.'@lansiacare.id',
                'role' => $request->user_role,
                'status' => 'Pending',
                'puskesmas_id' => $request->puskesmas_id,
                'password' => Hash::make($request->user_password),
            ]);

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'create',
                'activity' => 'create',
                'details' => 'Menambahkan user baru dengan ID: ' . $user->id,
            ]);

            session()->flash('status', 'success');
            session()->flash('message', 'User berhasil disimpan!');

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', 'Terjadi kesalahan saat menyimpan user.'. $e->getMessage());
        }

        return redirect()->back();

    }
    

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Cek apakah user memiliki relasi dengan tabel lain, 
            // if ($user->kunjungans()->count() > 0) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'User tidak bisa dihapus karena masih memiliki kunjungan terkait.'
            //     ]);
            // }

            $user->delete();

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'delete',
                'activity' => 'delete',
                'details' => 'Menghapus user dengan ID: ' . $user->id,
            ]);

            return response()->json([
                'status' => 'success', 
                'success' => true,
                'message' => 'User berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan saat menghapus user.'
            ], 500);
        }
    }


    public function update_profile(Request $request){
        // dd($request->all());
        try {
            // Dapatkan user 
            $user = User::findOrFail($request->id);
            // Update user data
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'puskesmas_id' => $request->puskesmas_id,
            ]);

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'update',
                'activity' => 'update',
                'details' => 'Memperbarui profil user dengan ID: ' . $user->id,
            ]);

            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Profile berhasil diperbarui!');

        } catch (\Exception $e) {
            // Kirim pesan error jika ada masalah
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat memperbarui profile.'. $e->getMessage());
        }
    }
    public function update_email(Request $request){
        // dd($request->all());
        try {
            // Dapatkan user 
            $user = User::findOrFail($request->id);
            // Update user data
            $user->update([
                'email' => $request->email,
            ]);

            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Email berhasil diperbarui!');

        } catch (\Exception $e) {
            // Kirim pesan error jika ada masalah
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat memperbarui Email.'. $e->getMessage());
        }
    }

    public function update_password(Request $request){
        // dd($request->all());
        try {
            // Dapatkan user 
            $user = User::findOrFail($request->id);

            // Cek current password
            if (!Hash::check($request->current_password, $user->password)) {
                // Kirim pesan error
                return redirect()->back()
                ->with('status', 'error')
                ->with('message', 'Password Lama Tidak Sesuai !');
            }

            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Password berhasil diperbarui!');

        } catch (\Exception $e) {
            // Kirim pesan error jika ada masalah
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat memperbarui Password.'. $e->getMessage());
        }
    }

    public function update_role(Request $request){
        // dd($request->all());
        try {
            // Dapatkan user 
            $user = User::findOrFail($request->id);
            // Update user data
            $user->update([
                'role' => $request->user_role,
            ]);

            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Role berhasil diperbarui!');

        } catch (\Exception $e) {
            // Kirim pesan error jika ada masalah
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat memperbarui Role.'. $e->getMessage());
        }
    }


}
