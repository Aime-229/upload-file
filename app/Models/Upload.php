<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'uploads';

    protected $fillable = [
        'code_planteur',
        'code_pont',
        'prix_apromac',
        'dechargement',
        'charge_transfert',
        'prime',
        'prix_net',
        'datedebut',
        'datefin',
        'increment_upload_file'
    ];
}
