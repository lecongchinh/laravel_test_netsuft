<?php
namespace App\Repositories\Staffs;

use App\Models\Staff;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffRepository extends EloquentRepository implements StaffRepositoryInterface {
    public function getModel() {
        return Staff::class;
    }

    public function searchDaysWork($fromDay, $toDay)
    {
        $staffs = Staff::leftJoin('tblMStaff2', 'tblMStaff.StaffID', 'tblMStaff2.StaffID')
            ->select("tblMStaff.*", "tblMStaff2.*")
            ->whereRaw("
                CASE 
                WHEN (tblMStaff.QuitJobDate IS NULL or tblMStaff.QuitJobDate > now()) 
                    THEN DATEDIFF(now(), tblMStaff.TrialEntryDate) >= ".$fromDay."
                    AND DATEDIFF(now(), tblMStaff.TrialEntryDate) < ".$toDay."  
                ELSE 
                    DATEDIFF(tblMStaff.QuitJobDate, tblMStaff.TrialEntryDate) >= ".$fromDay." 
                    AND DATEDIFF(tblMStaff.QuitJobDate, tblMStaff.TrialEntryDate) < ".$toDay."
                END;"
            )
            ->get();
            
        return $staffs;
    }
}