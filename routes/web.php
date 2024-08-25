<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ExsettingController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\AttendanceController;

// Authentication Routes
Route::get('/profile/{id}', [LoginController::class, 'profile'])->name('profile');
Route::post('/user_update', [LoginController::class, 'user_update'])->name('user_update');
Route::get('/signup/{role?}', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/admin/login', [LoginController::class, 'loginview'])->name('loginview');
Route::get('/company-admin/login', [LoginController::class, 'loginview'])->name('loginview');
Route::get('/company-labor/login', [LoginController::class, 'loginview'])->name('loginview');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [LoginController::class, 'forgotPwd'])->name('forgot');
Route::get('reset_password', [LoginController::class, 'resetPwd'])->name('reset');
Route::get('reset_pwd', [LoginController::class, 'resetView'])->name('reset_pwd');
Route::post('update_password', [LoginController::class, 'updatePwd'])->name('password.update');
Route::get('/mypage/item_add', [MypageController::class, 'item_add'])->name('mypage.tem_add');
// Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function() {
	Route::prefix('admin')->group(function() {
		Route::get('/account', [AdminController::class, 'list_account'])->name('list_account');
		Route::get('/delete', [AdminController::class, 'delete_account'])->name('delete_account');
		Route::get('/permit', [AdminController::class, 'permit_account'])->name('permit_account');

		Route::get('/profile', [AdminController::class, 'admin_profile'])->name('admin_profile');
		Route::post('/profile_save', [AdminController::class, 'profile_save'])->name('profile_save');
		Route::post('/change_password', [AdminController::class, 'change_password'])->name('change_password');

		Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
		Route::get('/create_company', [AdminController::class, 'create_company'])->name('admin.create_company');
		Route::get('/sel_company_info', [AdminController::class, 'sel_company_info'])->name('admin.sel_company_info');
		Route::post('/create_company_save', [AdminController::class, 'create_company_save'])->name('admin.create_company_save');
		Route::post('/add_star', [AdminController::class, 'add_star'])->name('add_star');

		Route::get('/company/{id}', [AdminController::class, 'company'])->name('company');
		Route::get('/edit/{id}', [AdminController::class, 'company_edit'])->name('company_edit');
		Route::post('/save', [AdminController::class, 'company_edit_save'])->name('company_edit_save');
		Route::post('/delete', [AdminController::class, 'company_delete'])->name('company_delete');

		Route::post('/file_upload', [AdminController::class, 'file_upload'])->name('admin.file_upload');
	});
});
// Main Routes
Route::group(['middleware' => ['auth', 'company.admin']], function() {
	Route::prefix('company')->group(function() {
		
		Route::get('/working_time_set',[CompanyController::class, 'working_time_set'])->name('company.working_time_set');
		Route::post('/working_time_set_save', [CompanyController::class, 'working_time_set_save'])->name('company.working_time_set_save');

		Route::get('/staff_list',[CompanyController::class, 'staff_list'])->name('company.staff_list');
		Route::get('/staff_history',[CompanyController::class, 'staff_history'])->name('company.staff_history');
		// Route::get('/staff_history/{id}',[CompanyController::class, 'staff_history'])->name('company.staff_history');
		Route::get('/search_staff',[CompanyController::class, 'search_staff'])->name('company.search_staff');
		Route::get('/staff_add',[CompanyController::class, 'staff_add'])->name('company.staff_add');
		Route::post('/staff_get_sub_depart',[CompanyController::class, 'staff_get_sub_depart'])->name('company.staff_get_sub_depart');
		Route::post('/staff_create',[CompanyController::class, 'staff_create'])->name('company.staff_create');
		Route::post('/staff_retirement',[CompanyController::class, 'staff_retirement'])->name('company.staff_retirement');
		Route::post('/staff_returnwork',[CompanyController::class, 'staff_returnwork'])->name('company.staff_returnwork');
		Route::get('/staff_detail/{id}',[CompanyController::class, 'staff_detail'])->name('company.staff_detail');
		Route::get('/staff_edit/{id}',[CompanyController::class, 'staff_edit'])->name('company.staff_edit');
		Route::post('/staff_edit_save',[CompanyController::class, 'staff_edit_save'])->name('company.staff_edit_save');
		Route::get('/staff_delete/{id}',[CompanyController::class, 'staff_delete'])->name('company.staff_delete');
		Route::get('/job_create',[CompanyController::class, 'job_create'])->name('company.job_create');
		Route::post('/get_job', [CompanyController::class, 'get_job'])->name('company.get_job');
		Route::post('/job_add', [CompanyController::class, 'job_add'])->name('company.job_add');
		Route::post('/job_update', [CompanyController::class, 'job_update'])->name('company.job_update');
		Route::post('/job_delete', [CompanyController::class, 'job_delete'])->name('company.job_delete');
		Route::get('/job_history',[CompanyController::class, 'job_history'])->name('company.job_history');

		Route::get('/salary',[CompanyController::class, 'salary'])->name('company.salary');
		Route::post('/salary_create', [CompanyController::class, 'salary_create'])->name('company.salary_create');

		Route::get('/department_list',[CompanyController::class, 'department_list'])->name('company.department_list');
		Route::get('/department_history',[CompanyController::class, 'department_history'])->name('company.department_history');
		Route::get('/department_history/{id}',[CompanyController::class, 'department_history'])->name('company.departments_history');
		Route::post('/department_add',[CompanyController::class, 'department_add'])->name('company.department_add');
		Route::post('/department_save',[CompanyController::class, 'department_save'])->name('company.department_save');
		Route::post('/department_delete',[CompanyController::class, 'department_delete'])->name('company.department_delete');
		Route::post('/department_sel_info',[CompanyController::class, 'department_sel_info'])->name('company.department_sel_info');

		Route::post('/sub_department_add',[CompanyController::class, 'sub_department_add'])->name('company.sub_department_add');
		Route::post('/sub_department_sel_info',[CompanyController::class, 'sub_department_sel_info'])->name('company.sub_department_sel_info');
		Route::post('/sub_department_save',[CompanyController::class, 'sub_department_save'])->name('company.sub_department_save');
		Route::post('/sub_department_delete',[CompanyController::class, 'sub_department_delete'])->name('company.sub_department_delete');

		Route::get('/metaitem_list',[CompanyController::class, 'metaitem_list'])->name('company.metaitem_list');
		Route::post('/metaitem_add',[CompanyController::class, 'metaitem_add'])->name('company.metaitem_add');
		Route::post('/metaitem_save',[CompanyController::class, 'metaitem_save'])->name('company.metaitem_save');
		Route::post('/metaitem_sel_info',[CompanyController::class, 'metaitem_sel_info'])->name('company.metaitem_sel_info');
		Route::post('/metaitem_delete',[CompanyController::class, 'metaitem_delete'])->name('company.metaitem_delete');


		Route::get('/sheet_list',[CompanyController::class, 'sheet_list'])->name('company.sheet_list');
		Route::post('/sheet_add',[CompanyController::class, 'sheet_add'])->name('company.sheet_add');
		Route::post('/sheet_save',[CompanyController::class, 'sheet_save'])->name('company.sheet_save');
		Route::get('/sheet_sel_info',[CompanyController::class, 'sheet_sel_info'])->name('company.sheet_sel_info');
		Route::post('/sheet_delete',[CompanyController::class, 'sheet_delete'])->name('company.sheet_delete');
		Route::post('/sheet_return',[CompanyController::class, 'sheet_return'])->name('company.sheet_return');

		Route::get('/attend_list',[CompanyController::class, 'attend_list'])->name('company.attend_list');
		Route::post('/day_attend_list', [CompanyController::class, 'day_attend_list'])->name('company.attend_search_day');
		Route::post('/attend_search_depart', [CompanyController::class, 'attend_search_depart'])->name('company.attend_search_depart');

		Route::get('/attend_list_month',[CompanyController::class, 'attend_list_month'])->name('company.attend_list_month');
		Route::get('/attend_sheet_set',[CompanyController::class, 'attend_sheet_set'])->name('company.attend_sheet_set');
		Route::get('/user_attend/{id}',[CompanyController::class, 'user_attend'])->name('company.user_attend');
		Route::post('/month_user_attend',[CompanyController::class, 'month_user_attend'])->name('company.month_user_attend');

		Route::get('/staff_bug',[CompanyController::class, 'staff_bug'])->name('company.staff_bug');

		Route::get('/pay_list',[CompanyController::class, 'pay_list'])->name('company.pay_list');
		Route::post('/pay_add',[CompanyController::class, 'pay_add'])->name('company.pay_add');

		Route::get('/company_profile/{id}',[CompanyController::class, 'company_profile'])->name('company.company_profile');
		Route::post('/company_edit_save',[CompanyController::class, 'company_edit_save'])->name('company.company_edit_save');
		Route::post('/attendlist',[CompanyController::class, 'get_attendList'])->name('attendList.month');
		Route::post('/get_attend_data',[CompanyController::class, 'get_attend_data'])->name('company.get_attend_data');
		Route::post('/attend_update',[CompanyController::class, 'attend_update'])->name('company.attend_update');
		Route::post('/shift_set',[CompanyController::class, 'shift_set'])->name('company.shift_set');
		Route::post('/staff_leave',[CompanyController::class, 'staff_leave'])->name('company.staff_leave');
		Route::post('/return_leave',[CompanyController::class, 'return_leave'])->name('company.return_leave');
	});
});

Route::group(['middleware' => ['auth', 'user']], function() {
	Route::prefix('user')->group(function() {
		Route::get('/stamp', function() { return view('user.attendance_stamp'); })->name('stamp');
		Route::post('/attendance_work', [AttendanceController::class, 'attendance'])->name('attendance_work');
	});
});

Route::get('/', function(){ return view('top.top'); });
Route::get('/top', function(){ return view('top.top'); })->name('top');
Route::get('/plan', function(){ return view('top.plan'); })->name('plan');
Route::get('/contact', function() { return view('top.contact'); })->name('contact');
Route::get('/guide', function() { return view('top.useguide'); })->name('guide');
Route::get('/login', function(){ return view('auth.login'); })->name('login');
