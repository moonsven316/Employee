<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\Company;
use App\Models\Department;
use App\Models\Metaitem;
use App\Models\Sheets;
use App\Models\Attends;
use App\Models\Subdepartment;
use App\Models\Departhistory;
use App\Models\Userhistory;
use App\Models\Worktime;
use App\Models\Job;
use App\Models\JobHistory;
use App\Models\SalaryHistory;
use App\Models\Salary;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class CompanyController extends Controller
{ 

	public function working_time_set() {
		$company_id = Auth::user()->company_id;
		$time = Worktime::where('company_id', $company_id)->first();
		// dd($time);
		return view('company.working_time_set', compact('time'));
	}

	public function working_time_set_save(Request $request) {
		// dd($request);
		if (isset($request->time_id)) {
			$worktime = Worktime::find($request->time_id);
		}
		else {
			$worktime = new Worktime;
		}
		$worktime->first_day = $request->first_day;
		$worktime->second_day = $request->second_day;
		$worktime->third_day = $request->third_day;
		$worktime->fourth_day = $request->fourth_day;
		$worktime->save();

		return redirect()->route('company.staff_add');
	}

	public function staff_list() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
        $staffs = User::where('company_id', $company->id)
							->where('role', 2)
							->get();
		$day = date('d');
		$numberOfDays = date('t');
		$leave_data = [];
		foreach($staffs as $staff) {
			$attends = Attends::where('user_id', $staff->id)->where('year', date('Y'))->where('month', date('m'))->first();
			for ($i=1; $i < $numberOfDays; $i++) { 
				if ($day == $i) {
					if (isset($attends["s".$day])) {
						$a_data = json_decode($attends["s".$day]);
						if(isset($a_data)){
							$sheet = Sheets::find($a_data->sh);
							if (isset($sheet)) {
								if($sheet->rest_day == 0){
									array_push($leave_data, $attends->user_id);
									$leaveStaff = User::find($attends->user_id);
									if($leaveStaff->status != "2") {
										$leaveStaff->status = "1";
										$leaveStaff->save();
									}
								} else {
									$leaveStaff = User::find($attends->user_id);
									if($leaveStaff->status != "2") {
										$leaveStaff->status = "0";
										$leaveStaff->save();
									}
								}
							}
						}
					}
				}
			}
		}
		$staff_leave = User::whereIn('id', $leave_data)
							->where('company_id', $company->id)
							->where('role', 2)
							->where('status', '1')
							->where('status', '<>' ,'0')
							->where('status', '<>' ,'3')
							->get();

		$staff_working = User::where('company_id', $company->id)
							->where('role', 2)
							->where('status', '0')
							->where('status', '<>', '1')
							->where('status', '<>', '2')
							->get();
        $staff_retired = User::where('company_id', $company->id)
							->where('role', 2)
							->where('status', '2')
							->where('status', '<>', '0')
							->where('status', '<>', '1')
							->get();

		$departments = Department::where('company_id', $user->company_id)->get();

		$company_avart = "";
		$metaitem = Material::where('user_id', $user->id)->get();	
		if(count($metaitem) > 0){
			$company_avart = $metaitem[0]["dt1"];
		}
		if(count($staff_working) > 0 || count($staff_leave) > 0 || count($staff_retired)){
			return view('company.staff_list',  ['user' => $user, 'company' => $company, 'staff_working'=>$staff_working, 'staff_leave'=>$staff_leave, 'staff_retired'=>$staff_retired, 'departments'=>$departments, 'company_avart'=>$company_avart]);
		}else{
			return redirect()->route('company.staff_add');
		}

	}

	public function staff_history(Request $request) {
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
        $staffs = User::where('company_id', $company->id)
                // ->where('id', '!=', $user->id)
				->where('role', 2)
                ->get();
		if (isset($request->staff_id)) {
			$staff_id = $request->staff_id;
			$history = Userhistory::where('staff_id', $staff_id)->get();
			return view('company.staff_history', compact('staffs', 'history', 'staff_id'));
		}
		return view('company.staff_history', compact('staffs'));
	}

	public function staff_retirement(Request $request)
	{
		$user = User::find($request->staff_id);
		$user->status = "2";
		if($user->save()){
			return "ok";
		}
	}
	public function staff_returnwork(Request $request)
	{
		$user = User::find($request->staff_id);
		$user->status = "0";
		if($user->save()){
			return "ok";
		}
	}

	public function staff_detail(Request $request)
	{
		$staff = User::find($request->id);
		$metaitem = Metaitem::where('company_id', $staff->company_id)->get();
		$departments = Department::where('company_id', $staff->company_id)->get();
		$sub_department = Subdepartment::where('depart_id', $staff->depart_id)->get();
		$worktime = Worktime::where('company_id', $staff->company_id)->first();
		$salary = Salary::where('staff_id', $request->id)->first();
		$salary_history = SalaryHistory::where('staff_id', $request->id)->get();
		$staff_history = JobHistory::where('staff_id', $request->id)->get();
		$today = date("Y");
		$birthday = explode("-", $staff->birthday);
		$age = $today - $birthday[0];
		$created_at = explode("-", explode(" ", $staff->created_at)[0])[0];
		$year_service = $today - $created_at;
		return view('company.staff_detail', compact('staff', 'metaitem', 'departments', 'sub_department', 'worktime', 'age', 'salary', 'salary_history', 'staff_history', 'year_service'));
	}
	public function staff_edit(Request $request)
	{
		$staff = User::find($request->id);
		$metaitem = Metaitem::where('company_id', $staff->company_id)->get();
		$departments = Department::where('company_id', $staff->company_id)->get();
		$sub_department = Subdepartment::where('depart_id', $staff->depart_id)->get();
		$worktime = Worktime::where('company_id', $staff->company_id)->first();
		$job = Job::where('company_id', $staff->company_id)->get();
		$salary = Salary::where('staff_id', $request->id)->first();
		return view('company.staff_edit', compact('staff', 'metaitem', 'departments', 'sub_department', 'worktime', 'job', 'salary'));
	}

	public function staff_edit_save(Request $request)
	{
		Validator::make($request->all(), [
			'email' => 'required',
			'name' => 'required|string|max:255',
			'user_name' => 'required|string|max:255',
			'user_name_g' => 'required|string|max:255',
			'zip1' => 'required',
			'zip2' => 'required',
			'pref' => 'required|string|max:255',
			'addr' => 'required|string|max:255',
			'str' => 'required|string|max:255',
			'country' => 'required|string|max:255',
			'birthday' => 'required|date',
		])->validate();
		$staff = User::find($request->staff_id);
		if ($staff->depart_id != $request->depart_id || $staff->sub_depart_id != $request->sub_depart_id || $staff->job_id != $request->job_id) {
			$staff_history = new JobHistory;
			$staff_history->staff_id = $staff->id;
			$staff_history->job_history = $request->job_id;
			$staff_history->depart_history = $request->depart_id.":".$request->sub_depart_id;
			$staff_history->save();
		}
		$staff->email = $request->email;
		$staff->name = $request->name;
		$staff->depart_id = $request->depart_id;
		$staff->sub_depart_id = $request->sub_depart_id;
		$staff->user_name = $request->user_name;
		$staff->user_name_g = $request->user_name_g;
		$staff->zip1 = $request->zip1;
		$staff->zip2 = $request->zip2;
		$staff->pref = $request->pref;
		$staff->addr = $request->addr;
		$staff->str = $request->str;
		$staff->country = $request->country;
		$staff->phone = $request->phone;
		$staff->gender = $request->gender;
		$staff->birthday = $request->birthday;
		$staff->social_num = $request->social_num;
		$staff->employ_num = $request->employ_num;
		$staff->metaitem = $request->meta;
		$staff->avatar = $request->avatar;
		$staff->total_work_time = $request->total_work_time;
		$staff->salary_date = $request->salary_date;
		$staff->idm = $request->idm;
		$staff->job_id = $request->job_id;
		if ($staff->save()) {
			if($request->salary_id == 0){

				$salary = new Salary;
				$salary->staff_id = $request->staff_id;
				$salary->hourly_wage = $request->hourly_wage;
				$salary->basic_allowance = $request->basic_allowance;
				$salary->business_allowance = $request->business_allowance;
				$salary->position_allowance = $request->position_allowance;
				$salary->technical_allowance = $request->technical_allowance;
				$salary->adjustment_allowance = $request->adjustment_allowance;
				$add_item = [];
				for ($i = 1; $request["item_label_$i"] !== null; $i++) {
					$add_item[$request["item_label_$i"]] = $request["item_content_$i"];
				}
				$salary->add_item = json_encode($add_item);
				$salary->save();

			} else {
				$salary = Salary::find($request->salary_id);
				$salary_data = [
					'hourly_wage' => $request->hourly_wage,
					'basic_allowance' => $request->basic_allowance,
					'business_allowance' => $request->business_allowance,
					'position_allowance' => $request->position_allowance,
					'technical_allowance' => $request->technical_allowance,
					'adjustment_allowance' => $request->adjustment_allowance
				];
				$add_item = [];
				for ($i = 1; $request["item_label_$i"] !== null; $i++) {
					$add_item[$request["item_label_$i"]] = $request["item_content_$i"];
				}
				for ($i = 1; $request["update_item_label_$i"] !== null; $i++) {
					
					$add_item[$request["update_item_label_$i"]] = $request["update_item_content_$i"];
				}
 				$salary_data['add_item'] = json_encode($add_item);
				$updateSalary = false;
				foreach ($salary_data as $key => $value) {
					if ($salary->$key != $value) {
						$updateSalary = true;
						break;
					}
 				}
				if ($updateSalary) {
					$salary->fill($salary_data);
					if($salary->save()){
						$salary_history = new SalaryHistory;
						$salary_history->staff_id = $request->staff_id;
						$salary_history->fill($salary_data);
						$salary_history->save();
					}
				}
			}
		}
		return redirect()->route('company.staff_list');
	}

	public function staff_delete(Request $request)
	{
		$staff = User::find($request->id);
		$staff->delete();
		return redirect()->route('company.staff_list');
	}

	public function metaitem_list() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();

		$metaitems = Metaitem::where('company_id', $company->id)->get();		

		$company_avart = "";
		$mat = Material::where('user_id', $user->id)->get();	
		if(count($mat) > 0){
			$company_avart = $mat[0]["dt1"];
		}

		$company = Company::where('user_id', $user->id)->first();
		return view('company.metaitem_list',  ['user' => $user, 'metaitems' => $metaitems,  'company' => $company, 'company_avart'=>$company_avart]);

	}


	public function sheet_list() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();

		$Sheets = Sheets::where('company_id', $company->id)->get();	

		$company_avart = "";
		$mat = Material::where('user_id', $user->id)->get();	
		if(count($mat) > 0){
			$company_avart = $mat[0]["dt1"];
		}


		return view('company.sheet_list',  ['user' => $user, 'sheets' => $Sheets,  'company' => $company, 'company_avart'=>$company_avart]);

	}

	public function pay_list(){
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();

		$Sheets = Sheets::where('company_id', $company->id)->get();	

		$company_avart = "";
		$mat = Material::where('user_id', $user->id)->get();	
		if(count($mat) > 0){
			$company_avart = $mat[0]["dt1"];
		}


		return view('company.pay_list',  ['user' => $user, 'sheets' => $Sheets,  'company' => $company, 'company_avart'=>$company_avart]);
	}

	public function pay_add(Request $request){
		
		$headers = array(
			'Authorization: Bearer sk_test_51HrJWSBJYbvSwe7r4iCSISToafZ6CJcq6PBvpLfC8PiA6BXTO6dgjk9YU89CWS80ZiSSBeJYq3jGr0hdoozAPxza009fgzUjOr',
		);
		
		// create curl resource 
		$ch = curl_init(); 		
		// set url 
		curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges -u sk_test_51HrJWSBJYbvSwe7r4iCSISToafZ6CJcq6PBvpLfC8PiA6BXTO6dgjk9YU89CWS80ZiSSBeJYq3jGr0hdoozAPxza009fgzUjOr: -d source[object]=card -d source[number]=4242424242424242  -d source[exp_month]=12 -d source[exp_year]=2024 -d source[cvc]=123 -d amount=1000 -d currency=jpy -d description=test "); 

		// set headers
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		// $output contains the output string 
		$output = curl_exec($ch); 
		echo "Ok";

		print($output);

		// close curl resource to free up system resources 
		curl_close($ch);

		echo "Ok";

	}

	public function attend_sheet_set(Request $request){
		$year = explode("-", $request->sd)[0];
		$sd_month = explode("-", $request->sd)[1];
		$sd = explode("-", $request->sd)[2];

		$ed_month = explode("-", $request->ed)[1];
		$ed = explode("-", $request->ed)[2];

		if ($sd_month == $ed_month) {
			foreach($request->staff as $staff){
				$attend = Attends::where('user_id', $staff)->where("year", $year)->where("month", $sd_month)->first();
				$user = User::find($staff);
				if(isset($attend)){
					$sheets = Sheets::find($request->sheet);
					for($d = $sd*1 ; $d < $ed*1 + 1; $d++){
						$s = $attend->{"s".$d};
						$sheet_info = [];		
						if($s == ""){
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend->{"s".$d} = $sheet_info;
							// dd($attend[0]["s".$d]);
							// if($sheets->rest_day == 0){
							// 	$attend[0]["a".$d] = 1;							
							// }else{
							// 	$attend[0]["a".$d] = 0;
							// }
						} else {
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day;
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend->{"s".$d} = $sheet_info;
							// if($sheets->rest_day == 0){
							// 	$attend[0]["a".$d] = 1;							
							// }else{
							// 	$attend[0]["a".$d] = 0;
							// }
						}
						// $a = $attend[0]["a".$d];
						// $current_info = json_decode($a);
						// $schedule_info = json_decode($s);
						// if ($current_info == Null) {
						// 	# code...
						// } else {
						// 	dd($current_info->ot, $schedule_info->ot);
						// 	// if($current_info->ot != ""){
						// 	// 	$ot = explode(":", $current_info->ot);
						// 	// 	$ct = explode(":", $current_info->ct);
						// 	// 	if(count($ot) > 1){
						// 	// 		if(is_numeric(($ot[0].$ot[1]) * 1)){
						// 	// 			$open = explode(":", $sheets->open_time);
						// 	// 			if(count($open) > 1){
						// 	// 				if(is_numeric(($open[0].$open[1]) * 1)){
						// 	// 					if(($ot[0].$ot[1]) * 1 > ($open[0].$open[1]) * 1){
						// 	// 						$attend[0]["a".$d] = 3; //遅刻
						// 	// 						$close = explode(":", $sheets->close_time);
						// 	// 						if(count($close) > 1){
						// 	// 							if(is_numeric(($close[0].$close[1]) * 1)){
						// 	// 								if(($ot[0].$ot[1]) * 1 > ($close[0].$close[1]) * 1){
						// 	// 									$attend[0]["a".$d] = 5; //欠勤
						// 	// 								}
						// 	// 							}
						// 	// 						}
						// 	// 					}else{
						// 	// 						$attend[0]["a".$d] = 2; //出勤
						// 	// 						$close = explode(":", $sheets->close_time);
						// 	// 						if(count($close) > 1){
						// 	// 							if(is_numeric(($close[0].$close[1]) * 1)){
						// 	// 								if(count($ct) > 0){
						// 	// 									if(is_numeric(($ct[0].$ct[1]) * 1)){
						// 	// 										if(($ct[0].$ct[1]) * 1 < ($close[0].$close[1]) * 1){
						// 	// 											$attend[0]["a".$d] = 4; //早退
						// 	// 										}
						// 	// 									}
						// 	// 								}
						// 	// 							}
						// 	// 						}
						// 	// 					}
						// 	// 				}else{
						// 	// 					$attend[0]["a".$d] = 0;
						// 	// 				}
						// 	// 			}else{
						// 	// 				$attend[0]["a".$d] = 0;
						// 	// 			}
						// 	// 		}else{
						// 	// 			$attend[0]["a".$d] = 0;
						// 	// 		}
						// 	// 	}else{
						// 	// 		$attend[0]["a".$d] = 0;
						// 	// 	}
						// 	// }else{
						// 	// 	$attend[0]["a".$d] = 0;
						// 	// }
						// }
					}
					$attend->save();
				} else {
					$sheets = Sheets::find($request->sheet);
					$att = new Attends;
					$att->user_id = $staff;
					$att->company_id = $user->company_id;
					$att->depart_id = $user->depart_id;
					$att->user_name = $user->user_name;
					for ($d = $sd*1 ; $d < $ed*1 + 1; $d++) { 
						$s = $att->{"s".$d};
						$sheet_info = [];
						$sheet_info["sh"] = $sheets->id;
						$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
						if (isset($sheets->open_time)) {
							$sheet_info["ot"] = $sheets->open_time; //open time
						} else {
							$sheet_info["ot"] = ""; //open time
						}
						if (isset($sheets->close_time)) {
							$sheet_info["ct"] = $sheets->close_time; //close time
						} else {
							$sheet_info["ct"] = ""; //close time
						}
						if(isset($sheets->rest_time)){
							$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
							$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
						} else {
							$sheet_info["rs"] = ""; //rest start time
							$sheet_info["re"] = ""; //rest end time
						}
						$att->{"s".$d} = json_encode ($sheet_info);
					}
					$att->a1 = '';
					$att->a2 = '';
					$att->a3 = '';
					$att->a4 = '';
					$att->a5 = '';
					$att->a6 = '';
					$att->a7 = '';
					$att->a8 = '';
					$att->a9 = '';
					$att->a10 = '';
					$att->a11 = '';
					$att->a12 = '';
					$att->a13 = '';
					$att->a14 = '';
					$att->a15 = '';
					$att->a16 = '';
					$att->a17 = '';
					$att->a18 = '';
					$att->a19 = '';
					$att->a20 = '';
					$att->a21 = '';
					$att->a22 = '';
					$att->a23 = '';
					$att->a24 = '';
					$att->a25 = '';
					$att->a26 = '';
					$att->a27 = '';
					$att->a28 = '';
					$att->a29 = '';
					$att->a30 = '';
					$att->a31 = '';
					$att->year = $year;
					$att->month = $sd_month;
					$att->save();
				}
			}
		} else {
			foreach($request->staff as $staff){
				$attend_1 = Attends::where('user_id', $staff)->where("year", $year)->where("month", $sd_month)->first();
				$attend_2 = Attends::where('user_id', $staff)->where("year", $year)->where("month", $ed_month)->first();
				$user = User::find($staff);
				if (isset($attend_1)) {
					$sheets = Sheets::find($request->sheet);
					for($d = $sd*1 ; $d < 31 + 1; $d++){
						$s = $attend_1->{"s".$d};
						$sheet_info = [];		
						if($s == ""){
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend_1->{"s".$d} = $sheet_info;
						} else {
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day;
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend_1->{"s".$d} = $sheet_info;
						}
					}
					$attend_1->save();
				} else {
					$sheets = Sheets::find($request->sheet);
					// dd($sheets);
					$att = new Attends;
					$att->user_id = $staff;
					$att->company_id = $user->company_id;
					$att->depart_id = $user->depart_id;
					$att->user_name = $user->user_name;
					// $number = cal_days_in_month(CAL_GREGORIAN, $sd * 1, $year * 1);
					// dd($number);
					for ($d = $sd*1 ; $d < 31 + 1; $d++) { 
						$s = $att->{"s".$d};
						$sheet_info = [];
						$sheet_info["sh"] = $sheets->id;
						$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
						if (isset($sheets->open_time)) {
							$sheet_info["ot"] = $sheets->open_time; //open time
						} else {
							$sheet_info["ot"] = ""; //open time
						}
						if (isset($sheets->close_time)) {
							$sheet_info["ct"] = $sheets->close_time; //close time
						} else {
							$sheet_info["ct"] = ""; //close time
						}
						if(isset($sheets->rest_time)){
							$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
							$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
						} else {
							$sheet_info["rs"] = ""; //rest start time
							$sheet_info["re"] = ""; //rest end time
						}
						// dd($sheet_info);
						$att->{"s".$d} = json_encode ($sheet_info);
					}
					$att->a1 = '';
					$att->a2 = '';
					$att->a3 = '';
					$att->a4 = '';
					$att->a5 = '';
					$att->a6 = '';
					$att->a7 = '';
					$att->a8 = '';
					$att->a9 = '';
					$att->a10 = '';
					$att->a11 = '';
					$att->a12 = '';
					$att->a13 = '';
					$att->a14 = '';
					$att->a15 = '';
					$att->a16 = '';
					$att->a17 = '';
					$att->a18 = '';
					$att->a19 = '';
					$att->a20 = '';
					$att->a21 = '';
					$att->a22 = '';
					$att->a23 = '';
					$att->a24 = '';
					$att->a25 = '';
					$att->a26 = '';
					$att->a27 = '';
					$att->a28 = '';
					$att->a29 = '';
					$att->a30 = '';
					$att->a31 = '';
					$att->year = $year;
					$att->month = $sd_month;
					$att->save();
				}
				if (isset($attend_2)) {
					$sheets = Sheets::find($request->sheet);
					for($d = 1 ; $d < $ed*1 + 1; $d++){
						$s = $attend_2->{"s".$d};
						$sheet_info = [];		
						if($s == ""){
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend_2->{"s".$d} = $sheet_info;
						} else {
							$sheet_info["sh"] = $sheets->id;
							$sheet_info["rd"] = $sheets->rest_day;
							if (isset($sheets->open_time)) {
								$sheet_info["ot"] = $sheets->open_time; //open time
							} else {
								$sheet_info["ot"] = ""; //open time
							}
							if (isset($sheets->close_time)) {
								$sheet_info["ct"] = $sheets->close_time; //close time
							} else {
								$sheet_info["ct"] = ""; //close time
							}
							if(isset($sheets->rest_time)){
								$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
								$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
							} else {
								$sheet_info["rs"] = ""; //rest start time
								$sheet_info["re"] = ""; //rest end time
							}
							$attend_2->{"s".$d} = $sheet_info;
						}
					}
					$attend_2->save();
				} else {
					$sheets = Sheets::find($request->sheet);
					$att = new Attends;
					$att->user_id = $staff;
					$att->company_id = $user->company_id;
					$att->depart_id = $user->depart_id;
					$att->user_name = $user->user_name;
					for ($d = 1 ; $d < $ed*1 + 1; $d++) { 
						$s = $att->{"s".$d};
						$sheet_info = [];
						$sheet_info["sh"] = $sheets->id;
						$sheet_info["rd"] = $sheets->rest_day; // 0: rest 1: workday
						if (isset($sheets->open_time)) {
							$sheet_info["ot"] = $sheets->open_time; //open time
						} else {
							$sheet_info["ot"] = ""; //open time
						}
						if (isset($sheets->close_time)) {
							$sheet_info["ct"] = $sheets->close_time; //close time
						} else {
							$sheet_info["ct"] = ""; //close time
						}
						if(isset($sheets->rest_time)){
							$sheet_info["rs"] = explode ("\n", $sheets->rest_time)[0]; //rest start time
							$sheet_info["re"] = explode ("\n", $sheets->rest_time)[1]; //rest end time
						} else {
							$sheet_info["rs"] = ""; //rest start time
							$sheet_info["re"] = ""; //rest end time
						}
						$att->{"s".$d} = json_encode ($sheet_info);
					}
					$att->a1 = '';
					$att->a2 = '';
					$att->a3 = '';
					$att->a4 = '';
					$att->a5 = '';
					$att->a6 = '';
					$att->a7 = '';
					$att->a8 = '';
					$att->a9 = '';
					$att->a10 = '';
					$att->a11 = '';
					$att->a12 = '';
					$att->a13 = '';
					$att->a14 = '';
					$att->a15 = '';
					$att->a16 = '';
					$att->a17 = '';
					$att->a18 = '';
					$att->a19 = '';
					$att->a20 = '';
					$att->a21 = '';
					$att->a22 = '';
					$att->a23 = '';
					$att->a24 = '';
					$att->a25 = '';
					$att->a26 = '';
					$att->a27 = '';
					$att->a28 = '';
					$att->a29 = '';
					$att->a30 = '';
					$att->a31 = '';
					$att->year = $year;
					$att->month = $ed_month;
					$att->save();
				}
			}
		}
	}
	// ```````````````````````````````````````day
	public function attend_list() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$departments = Department::where('company_id', $company->id)->get();

		$staffs = User::where('company_id', $company->id)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		$attends = [];
		foreach($staffs as $staff){
			$attend = Attends::where('user_id', $staff->id)->where("year", date("Y"))->where("month", date('m'))->first();
			if(isset($attend)) {
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->save();
			} else {
				$attend = new Attends;
				$attend->user_id = $staff->id;
				$attend->company_id = $company->id;
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->s1 = '';
				$attend->s2 = '';
				$attend->s3 = '';
				$attend->s4 = '';
				$attend->s5 = '';
				$attend->s6 = '';
				$attend->s7 = '';
				$attend->s8 = '';
				$attend->s9 = '';
				$attend->s10 = '';
				$attend->s11 = '';
				$attend->s12 = '';
				$attend->s13 = '';
				$attend->s14 = '';
				$attend->s15 = '';
				$attend->s16 = '';
				$attend->s17 = '';
				$attend->s18 = '';
				$attend->s19 = '';
				$attend->s20 = '';
				$attend->s21 = '';
				$attend->s22 = '';
				$attend->s23 = '';
				$attend->s24 = '';
				$attend->s25 = '';
				$attend->s26 = '';
				$attend->s27 = '';
				$attend->s28 = '';
				$attend->s29 = '';
				$attend->s30 = '';
				$attend->s31 = '';
				$attend->a1 = '';
				$attend->a2 = '';
				$attend->a3 = '';
				$attend->a4 = '';
				$attend->a5 = '';
				$attend->a6 = '';
				$attend->a7 = '';
				$attend->a8 = '';
				$attend->a9 = '';
				$attend->a10 = '';
				$attend->a11 = '';
				$attend->a12 = '';
				$attend->a13 = '';
				$attend->a14 = '';
				$attend->a15 = '';
				$attend->a16 = '';
				$attend->a17 = '';
				$attend->a18 = '';
				$attend->a19 = '';
				$attend->a20 = '';
				$attend->a21 = '';
				$attend->a22 = '';
				$attend->a23 = '';
				$attend->a24 = '';
				$attend->a25 = '';
				$attend->a26 = '';
				$attend->a27 = '';
				$attend->a28 = '';
				$attend->a29 = '';
				$attend->a30 = '';
				$attend->a31 = '';
				$attend->year = date('Y');
				$attend->month = date('m');
				$attend->save();
			}
			$attends[] = $attend;
		}
		$numberOfDays = date('t');
		$start_date = date('Y-m-01');
		$end_date = date('Y-m-t');
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		$today = date('Y-m-d');
		return view('company.attend_list',  ['user' => $user, 'sheets' => $sheets, 'departments'=>$departments,  'company' => $company, 'attends' => $attends, 'dates' => $dates, 'numberOfDays' => $numberOfDays, 'today' => $today]);
	}
	public function attend_search_depart(Request $request) {
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$departments = Department::where('company_id', $company->id)->get();

		$staffs = User::where('company_id', $company->id)
						->where('depart_id', $request->depart)
						->where('sub_depart_id', $request->sub_depart)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		$attends = [];
		foreach($staffs as $staff){
			$attend = Attends::where('user_id', $staff->id)->where("year", date("Y"))->where("month", date('m'))->first();
			if(isset($attend)) {
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->save();
			} else {
				$attend = new Attends;
				$attend->user_id = $staff->id;
				$attend->company_id = $company->id;
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->s1 = '';
				$attend->s2 = '';
				$attend->s3 = '';
				$attend->s4 = '';
				$attend->s5 = '';
				$attend->s6 = '';
				$attend->s7 = '';
				$attend->s8 = '';
				$attend->s9 = '';
				$attend->s10 = '';
				$attend->s11 = '';
				$attend->s12 = '';
				$attend->s13 = '';
				$attend->s14 = '';
				$attend->s15 = '';
				$attend->s16 = '';
				$attend->s17 = '';
				$attend->s18 = '';
				$attend->s19 = '';
				$attend->s20 = '';
				$attend->s21 = '';
				$attend->s22 = '';
				$attend->s23 = '';
				$attend->s24 = '';
				$attend->s25 = '';
				$attend->s26 = '';
				$attend->s27 = '';
				$attend->s28 = '';
				$attend->s29 = '';
				$attend->s30 = '';
				$attend->s31 = '';
				$attend->a1 = '';
				$attend->a2 = '';
				$attend->a3 = '';
				$attend->a4 = '';
				$attend->a5 = '';
				$attend->a6 = '';
				$attend->a7 = '';
				$attend->a8 = '';
				$attend->a9 = '';
				$attend->a10 = '';
				$attend->a11 = '';
				$attend->a12 = '';
				$attend->a13 = '';
				$attend->a14 = '';
				$attend->a15 = '';
				$attend->a16 = '';
				$attend->a17 = '';
				$attend->a18 = '';
				$attend->a19 = '';
				$attend->a20 = '';
				$attend->a21 = '';
				$attend->a22 = '';
				$attend->a23 = '';
				$attend->a24 = '';
				$attend->a25 = '';
				$attend->a26 = '';
				$attend->a27 = '';
				$attend->a28 = '';
				$attend->a29 = '';
				$attend->a30 = '';
				$attend->a31 = '';
				$attend->year = date('Y');
				$attend->month = date('m');
				$attend->save();
			}
			$attends[] = $attend;
		}
		$numberOfDays = date('t');
		$start_date = date('Y-m-01');
		$end_date = date('Y-m-t');
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		$today = date('Y-m-d');
		return view('company.attend_list',  ['user' => $user, 'sheets' => $sheets, 'departments'=>$departments,  'company' => $company, 'attends' => $attends, 'dates' => $dates, 'numberOfDays' => $numberOfDays, 'today' => $today]);
	}
	public function day_attend_list(Request $request) {
		$year = explode("-", $request->searchDate)[0];
		$month = explode("-", $request->searchDate)[1];
		$day = explode("-", $request->searchDate)[2];

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$departments = Department::where('company_id', $company->id)->get();

		$staffs = User::where('company_id', $company->id)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		foreach($staffs as $staff){
			$attend = Attends::where('user_id', $staff->id)->where("year", $year)->where("month", $month)->first();
			if(isset($attend)) {
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->save();
			} else {
				$attend = new Attends;
				$attend->user_id = $staff->id;
				$attend->company_id = $company->id;
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->s1 = '';
				$attend->s2 = '';
				$attend->s3 = '';
				$attend->s4 = '';
				$attend->s5 = '';
				$attend->s6 = '';
				$attend->s7 = '';
				$attend->s8 = '';
				$attend->s9 = '';
				$attend->s10 = '';
				$attend->s11 = '';
				$attend->s12 = '';
				$attend->s13 = '';
				$attend->s14 = '';
				$attend->s15 = '';
				$attend->s16 = '';
				$attend->s17 = '';
				$attend->s18 = '';
				$attend->s19 = '';
				$attend->s20 = '';
				$attend->s21 = '';
				$attend->s22 = '';
				$attend->s23 = '';
				$attend->s24 = '';
				$attend->s25 = '';
				$attend->s26 = '';
				$attend->s27 = '';
				$attend->s28 = '';
				$attend->s29 = '';
				$attend->s30 = '';
				$attend->s31 = '';
				$attend->a1 = '';
				$attend->a2 = '';
				$attend->a3 = '';
				$attend->a4 = '';
				$attend->a5 = '';
				$attend->a6 = '';
				$attend->a7 = '';
				$attend->a8 = '';
				$attend->a9 = '';
				$attend->a10 = '';
				$attend->a11 = '';
				$attend->a12 = '';
				$attend->a13 = '';
				$attend->a14 = '';
				$attend->a15 = '';
				$attend->a16 = '';
				$attend->a17 = '';
				$attend->a18 = '';
				$attend->a19 = '';
				$attend->a20 = '';
				$attend->a21 = '';
				$attend->a22 = '';
				$attend->a23 = '';
				$attend->a24 = '';
				$attend->a25 = '';
				$attend->a26 = '';
				$attend->a27 = '';
				$attend->a28 = '';
				$attend->a29 = '';
				$attend->a30 = '';
				$attend->a31 = '';
				$attend->year = $year;
				$attend->month = $month;
				$attend->save();
			}
			$attends[] = $attend;
		}
		$numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$start_date = date("Y-m-01", strtotime("$year-$month-01"));
		$end_date = date("Y-m-t", strtotime("$year-$month-01"));
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		return view('company.day_attend_list',  ['user' => $user, 'sheets' => $sheets, 'departments'=>$departments,  'company' => $company, 'attends' => $attends, 'dates' => $dates, 'numberOfDays' => $numberOfDays, 'today' => $day, 'day' => $request->searchDate]);
	}
	public function user_attend(Request $request) {
		$staff = User::find($request->id);
		$company = Company::where('user_id', Auth::user()->id)->first();
		$departments = Department::where('company_id', $company->id)->get();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$attend = Attends::where('user_id', $request->id)->where("year", date("Y"))->where("month", date('m'))->first();
		$today_data = date("Y-m");
		$numberOfDays = date('t');
		$start_date = date('Y-m-01');
		$end_date = date('Y-m-t');
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		return view('company.user_attend', compact('staff', 'company', 'departments', 'sheets', 'dates', 'attend', 'numberOfDays', 'today_data'));
	}
	public function day_user_attend(Request $request) {

		$user_id = $request->id;
		$date = $request->day;
		$year = explode("-", $date)[0];
		$month = explode("-", $date)[1];
		$day = explode("-", $date)[2];
		$today_data = $year."-".$month;
		$staff = User::find($request->id);
		$company = Company::where('user_id', Auth::user()->id)->first();
		$departments = Department::where('company_id', $company->id)->get();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$attend = Attends::where('user_id', $request->id)->where("year", $year)->where("month", $month)->first();

		$numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$start_date = date("Y-m-01", strtotime("$year-$month-01"));
		$end_date = date("Y-m-t", strtotime("$year-$month-01"));

		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		return view('company.user_attend', compact('staff', 'company', 'departments', 'sheets', 'dates', 'attend', 'numberOfDays', 'today_data'));

	}
	// ```````````````````````````````````````end day
	// ```````````````````````````````````````month
	public function attend_list_month() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$departments = Department::where('company_id', $company->id)->get();

		$staffs = User::where('company_id', $company->id)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		$attends = [];
		foreach($staffs as $staff){
			$attend = Attends::where('user_id', $staff->id)->where("year", date("Y"))->where("month", date('m'))->first();
			if(isset($attend)) {
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->save();
			} else {
				$attend = new Attends;
				$attend->user_id = $staff->id;
				$attend->company_id = $company->id;
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->s1 = '';
				$attend->s2 = '';
				$attend->s3 = '';
				$attend->s4 = '';
				$attend->s5 = '';
				$attend->s6 = '';
				$attend->s7 = '';
				$attend->s8 = '';
				$attend->s9 = '';
				$attend->s10 = '';
				$attend->s11 = '';
				$attend->s12 = '';
				$attend->s13 = '';
				$attend->s14 = '';
				$attend->s15 = '';
				$attend->s16 = '';
				$attend->s17 = '';
				$attend->s18 = '';
				$attend->s19 = '';
				$attend->s20 = '';
				$attend->s21 = '';
				$attend->s22 = '';
				$attend->s23 = '';
				$attend->s24 = '';
				$attend->s25 = '';
				$attend->s26 = '';
				$attend->s27 = '';
				$attend->s28 = '';
				$attend->s29 = '';
				$attend->s30 = '';
				$attend->s31 = '';
				$attend->a1 = '';
				$attend->a2 = '';
				$attend->a3 = '';
				$attend->a4 = '';
				$attend->a5 = '';
				$attend->a6 = '';
				$attend->a7 = '';
				$attend->a8 = '';
				$attend->a9 = '';
				$attend->a10 = '';
				$attend->a11 = '';
				$attend->a12 = '';
				$attend->a13 = '';
				$attend->a14 = '';
				$attend->a15 = '';
				$attend->a16 = '';
				$attend->a17 = '';
				$attend->a18 = '';
				$attend->a19 = '';
				$attend->a20 = '';
				$attend->a21 = '';
				$attend->a22 = '';
				$attend->a23 = '';
				$attend->a24 = '';
				$attend->a25 = '';
				$attend->a26 = '';
				$attend->a27 = '';
				$attend->a28 = '';
				$attend->a29 = '';
				$attend->a30 = '';
				$attend->a31 = '';
				$attend->year = date('Y');
				$attend->month = date('m');
				$attend->save();
			}
			$attends[] = $attend;
		}
		$numberOfDays = date('t');
		$start_date = date('Y-m-01');
		$end_date = date('Y-m-t');
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		$today = date("Y-m-d");
		return view('company.attend_list_month',  ['user' => $user, 'sheets' => $sheets, 'departments'=>$departments,  'company' => $company, 'attends' => $attends, 'dates' => $dates, 'numberOfDays' => $numberOfDays, 'today' => $today]);
	}
	public function get_attendList(Request $request) {
		$year = $request->year;
		$month = $request->month;
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sheets = Sheets::where('company_id', $company->id)->get();
		$departments = Department::where('company_id', $company->id)->get();

		$staffs = User::where('company_id', $company->id)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		$attends = [];
		foreach($staffs as $staff){
			$attend = Attends::where('user_id', $staff->id)->where("year", $year)->where("month", $month)->first();
			if(isset($attend)) {
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->save();
			} else {
				$attend = new Attends;
				$attend->user_id = $staff->id;
				$attend->company_id = $company->id;
				$attend->depart_id = $staff->depart_id;
				$attend->user_name = $staff->user_name;
				$attend->s1 = '';
				$attend->s2 = '';
				$attend->s3 = '';
				$attend->s4 = '';
				$attend->s5 = '';
				$attend->s6 = '';
				$attend->s7 = '';
				$attend->s8 = '';
				$attend->s9 = '';
				$attend->s10 = '';
				$attend->s11 = '';
				$attend->s12 = '';
				$attend->s13 = '';
				$attend->s14 = '';
				$attend->s15 = '';
				$attend->s16 = '';
				$attend->s17 = '';
				$attend->s18 = '';
				$attend->s19 = '';
				$attend->s20 = '';
				$attend->s21 = '';
				$attend->s22 = '';
				$attend->s23 = '';
				$attend->s24 = '';
				$attend->s25 = '';
				$attend->s26 = '';
				$attend->s27 = '';
				$attend->s28 = '';
				$attend->s29 = '';
				$attend->s30 = '';
				$attend->s31 = '';
				$attend->a1 = '';
				$attend->a2 = '';
				$attend->a3 = '';
				$attend->a4 = '';
				$attend->a5 = '';
				$attend->a6 = '';
				$attend->a7 = '';
				$attend->a8 = '';
				$attend->a9 = '';
				$attend->a10 = '';
				$attend->a11 = '';
				$attend->a12 = '';
				$attend->a13 = '';
				$attend->a14 = '';
				$attend->a15 = '';
				$attend->a16 = '';
				$attend->a17 = '';
				$attend->a18 = '';
				$attend->a19 = '';
				$attend->a20 = '';
				$attend->a21 = '';
				$attend->a22 = '';
				$attend->a23 = '';
				$attend->a24 = '';
				$attend->a25 = '';
				$attend->a26 = '';
				$attend->a27 = '';
				$attend->a28 = '';
				$attend->a29 = '';
				$attend->a30 = '';
				$attend->a31 = '';
				$attend->year = $year;
				$attend->month = $month;
				$attend->save();
			}
			$attends[] = $attend;
		}
		$numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$start_date = date("Y-m-01", strtotime("$year-$month-01"));
		$end_date = date("Y-m-t", strtotime("$year-$month-01"));
		$dates = [];
		while (strtotime($start_date) <= strtotime($end_date)) {
			$day_of_week = date('l', strtotime($start_date));
			$dates[] = $start_date . ":" . $day_of_week;
			$start_date = date('Y-m-d', strtotime($start_date . ' + 1 day'));
		}
		return view('company.month_attend_list',  ['user' => $user, 'sheets' => $sheets, 'departments'=>$departments,  'company' => $company, 'attends' => $attends, 'dates' => $dates, 'numberOfDays' => $numberOfDays]);
	}
	// ```````````````````````````````````````end month
	
	public function sheet_sel_info(Request $request){
		$sel = $request->sel;
		$sheets = Sheets::where('id', $sel)->first();	
		return $sheets;
	}
	public function sheet_add(Request $request){
		// $metaitem = $request->metaitem;
		// $description = $request->description;
		// $kind = $request->kind;
		// $metaitem_id = $request->metaitem_id;

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();

		$sheet = new Sheets;

		$sheet->sheet_name = $request->sheet_name;
		$sheet->company_id = $company->id;
		$sheet->sheet_name_1 = $request->sheet_name_1;
		$sheet->sheet_color = $request->sheet_color;

		$sheet->rest_day = $request->rest_day;
		$sheet->open_time = $request->open_time;
		$sheet->close_time = $request->close_time;
		$sheet->rest_time = $request->rest_time;
		$sheet->rest_apply = $request->rest_apply;

		$sheet->minashi = $request->minashi;
		$sheet->ch_sheet = $request->ch_sheet;

		// $dep->description = $description;	
		// $dep->kind = $kind;
		// $dep->metaitem_id = $metaitem_id;	

		$sheet->save();

		return "ok";
	}
	public function sheet_save(Request $request){	

		
		$sheet = Sheets::find($request->sel_id);

		$sheet->sheet_name = $request->sheet_name;		
		$sheet->sheet_name_1 = $request->sheet_name_1;
		$sheet->sheet_color = $request->sheet_color;

		$sheet->rest_day = $request->rest_day;
		$sheet->open_time = $request->open_time;
		$sheet->close_time = $request->close_time;
		$sheet->rest_time = $request->rest_time;
		$sheet->rest_apply = $request->rest_apply;

		$sheet->minashi = $request->minashi;
		$sheet->ch_sheet = $request->ch_sheet;		

		$sheet->save();

		return "ok";
	}
	
	
	public function metaitem_add(Request $request){
		$metaitem = $request->metaitem;
		$description = $request->description;
		$kind = $request->kind;
		$metaitem_id = $request->metaitem_id;

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();

		$dep = new Metaitem;
		$dep->metaitem = $metaitem;
		$dep->company_id = $company->id;
		$dep->description = $description;	
		$dep->kind = $kind;
		$dep->metaitem_id = $metaitem_id;	

		$dep->save();

		return "ok";
	}

	public function metaitem_save(Request $request){
		
		$metaitem = $request->metaitem;
		$description = $request->description;
		$kind = $request->kind;
		$metaitem_id = $request->metaitem_id;
		$sel = $request->sel_id;

		$user = Auth::user();

		$dep = Metaitem::find($sel);;
		$dep->metaitem = $metaitem;
		$dep->kind = $kind;
		$dep->metaitem_id = $metaitem_id;		
		$dep->description = $description;		

		$dep->save();

		return "ok";
	}

	public function metaitem_sel_info(Request $request){
		$sel = $request->sel;
		$metaitem = Metaitem::where('id', $sel)->first();	
		return $metaitem;
	}

	public function metaitem_delete(Request $request){
		$sel = $request->sel;
		$metaitem = Metaitem::where('id', $sel)->first();
		$metaitem->delete();	
		return "ok";
	}

	public function search_staff(Request $request) {

        $search = $request->search;
        $company_id = $request->company_id;
        $filtered_staffs = User::where('company_id', $company_id)->where('user_name', 'LIKE', '%'.$search.'%')->get();
	
		return $filtered_staffs;

	}
	public function staff_bug(){
		echo "登録されたメールアドレスです。<br>";
		echo "再登録するには<a href='".route('company.staff_add')."'>こちら</a><br>";
	}
	public function staff_create(Request $request) {
		Validator::make($request->all(), [
			'email' => 'required|unique:users',
			'name' => 'required|string|max:255',
			'user_name' => 'required|string|max:255',
			'user_name_g' => 'required|string|max:255',
			'zip1' => 'required',
			'zip2' => 'required',
			'pref' => 'required|string|max:255',
			'addr' => 'required|string|max:255',
			'str' => 'required|string|max:255',
			'country' => 'required|string|max:255',
			'birthday' => 'required|date',
		])->validate();
		$req = request()->post();

		$user = User::where("email", $req['email'])->get();

        if(count($user) > 0){
			"<script>alert('登録されたメールアドレスです。');</script>";
            return redirect()->route('company.staff_bug');
        }

		$user = Auth::user();		
		$company = Company::where('user_id', $user->id)->first();

		$new_user = new User;
		$new_user->name = $req["name"];
		$new_user->company_id = $company->id;
		$new_user->depart_id = $req["depart_id"];		
		$new_user->sub_depart_id = $req["sub_depart_id"];		
		$new_user->password = Hash::make("staff1234");
		$new_user->user_name =  $req["user_name"];
		$new_user->user_name_g = $req["user_name_g"];
		$new_user->zip1 = $req["zip1"];
		$new_user->zip2 = $req["zip2"];
		$new_user->pref = $req["pref"];
		$new_user->addr = $req["addr"];
		$new_user->str = $req["str"];
		$new_user->phone = $req["phone"];
		$new_user->country = $req["country"];
		$new_user->gender = $req["gender"];
		$new_user->social_num = $req["social_num"];
		$new_user->employ_num = $req["employ_num"];
		$new_user->email = $req["email"];
		$new_user->birthday = $req["birthday"];
		$new_user->metaitem = $req["mate"];
		$new_user->role = 2;
		$new_user->avatar = $req["avatar"];
		$new_user->total_work_time = $req["total_work_time"];
		$new_user->salary_date = $req["salary_date"];
		$new_user->idm = $req["idm"];
		$new_user->job_id = $req["job_id"];
			
		if ($new_user->save()) {
			$staff_history = new JobHistory;
			$staff_history->staff_id = $new_user->id;
			$staff_history->job_history = $request->job_id;
			$staff_history->depart_history = $new_user->depart_id.":".$new_user->sub_depart_id;
			$staff_history->save();
		}

		$salary = new Salary;
		$salary->staff_id = $new_user->id;
		$salary->hourly_wage = $request->hourly_wage;
		$salary->basic_allowance = $request->basic_allowance;
		$salary->business_allowance = $request->business_allowance;
		$salary->position_allowance = $request->position_allowance;
		$salary->technical_allowance = $request->technical_allowance;
		$salary->adjustment_allowance = $request->adjustment_allowance;
		$add_item = [];
		for ($i = 1; $request["item_label_$i"] !== null; $i++) {
			$add_item[$request["item_label_$i"]] = $request["item_content_$i"];
		}
		$salary->add_item = json_encode($add_item);
		if($salary->save()) {
			$salary_history = new SalaryHistory;
			$salary_history->staff_id = $new_user->id;
			$salary_history->hourly_wage = $request->hourly_wage;
			$salary_history->basic_allowance = $request->basic_allowance;
			$salary_history->business_allowance = $request->business_allowance;
			$salary_history->position_allowance = $request->position_allowance;
			$salary_history->technical_allowance = $request->technical_allowance;
			$salary_history->adjustment_allowance = $request->adjustment_allowance;
			$add_item = [];
			for ($i = 1; $request["item_label_$i"] !== null; $i++) {
				$add_item[$request["item_label_$i"]] = $request["item_content_$i"];
			}
			$salary_history->add_item = json_encode($add_item);
			$salary_history->save();
		}

        $staffs = User::where('company_id', $company->id)                
                ->get();

		$msg["user_id"] = $new_user->id;
        $msg["name"] = $new_user->name;
        $msg["email"] = $new_user->email;
        $msg["title"] = "【".$company->company_name."】従業員登録完了のお知らせ";        
        
        $msg["send_dt"] = date("Y-m-d H:i:s");
        $msg["state"] = 1;
        $msg["alret_dt"] = date("Y-m-d H:i:s");

        $detail = [];
        $bccAry = [];
        $details = $req;
        $details["company_name"] = $company->company_name;
    
        Mail::to($details["email"])
                ->bcc($bccAry)
                ->send(new \App\Mail\WelcomeEmai($details));

		return redirect()->route('company.staff_list');
	}

    public function staff_add() {

		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$departments = Department::where('company_id', $company->id)->get();
		$sub_department = Subdepartment::all();
		$metaitems = Metaitem::where('company_id', $company->id)->get();
		$job = Job::where('company_id', $company->id)->get();
		$company_avart = "";
		$mat = Material::where('user_id', $user->id)->get();	
		if(count($mat) > 0){
			$company_avart = $mat[0]["dt1"];
		}

		if(count($departments) > 0){
			return view('company.staff_add',  ['user' => $user, 'company' => $company, 'departments'=>$departments, 'sub_department' => $sub_department, 'metaitems'=>$metaitems, 'company_avart'=>$company_avart, 'job'=>$job]);
		}else{
			return redirect()->route('company.department_list');
		}
	}

	public function staff_get_sub_depart(Request $request){
		$subdepart = Subdepartment::where('depart_id', $request->depart_id)->get();
		return $subdepart;
	}

	public function department_list(){
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$departments = Department::where('company_id', $company->id)->get();
		$subdepartment = Subdepartment::all();	

		$company_avart = "";
		$metaitem = Material::where('user_id', $user->id)->get();	
		if(count($metaitem) > 0){
			$company_avart = $metaitem[0]["dt1"];
		}

		return view('company.department_list',  ['user' => $user, 'departments' => $departments,  'company' => $company, 'company_avart'=>$company_avart, 'subdepartment' => $subdepartment]);

	}

	public function department_history(Request $request)
	{
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		if (!$request->has('history_date')) {
			$history = Departhistory::where('company_id', $company->id)->latest()->first();
			if (isset($history)) {
				$dep_history = json_decode($history->history, true);
			} else {
				$dep_history = NULL;
			}
		} else {
			$history = Departhistory::where('company_id', $company->id)->where('save_date', $request->history_date)->first();
			if ($history) {
				$dep_history = json_decode($history->history, true);
			} else {
				$history = Departhistory::where('company_id', $company->id)->where('save_date', '<=', $request->history_date)->orderBy('save_date', 'desc')->first();
				if(isset($history)){

					$dep_history = json_decode($history->history, true);
				} else {
					$dep_history = NULL;
				}
			}
		}
		return view('company.department_history', compact('dep_history'));
	}

	public function department_add(Request $request){
		$depart = $request->depart;
		$description = $request->description;
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		
		$dep = new Department;
		$dep->depart = $depart;
		$dep->company_id = $company->id;
		$dep->description = $description;
		
		if($dep->save()){
			$departs = Department::where('company_id', $company->id)->get();
			$dep_arr = [];
	
			foreach ($departs as $department) {
				$subdeparts = Subdepartment::where('depart_id', $department->id)->get();
				$subdepart_ids = [];
				foreach ($subdeparts as $subdepart) {
					$subdepart_ids[] = $subdepart->id;
				}
				$dep_arr[$department->id] = $subdepart_ids;
			}
			$today = date("y-m-d");
			$departhistory = new Departhistory;
			$departhistory->company_id = $company->id;
			$departhistory->history = json_encode($dep_arr);
			$departhistory->save_date = $today;
			$departhistory->save();
		}
		
		return "ok";
	}

	public function department_save(Request $request){
		
		$depart = $request->depart;
		$description = $request->description;
		$sel = $request->sel_id;

		$user = Auth::user();

		$dep = Department::find($sel);;
		$dep->depart = $depart;
		$dep->company_id = $user->company_id;
		$dep->description = $description;		

		$dep->save();

		return "ok";
	}

	public function department_delete(Request $request)
	{
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$depart = Department::find($request->depart_id);
		if($depart->delete()){
			$departs = Department::where('company_id', $user->company_id)->get();
			$dep_arr = [];
	
			foreach ($departs as $department) {
				$subdeparts = Subdepartment::where('depart_id', $department->id)->get();
				$subdepart_ids = [];
				foreach ($subdeparts as $subdepart) {
					$subdepart_ids[] = $subdepart->id;
				}
				$dep_arr[$department->id] = $subdepart_ids;
			}
			$today = date("y-m-d");
			$departhistory = new Departhistory;
			$departhistory->company_id = $company->id;
			$departhistory->history = json_encode($dep_arr);
			$departhistory->save_date = $today;
			$departhistory->save();
		}
	}

	public function department_sel_info(Request $request){
		$sel = $request->sel;
		$department = Department::where('id', $sel)->first();
		return $department;
	}

	public function sub_department_add(Request $request){
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$subdepart = new Subdepartment;
		$subdepart->depart_id = $request->de_id;
		$subdepart->name = $request->depart;
		$subdepart->description = $request->description;
		if($subdepart->save()){
			$departs = Department::where('company_id', $user->company_id)->get();
			$dep_arr = [];
	
			foreach ($departs as $department) {
				$subdeparts = Subdepartment::where('depart_id', $department->id)->get();
				$subdepart_ids = [];
				foreach ($subdeparts as $subdepart) {
					$subdepart_ids[] = $subdepart->id;
				}
				$dep_arr[$department->id] = $subdepart_ids;
			}
			$today = date("y-m-d");
			$departhistory = new Departhistory;
			$departhistory->company_id = $company->id;
			$departhistory->history = json_encode($dep_arr);
			$departhistory->save_date = $today;
			$departhistory->save();
		}
	}

	public function sub_department_sel_info(Request $request){
		$sub_department = Subdepartment::find($request->sub_id);
		return $sub_department;
	}

	public function sub_department_save(Request $request){
		$sub_department = Subdepartment::find($request->sub_depart_id);
		$sub_department->depart_id = $request->de_id;
		$sub_department->name = $request->sub_depart;
		$sub_department->description = $request->description;
		$sub_department->save();
		return "ok";
	}

	public function sub_department_delete(Request $request){
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
		$sub_department = Subdepartment::find($request->sub_depart_id);
		if($sub_department->delete()){
			$departs = Department::where('company_id', $user->company_id)->get();
			$dep_arr = [];
	
			foreach ($departs as $department) {
				$subdeparts = Subdepartment::where('depart_id', $department->id)->get();
				$subdepart_ids = [];
				foreach ($subdeparts as $subdepart) {
					$subdepart_ids[] = $subdepart->id;
				}
				$dep_arr[$department->id] = $subdepart_ids;
			}
			$today = date("y-m-d");
			$departhistory = new Departhistory;
			$departhistory->company_id = $company->id;
			$departhistory->history = json_encode($dep_arr);
			$departhistory->save_date = $today;
			$departhistory->save();
		}
	}

	public function create_company() {		
		$user = Auth::user();
		$users = User::where('role', 'seo')->get();
		return view('admin.create_company',  ['user' => $user, 'users' => $users]);
	}

	public function sel_company_info(Request $request) {	
		$req = request()->post();

		$new_companys = Company::where('id', $req["sel"])->limit(1)->get();

		foreach($new_companys as $com){
			$users = User::where('id', $com->user_id)->first();
			$com["phone"] = $users["phone"];
			$com["email"] = $users["email"];
			$com["post_code"] = $users["post_code"];
			$com["address"] = $users["address"];
			$com["profile"] = $users["profile"];

			$material = Material::where('user_id', $com->user_id)->first();
			$com["dt1"] = $material["dt1"];
			$com["dt2"] = $material["dt2"];
			$com["dt3"] = $material["dt3"];
			$com["dt4"] = $material["dt4"];
			$com["dt5"] = $material["dt5"];
			$com["dt6"] = $material["dt6"];
			$com["dt7"] = $material["dt7"];
			$com["dt8"] = $material["dt8"];

			$date = date_create($com["created_at"]);
			$com["created_at_"] = date_format($date, 'H:i A d M Y');

		}

		return $new_companys;
	}

	public function create_company_save(Request $request) {

		$req = request()->post();

		$user = new User;
		$user->name = $req["name"];
		$user->password = Hash::make($req["password"]);
		$user->user_name =  $req["seo_name"];
		$user->user_name_g = "";
		$user->post_code = $req["post_code"];
		$user->address = $req["address"];
		$user->phone = $req["phone"];
		$user->country = "";
		$user->gender = 0;
		$user->social_num = "";
		$user->employ_num = "";
		$user->email = $req["email"];
		$user->birthday = $req["birthday"];
		$user->role = 1;
		$user->save();

		$mat = new Company;
		$mat->user_id = $user->id;
		$mat->company_name = $req["company_name"];
		$mat->seo_name = $req["seo_name"];
		$mat->company_num = $req["company_num"];
		$mat->employ_num =  $req["employ_num"];
		$mat->year_num = $req["year_num"];
		$mat->labor_num = $req["labor_num"];
		$mat->service_employ = $req["service_employ"];
		$mat->service_attend = $req["service_attend"];
		$mat->labor_type = $req["labor_type"];
		$mat->mon_total_days = $req["mon_total_days"];
		$mat->goto_time_1 = "";
		$mat->goto_time_2 = "";
		$mat->goto_time_sheet = 0;
		$mat->service_attend = $req["service_attend"];
		$mat->goto_time_type = 0;
		$mat->close_time_1 = "";
		$mat->close_time_2 = "";
		$mat->close_time_sheet = 0;
		$mat->close_time_type = 0;		

		$mat->save();

		$mat = Material::where('user_id', 0)->first();	
		if(isset($mat)){
			$mat->user_id = $user->id;
			$mat->save();
		}
		return redirect()->route('admin.dashboard');
		//return view('admin.dashboard',  ['user' => $user, 'users' => $users]);
	}

	public function file_upload(Request $request) {
		$req = json_decode($request['postData']);

		$img = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

		$mat = Material::where('user_id', 0)->first();	

		if(isset($mat)){
			if($mat->dt1 == ""){
				$mat->dt1 = $img;
			}else if($mat->dt2 == ""){
				$mat->dt2 = $img;
			}else if($mat->dt3 == ""){
				$mat->dt3 = $img;
			}else if($mat->dt4 == ""){
				$mat->dt4 = $img;
			}else if($mat->dt5 == ""){
				$mat->dt5 = $img;
			}else if($mat->dt6 == ""){
				$mat->dt6 =$img;
			}else if($mat->dt7 == ""){
				$mat->dt7 = $img;
			}else{
				$mat->dt8 = $img;
			}

			$mat->save();

		}else{

			$mat = new Material;
			$mat->user_id = 0;
			$mat->dt1 = $img;
			$mat->dt2 = "";
			$mat->dt3 = "";
			$mat->dt4 = "";
			$mat->dt5 = "";
			$mat->dt6 = "";
			$mat->dt7 = "";
			$mat->dt8 = "";

			$mat->save();
		}
		
		return "Ok";
	}
	public function job_create(Request $request)
	{
		$company_id = Auth::user()->company_id;
		$job = job::where('company_id', $company_id)->get();
		return view('company.job_create', compact('job'));
	}

	public function get_job(Request $request)
	{
		$getJob = Job::find($request->id);
		return $getJob;
	}

	public function job_add(Request $request)
	{
		$company_id = Auth::user()->company_id;
		$job = new Job;
		$job->company_id = $company_id;
		$job->name = $request->job_name;
		if($job->save()){
			return "ok";
		}
	}

	public function job_update(Request $request)
	{
		$job = Job::find($request->job_id);
		$job->name = $request->job_name;
		if($job->save()){
			return "ok";
		}
	}

	public function job_delete(Request $request)
	{
		$job = Job::find($request->job_id);
		$job->delete();
	}

	public function job_history(Request $request)
	{
		$user = Auth::user();
		$company = Company::where('user_id', $user->id)->first();
        $staffs = User::where('company_id', $company->id)
						->where('status', '<>', "2")
						->where('role', 2)
						->get();
		if (isset($request->staff_id)) {
			$staff_id = $request->staff_id;
			$history = JobHistory::where('staff_id', $staff_id)->get();
			return view('company.job_history', compact('staffs', 'history', 'staff_id'));
		}
		return view('company.job_history', compact('staffs'));
	}
	//////////////////////////////////
    public function list_account() {
		$user = Auth::user();
		$users = User::all();
		return view('admin.account', ['user' => $user, 'users' => $users]);
	}

	public function delete_account(Request $request) {
		$id = $request->id;
		User::find($id)->delete();
	}

	public function permit_account(Request $request) {
		$id = $request['id'];
		$user = User::find($id);
		$user->is_permitted = $request['isPermitted'];
		$user->save();
	}

	public function set_column_user(Request $request) {
		$user_id = Auth::id();
		$user = User::find($user_id);
		$user[$request->col] = $request->content;
		$user->save();
		
		return;
	}

	public function set_column_exset(Request $request) {
		$user_id = Auth::id();
		$ex_setting = Exsetting::where('user_id', $user_id)->get();
		$ex_setting[0][$request->col] = $request->content;
		$ex_setting[0]->save();
		
		return;
	}

	public function save_userdata(Request $request)
	{
		$req = json_decode($request['exData']);
		$user_query = User::find($req->user_id);
		if ($user_query == null) {
			$user_query = new User;
		}

		$user_query->file_name = $req->file_name;
		$user_query->len = $req->len;
		$user_query->save();
	}
	
	public function save_limit(Request $request) {
		$user_id = $request->user_id;

		$user = User::find($user_id);
		$user->limit = $request['limit'];
		$user->save();
	}

	public function company_profile(Request $request)
	{
		$user = User::find($request->id);
		$company = Company::find($user->company_id);
		$material = Material::where('user_id', $user->id)->first();
		return view('company.profile', compact('company', 'user', 'material'));
	}

	public function company_edit_save(Request $request)
	{
		$user = User::find($request->user_id);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->zip1 = $request->zip1;
		$user->zip2 = $request->zip2;
		$user->pref = $request->pref;
		$user->addr = $request->addr;
		$user->str = $request->str;
		$user->birthday = $request->birthday;
		$user->employ_num = $request->employ_num;
		$user->save();

		$company = Company::find($request->company_id);
		$company->company_name = $request->company_name;
		$company->seo_name = $request->seo_name;
		$company->company_num = $request->company_num;
		$company->employ_num = $request->employ_num;
		$company->year_num = $request->year_num;
		$company->labor_num = $request->labor_num;
		$company->save();

		$material = Material::where('user_id', $request->user_id)->first();
		if(isset($material)){
			$material->dt1 = $request->dt1;
			$material->dt2 = $request->dt2;
			$material->dt3 = $request->dt3;
			$material->dt4 = $request->dt4;
			$material->dt5 = $request->dt5;
			$material->dt6 = $request->dt6;
			$material->dt7 = $request->dt7;
			$material->dt8 = $request->dt8;
			$material->save();
		}else{
			$material = new Material;
			$material->user_id = $request->user_id;
			$material->dt1 = $request->dt1;
			$material->dt2 = $request->dt2;
			$material->dt3 = $request->dt3;
			$material->dt4 = $request->dt4;
			$material->dt5 = $request->dt5;
			$material->dt6 = $request->dt6;
			$material->dt7 = $request->dt7;
			$material->dt8 = $request->dt8;
			$material->save();
		}

		return redirect()->route('company.staff_list');

	}

	public function salary(Request $request){
		$company_id = Auth::user()->company_id;
		$salary = Salary::where('company_id', $company_id)->first();
		return view('company.salary', compact('salary'));
	}

	public function salary_create(Request $request) {
		$company_id = Auth::user()->company_id;
		$salary = $request->salary_id == 0 ? new Salary : Salary::find($request->salary_id);
		$salary->company_id = $company_id;
		$salary->hourly_wage = $request->hourly_wage;
		$salary->basic_allowance = $request->basic_allowance;
		$salary->business_allowance = $request->business_allowance;
		$salary->position_allowance = $request->position_allowance;
		$salary->technical_allowance = $request->technical_allowance;
		$salary->adjustment_allowance = $request->adjustment_allowance;

		$add_item = [];
		for ($i = 1; $request["item_label_$i"] !== null; $i++) {
			$add_item[$request["item_label_$i"]] = $request["item_content_$i"];
		}

		for ($i = 1; $request["update_item_label_$i"] !== null; $i++) {
			$add_item[$request["update_item_label_$i"]] = $request["update_item_content_$i"];
		}

		$salary->add_item = json_encode($add_item);

		$salary->save();
		return redirect()->route('company.salary');
	}

	public function get_attend_data(Request $request) {
		$year = explode("-", $request->data)[0];
		$month = explode("-", $request->data)[1];
		$attend_data = Attends::where('id', $request->id)->where('year', $year)->where('month', $month)->first();
		$data = $attend_data['a'.$request->day];
		return json_decode($data);
	}

	public function attend_update(Request $request) {
		$update_attend = Attends::where('id', $request->att_id)->first();
		if (empty($update_attend["a".$request->att_day])) {
			$sheet_data = json_decode($update_attend["s".$request->att_day]);
			$sheet_data->ot = $request->open_time;
			$sheet_data->ct = $request->close_time;
			$sheet_data->rs = $request->rest_start_time;
			$sheet_data->re = $request->rest_end_time;
			$update_attend["a".$request->att_day] = json_encode($sheet_data);
			$update_attend->save();
		} else {
			$attend_data = json_decode($update_attend["a".$request->att_day]);
			$attend_data->ot = $request->open_time;
			$attend_data->ct = $request->close_time;
			$attend_data->rs = $request->rest_start_time;
			$attend_data->re = $request->rest_end_time;
			$update_attend["a".$request->att_day] = json_encode($attend_data);
			$update_attend->save();
		}
		return back();
	}
}
