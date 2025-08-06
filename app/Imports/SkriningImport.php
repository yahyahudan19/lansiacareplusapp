<?php

namespace App\Imports;

use App\Models\Persons;
use App\Models\Kunjungans;
use App\Models\Skrinings;
use App\Models\Kelurahans;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SkriningImport implements ToCollection, WithHeadingRow
{
    protected $success = 0;
    protected $failed = 0;

    public function collection(Collection $rows)
    {
        DB::beginTransaction();
        try {
            foreach ($rows as $row) {
                try {
                    // Cek kelurahan
                    $kelurahan = Kelurahans::where('nama', trim($row['kelurahan']))->first();
                    if (!$kelurahan) {
                        Log::warning('Kelurahan tidak ditemukan: ' . $row['kelurahan']);
                        continue;
                    }

                    // Cek atau buat data persons
                    $person = Persons::firstOrCreate(
                        ['nik' => $row['nik']],
                        [
                            'nama' => $row['namalengkap'],
                            'telp' => $row['notelphp'] ?? null,
                            'tanggal_lahir' => $row['tgllahir'],
                            'bpjs' => $row['nobpjs'] ?? null,
                            'alamat' => $row['alamat'],
                            'rt' => $row['rt'] ?? null,
                            'rw' => $row['rw'] ?? null,
                            'status' => $row['status'],
                            'valid' => 'Y',
                            'notifikasi' => 'N',
                            'tempat_periksa' => $row['tempatperiksa'] ?? null,
                            'created_by' => Auth::id() ?? 1,
                            'kelurahan_id' => $kelurahan->id,
                            'jenis_kelamin' => $row['jeniskelamin'],
                        ]
                    );

                    $kunjungan = Kunjungans::create([
                        'tinggi_bdn' => $row['tinggibadan'],
                        'berat_bdn' => $row['beratbadan'],
                        'lingkar_prt' => $row['lingkarperut'] ?? null,
                        'sistole' => $row['sistole'] ?? null,
                        'diastole' => $row['diastole'] ?? null,
                        'gula_drh' => $row['guladarah'] ?? null,
                        'kolesterol' => $row['kolesterol'] ?? null,
                        'asam_urat' => $row['asamurat'] ?? null,
                        'person_id' => $person->id,
                        'tanggal_kj' => $row['timestamp'],
                        'created_by' => Auth::id() ?? 1,
                    ]);

                    Skrinings::create([
                        'ginjal' => $row['ginjal'] ?? 'N',
                        'penglihatan' => $row['gangguanpenglihatan'] ?? 'N',
                        'pendengaran' => $row['gangguanpendengaran'] ?? 'N',
                        'merokok' => $row['merokok'] ?? 'N',
                        'adl' => $row['adl'] ?? null,
                        'gds' => $row['gds'] ?? null,
                        'kognitif' => $row['kognitif'] ?? null,
                        'mobilisasi' => $row['mobilisasi'] ?? null,
                        'malnutrisi' => $row['malnutrisi'] ?? null,
                        'depresi' => $row['depresi'] ?? null,
                        'keterangan' => $row['keterangan'] ?? null,
                        'kunjungan_id' => $kunjungan->id,
                    ]);

                     $this->success++;

                } catch (\Throwable $e) {
                    $this->failed++;
                    Log::error('Error saat import baris: ' . json_encode($row) . ' | ' . $e->getMessage());
                    continue; // skip baris error
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error('Gagal import skrining: ' . $e->getMessage());
        }
    }

    public function getSuccessCount()
    {
        return $this->success;
    }

    public function getFailedCount()
    {
        return $this->failed;
    }

}
