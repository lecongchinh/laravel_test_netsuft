<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'tblMStaff';
    protected $primaryKey = 'StaffID';
    public $incrementing = false;
    // protected $keyType = 'string';

    protected $fillable = [
        'StaffID', 
        'StaffName', 
        'JapaneseName', 
        'TrialEntryDate', 
        'TrialEndDate', 
        'QuitJobDate', 
        'DateUpdated'
    ];

    public function staff2() {
        return $this->hasOne(Staff2::class, 'StaffID', 'StaffID');
    }
}
