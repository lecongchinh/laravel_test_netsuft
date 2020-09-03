<?php

namespace App\Http\Controllers;

use App\Http\Requests\Staffs\SearchDayWorkRequest;
use App\Jobs\SendEmailJob;
use App\Mail\SearchStaff;
use App\Models\Staff;
use App\Repositories\Staffs\StaffRepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class StaffController extends Controller
{
    protected $staffRepository;

    public function __construct(StaffRepositoryInterface $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }
    public function index(SearchDayWorkRequest $request) {
        try {
            $staff = null;
            $dataRequest = null;
            if($request->from_day) {
                $dataRequest = $request->all();
                $staffs = $this->staffRepository->searchDaysWork($request->from_day, $request->to_day);
                if($staffs && !$request->page) {
                    $email = $request->email;
                    dispatch(new SendEmailJob($email, $staffs));
                    // Mail::to($request->email)->send(new SearchStaff($staffs));
                }
                $request->page ? ($cur = $request->page) : ($cur = 1);
                $current = $staffs->slice(($cur - 1) * 10, 10)->all();
                $staffs = new LengthAwarePaginator($current, count($staffs), 10, $cur, ['path' => 'staffs']);
            }
        if($request->page) {
            return view('staffs', compact('staffs', 'dataRequest'));
        }

        return view('staffs', compact('staffs', 'dataRequest'))->with('successMessage', 'Success !');
        } catch(Exception $e) {
            $dataRequest = $request->all();
            if($request->page) {
                return view('staffs');
            }

            return view('staffs', compact('dataRequest'))->with('errorMessage', 'Error !');
        }
    }

}
