<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff2 extends Model
{
    protected $table = 'tblMStaff2';
    protected $primaryKey = 'StaffID';
    public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'StaffID',
        'Email',
        'Gender',
        'Hometown',
        'MarialStatus',
        'KeyCard',
        'DateUpdated'
    ];
}
