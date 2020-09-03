<?php
namespace App\Repositories\Staffs;

interface StaffRepositoryInterface
{
    public function searchDaysWork($fromDay, $toDay);
}