<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class RpbController extends Controller
{
    public function index(){
        $rpbs = DB::table('develop.RPB_REKON')->limit(10)
        ->get();
        return view('welcome', compact('rpbs'));
    }

    public function store(Request $request){
        if ($request->hasFile('upld_deploy')) {
            $file = $request->file('upld_deploy');
            $path = $file->store('uploads');
        
            // Load the Excel file
            $data = Excel::toArray([], $file)[0];
            
            $insertData = []; // Array untuk menyimpan data yang akan diinsert
        
            foreach ($data as $key => $input) {
                if ($key == 0) {
                    // Skip the header row
                    continue;
                }
        
                // Extract the data
                $id_ihld        = $input[0];
                $program        = $input[1];
                $nilai_realisai = $input[2];
                $tahun          = $input[3];
                $ketmitra       = $input[4];
                $project_desc   = $input[5];
                $bulan          = $input[6];
                $project_status = $input[7];
                $teritory       = $input[8];
                $status_so      = $input[9];
                $area           = $input[10];
        
                // Check for existing record based on the conditions
                $exists = DB::table('develop.RPB_REKON')
                    ->where(function ($query) use ($id_ihld, $project_desc) {
                        if (!is_null($id_ihld)) {
                            $query->where('ID_IHLD', $id_ihld);
                        } else {
                            $query->whereNull('ID_IHLD')
                                  ->where('PROJECT_DESC', $project_desc);
                        }
                    })
                    ->exists();
        
                // If the record does not exist, prepare the data for insertion
                if (!$exists) {
                    $insertData[] = [
                        'ID_IHLD'        => $id_ihld,
                        'PROGRAM'        => $program,
                        'NILAI_REALISASI' => $nilai_realisai,
                        'TAHUN'          => $tahun,
                        'KET_MITRA'      => $ketmitra,
                        'PROJECT_DESC'   => $project_desc,
                        'BULAN'          => $bulan,
                        'PROJECT_STATUS' => $project_status,
                        'TERITORY'       => $teritory,
                        'STATUS_SO'      => $status_so,
                        'AREA'           => $area,
                    ];
                }
            }
            
            // Perform bulk insert if there is data to insert
            if (!empty($insertData)) {
                DB::table('develop.RPB_REKON')->insert($insertData);
            }
        
            Storage::delete($path);
            dump($insertData);
            return redirect()->route('rpb.index')->with('success', 'Upload Pengajuan Sukses!');
        } else {
            return redirect()->route('rpb.index')->with('error', 'Upload Pengajuan Gagal!');
        }
        
}

}
