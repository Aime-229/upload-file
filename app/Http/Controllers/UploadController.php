<?php

namespace App\Http\Controllers;

use App\Imports\UploadImport;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    //
    public function index()
    {  
        return view('welcome', [
        ]);
    }

    public function importFile(Request $request)
    {  
        $request->validate([
            'file' => [ 
                'required',
                'file'
            ],
        ]);

        //dd($request);

        Excel::import(new UploadImport, $request->file('file'));
        
        toastr()->success('Importation réussie', 'Félicitation');
        return redirect()->back();
        
    }

    public function getUploadData($code, $date)
{
    
    $uploadData = Upload::where('increment_upload_file', $code)->first();

    if (!$uploadData) {
        return response()->json(['message' => 'Aucune donnée trouvée pour ce code d\'entreprise'], 404);
    }

    $formattedDate = Carbon::parse($date)->toDateString();

    $uploads = Upload::where('increment_upload_file', $code)
                     ->whereDate('created_at', $formattedDate)
                     ->orderBy('increment_upload_file')
                     ->get(['increment_upload_file as id', 'code_fournisseur', 'Qte', 'code_Article']);

    if ($uploads->isEmpty()) {
        return response()->json(['message' => 'Aucune donnée trouvée pour cette date'], 404);
    }

    return response()->json($uploads);
}



}
