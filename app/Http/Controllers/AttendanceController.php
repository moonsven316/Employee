<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attends;

use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function attendance(Request $request)
    {
        $user_id = Auth::user()->id;
        $attend = Attends::where('user_id', $user_id)->where("year", date("Y"))->where("month", date('m'))->first();
                // dd($attend);


        $current_date ="a".date("d");
        $currentTime = date('H:i');

        if($request->param == 1){
            $schedule_date = "s".date("d");
            if ($attend[$current_date] == "") {
                $attend[$current_date] = json_decode($attend[$schedule_date]);
            }else {
                $attend[$current_date] = json_decode($attend[$current_date]);
            }
            $attend[$current_date]->ot = $currentTime;
            $attend[$current_date] = json_encode($attend[$current_date]);
            $attend->save();
            return $currentTime;

        } elseif ($request->param == 2) {

            $attend[$current_date] = json_decode($attend[$current_date]);
            $attend[$current_date]->ct = $currentTime;
            $attend[$current_date] = json_encode($attend[$current_date]);
            $attend->save();
            return $currentTime;

        } elseif ($request->param == 3) {

            $attend[$current_date] = json_decode($attend[$current_date]);
            $attend[$current_date]->rs = $currentTime;
            $attend[$current_date] = json_encode($attend[$current_date]);
            $attend->save();
            return $currentTime;

        } else {

            $attend[$current_date] = json_decode($attend[$current_date]);
            $attend[$current_date]->re = $currentTime;
            $attend[$current_date] = json_encode($attend[$current_date]);
            $attend->save();
            return $currentTime;

        }
    }
}
