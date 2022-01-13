<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Customers;
use App\Models\User;
use App\Models\Bills;
use App\Models\employees;
use App\Models\ActivityLog;
use Helper;
  

class ActivityLogController extends Controller
{
    
    public function index()
    {
        $activityLog=ActivityLog::join('users','users.id','activity_logs.user_id')
        ->select('users.id as user_id','users.name','users.lastname','users.email','users.profile_photo_path as photo','users.username',
        'activity_logs.activity_description','activity_logs.ip_address','activity_logs.user_agent','activity_logs.created_at')
        ->orderBy('activity_logs.created_at','DESC')
        ->get();
        return view('dashboard.activityLog.activityLog',compact('activityLog'));
    }

}
