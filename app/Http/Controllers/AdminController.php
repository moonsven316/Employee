<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\Company;
use App\Models\Worktime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{ 
	public function dashboard() {

		// $user = Auth::user();
		// $companys = Company::orderBy('star', 'desc')->limit(10)->get();
		
		// foreach($companys as $com){

		// 	$users = User::where('id', $com->user_id)->first();
		// 	if($users){
		// 		$com["phone"] = $users["phone"];
		// 		$com["email"] = $users["email"];
		// 		$com["post_code"] = $users["post_code"];
		// 		$com["address"] = $users["address"];
		// 	}

		// }

		// $new_companys = Company::orderBy('updated_at', 'desc')->limit(1)->get();
		// foreach($new_companys as $com){
		// 	$users = User::where('id', $com->user_id)->first();

		// 	if($users){
		// 		$com["phone"] = $users["phone"];
		// 		$com["email"] = $users["email"];
		// 		$com["post_code"] = $users["post_code"];
		// 		$com["address"] = $users["address"];
		// 		$com["profile"] = $users["profile"];

		// 		$material = Material::where('user_id', $com->user_id)->first();
		// 		if($material){
		// 			$com["dt1"] = $material["dt1"];
		// 			$com["dt2"] = $material["dt2"];
		// 			$com["dt3"] = $material["dt3"];
		// 			$com["dt4"] = $material["dt4"];
		// 			$com["dt5"] = $material["dt5"];
		// 			$com["dt6"] = $material["dt6"];
		// 			$com["dt7"] = $material["dt7"];
		// 			$com["dt8"] = $material["dt8"];
		// 		}
		// 	}

		// }
		$company_menu = Company::all();
		// dd($company);
		if(count($company_menu) > 0){
			$company = Company::first();
			$user = User::find($company->user_id);
			$material = Material::where('user_id', $company->user_id)->first();
			return view('admin.dashboard',  compact('company_menu', 'company', 'user', 'material'));
		}else{
			return redirect()->route('admin.create_company');
		}

	}
	public function company(Request $request)
	{
		$company_menu = Company::all();
		$company = Company::find($request->id);
		$user = User::find($company->user_id);
		$material = Material::where('user_id', $company->user_id)->first();
		return view('admin.dashboard', compact('company_menu', 'company', 'user', 'material'));
	}

	public function create_company() {		
		$user = Auth::user();
		$users = User::where('role', 'seo')->get();
		return view('admin.create_company',  ['user' => $user, 'users' => $users]);
	}

	public function sel_company_info(Request $request) {	
		$req = request()->post();
		// $new_companys = Company::where('id', $req["sel"])->limit(1)->get();
		$new_companys = Company::find($req['sel']);
		$user = User::where('id', $new_companys->user_id)->first();
		$company = Company::where('user_id', $user->id)->first();
		$material = Material::where('user_id', $new_companys->user_id)->first();
		$data = [];
		$data['user'] = $user;
		$data['material'] = $material;
		$data['company'] = $company;
		return $data;
	}

	public function create_company_save(Request $request) {
		Validator::make($request->all(), [
			'email' => 'required|unique:users',	
		])->validate();
		$req = request()->post();

		$user = new User;
		$user->name = $req["name"];
		$user->password = Hash::make("company1234");
		$user->user_name =  $req["seo_name"];
		$user->user_name_g = "";
		$user->zip1 = $req["zip1"];
		$user->zip2 = $req["zip2"];
		$user->pref = $req["pref"];
		$user->addr = $req["addr"];
		$user->str = $req["str"];
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
		// $mat->mon_total_days = $req["mon_total_days"];
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

		$worktime = new Worktime;
		$worktime->company_id = $mat->id;
		$worktime->first_day = $req['labor_type'] == 0 ? 160 : $req['first_day'];
		$worktime->second_day = $req['labor_type'] == 0 ? 160 : $req['second_day'];
		$worktime->third_day = $req['labor_type'] == 0 ? 160 : $req['third_day'];
		$worktime->fourth_day = $req['labor_type'] == 0 ? 160 : $req['fourth_day'];
		$worktime->save();

		$user_update = User::find($user->id);
		$user_update->company_id = $mat->id;
		$user_update->save();

		$mat = Material::where('user_id', 0)->first();	
		if(isset($mat)){
			$mat->user_id = $user->id;
			$mat->save();
		}

        $detail = [];
        $bccAry = [];
        $details = $req;        
    
        Mail::to($details["email"])
                ->bcc($bccAry)
                ->send(new \App\Mail\CompanyEmai($details));

		return redirect()->route('admin.dashboard');
		//return view('admin.dashboard',  ['user' => $user, 'users' => $users]);
	}

	public function file_upload(Request $request) {
		$req = json_decode($request['postData']);

		$img = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

		$mat = Material::where('user_id', 0)->first();	

		if(isset($mat)){
			if($mat->dt1 == ""){
				$mat->dt1 = "data:image/jpeg;base64,".$img;
			}else if($mat->dt2 == ""){
				$mat->dt2 = "data:image/jpeg;base64,".$img;
			}else if($mat->dt3 == ""){
				$mat->dt3 = "data:image/jpeg;base64,".$img;
			}else if($mat->dt4 == ""){
				$mat->dt4 = "data:image/jpeg;base64,".$img;
			}else if($mat->dt5 == ""){
				$mat->dt5 = "data:image/jpeg;base64,".$img;
			}else if($mat->dt6 == ""){
				$mat->dt6 ="data:image/jpeg;base64,".$img;
			}else if($mat->dt7 == ""){
				$mat->dt7 = "data:image/jpeg;base64,".$img;
			}else{
				$mat->dt8 = "data:image/jpeg;base64,".$img;
			}

			$mat->save();

		}else{

			$mat = new Material;
			$mat->user_id = 0;
			$mat->dt1 = "data:image/jpeg;base64,".$img;
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

	public function admin_profile(Request $request) {
		$user_id = Auth::user()->id;
		$admin = User::find($user_id);
		return view('admin.profile', compact('admin'));
	}

	public function profile_save(Request $request)
	{
		// dd($request);
		$user_id = Auth::user()->id;
		$admin = User::find($user_id);
		$admin->user_name = $request->user_name;
		$admin->user_name_g = $request->user_name_g;
		$admin->zip1 = $request->zip1;
		$admin->zip2 = $request->zip2;
		$admin->pref = $request->pref;
		$admin->addr = $request->addr;
		$admin->str = $request->str;
		$admin->country = $request->country;
		$admin->phone = $request->phone;
		$admin->birthday = $request->birthday;
		$admin->gender = $request->gender;
		$admin->save();

		return redirect()->route('admin_profile');

	}

	public function change_password(Request $request)
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		$user->email = $request->email;
		if ($request->password == $request->password_confirm) {
			$user->password = Hash::make($request->password);
		}
		$user->save();
		return redirect()->route('logout');
	}

	public function company_edit(Request $request) {
		$company = Company::find($request->id);
		$user = User::find($company->user_id);
		$material = Material::where('user_id', $user->id)->first();
		$worktime = Worktime::where('company_id', $request->id)->first();
		return view('admin.edit_company', compact('company', 'user', 'material', 'worktime'));
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
		$company->service_employ = $request->service_employ;
		$company->service_attend = $request->service_attend;
		$company->labor_type = $request->labor_type;
		// $company->mon_total_days = $request->mon_total_days;
		$company->save();

		$worktime = Worktime::where('company_id', $request->company_id)->first();
		if (isset($worktime)) {
			$worktime->first_day = $request->labor_type == 0 ? 160 : $request->first_day;
			$worktime->second_day = $request->labor_type == 0 ? 160 : $request->second_day;
			$worktime->third_day = $request->labor_type == 0 ? 160 : $request->third_day;
			$worktime->fourth_day = $request->labor_type == 0 ? 160 : $request->fourth_day;
			$worktime->save();
		} else {
			$worktime = new Worktime;
			$worktime->company_id = $request->company_id;
			$worktime->first_day = $request->labor_type == 0 ? 160 : $request->first_day;
			$worktime->second_day = $request->labor_type == 0 ? 160 : $request->second_day;
			$worktime->third_day = $request->labor_type == 0 ? 160 : $request->third_day;
			$worktime->fourth_day = $request->labor_type == 0 ? 160 : $request->fourth_day;
			$worktime->save();
		}

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

		return redirect()->route('admin.dashboard');

	}

	public function company_delete(Request $request)
	{
		$id = $request->company_id;
		Company::find($id)->delete();
		User::where('company_id', $id)->where('role', 1)->delete();
	}

	public function add_star(Request $request)
	{
		$company = Company::find($request->company_id);
		if(isset($company->star)){
			if ($company->star == 0) {
				$company->star = "1";
			} else {
				$company->star = "0";
			}
		} else {
			$company->star = "1";
		}
		$company->save();
	}
}