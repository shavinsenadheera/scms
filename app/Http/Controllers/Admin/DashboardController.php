<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Employee;
use App\Models\Admin\Error;
use App\Models\Admin\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $title = "Dashboard";

    public function index()
    {
        try
        {
            $usersCount = User::all()->count();
            $employeeCount = Employee::all()->count();
            $onlineUsers = User::where('is_online','=',1)->count();
            $errorCount = Error::all()->count();

            $ordersDateTotal = Order::selectRaw('order_date,count(*) as totalCount')
                                    ->groupBy('order_date')
                                    ->get();

            $jobsCustomerTotal = Order::selectRaw('customer_id,count(*) as totalCount')
                                       ->groupBy('customer_id')
                                       ->get();

            $delayedOrderCount = Order::whereDate('delivery_date','<',now()->toDate())
                                        ->count();

            $finishedJobs = Order::where('current_status_id','=',6)
                                 ->count();

            $myJobs = Order::selectRaw('customer_id,count(*) as totalCount')
                           ->groupBy('customer_id')
                           ->where('taken_by', '=', Auth::id())
                           ->get();

            $myJobsCount = Order::where('taken_by','=', Auth::id())
                                ->count();

            $myProJobsCount = Order::where('taken_by','=',Auth::id())
                            ->where('current_status_id','<',6)
                            ->count();

            $myFinJobsCount = Order::where('taken_by','=',Auth::id())
                              ->where('current_status_id','=',6)
                              ->count();

            $totalJobCount = Order::all()->count();

            $takenJobCount = Order::where('taken_by','!=', null)
                                  ->count();

            $customerIds = array();
            $totalCount = array();
            foreach($myJobs as $data){
                array_push($customerIds, $data->customer->name);
                array_push($totalCount, $data->totalCount);
            }

            $dateTotalCount = array();
            $dateOrders = array();
            foreach($ordersDateTotal as $data){
                array_push($dateTotalCount, $data->totalCount);
                array_push($dateOrders, $data->order_date);
            }

            $mCustomerIds = array();
            $mTotalCount = array();
            foreach($jobsCustomerTotal as $data){
                array_push($mCustomerIds, $data->customer->name);
                array_push($mTotalCount, $data->totalCount);
            }

            $params = [
                'myJobsCount'       => $myJobsCount,
                'myJobs'            => $myJobs,
                'customerIds'       => $customerIds,
                'totalCount'        => $totalCount,
                'title'             => $this->title,
                'myProJobsCount'    => $myProJobsCount,
                'myFinJobsCount'    => $myFinJobsCount,
                'totalJobCount'     => $totalJobCount,
                'takenJobCount'     => $takenJobCount,
                'dateTotalCount'    => $dateTotalCount,
                'dateOrders'        => $dateOrders,
                'mCustomerIds'      => $mCustomerIds,
                'mTotalCount'       => $mTotalCount,
                'finishedJobs'      => $finishedJobs,
                'delayedOrderCount' => $delayedOrderCount,
                'usersCount'        => $usersCount,
                'employeeCount'     => $employeeCount,
                'onlineUsers'       => $onlineUsers,
                'errorCount'        => $errorCount,
            ];

            return view('dashboard.index')->with($params);
        }
        catch(ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    public function myjobs()
    {
        try
        {
            $myProJobs = Order::where('taken_by', '=', Auth::id())
                ->where('current_status_id', '<', 6)
                ->get();

            $myFinJobs = Order::where('taken_by', '=', Auth::id())
                ->where('current_status_id', '=', 6)
                ->get();

            $params = [
                'myProJobs' => $myProJobs,
                'myFinJobs' => $myFinJobs,
            ];
            return view('dashboard.pages.myjobs')->with($params);
        }
        catch (ModelNotFoundException $exception)
        {
            if($exception instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
