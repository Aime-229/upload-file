<?php

namespace App\Imports;

use App\Models\Upload;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UploadImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //

        $currentIncrement = Upload::max('increment_upload_file') ?? 0;
        //dd($currentIncrement);
        
        foreach ($rows as $row) 
        {
            /* $upload = Upload::where('code_fournisseur', $row['code_fournisseur'])->first();

            if ($upload) {

                $upload->update([
                    'code_fournisseur' => $row['code_fournisseur'],
                    'code_Article' => $row['code_article'],
                    'Qte' => $row['qte'],
                    'code_entreprise' => $row['code_entreprise'],
                ]);
            
            }else{
            } */


            
            Upload::create([
                'code_plpanteur' => $row['Code Planteur'],
                'code_pont' => $row['Code Pont'],
                'prix_apromac' => $row['Prix Apromac'],
                'code_fournisseur' => $row['code_fournisseur'],
                'code_fournisseur' => $row['code_fournisseur'],
                'code_fournisseur' => $row['code_fournisseur'],
                'code_fournisseur' => $row['code_fournisseur'],
                'code_Article' => $row['code_article'],
                'Qte' => $row['qte'],
            'increment_upload_file' => $currentIncrement + 1,
            ]);

            
        }
    }
}
