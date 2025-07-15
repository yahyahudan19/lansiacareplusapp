<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LogController extends Controller
{
    public function index()
    {
        return view('admin.logs');
    } 
    
    
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $logs = Log::select(['id', 'user_id', 'username', 'email', 'activity', 'details', 'category', 'created_at'])
            ->orderBy('created_at', 'desc');
            return datatables()->of($logs)
            ->addColumn('formatted_created_at', function ($log) {
                return $log->formatted_created_at;
            })
            ->rawColumns(['formatted_created_at'])
            ->make(true);
        }
    }
  
}
