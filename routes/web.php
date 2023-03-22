<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WareHousesController;
use App\Models\Equiment_Type;
use App\Models\storehouse;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Department;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\Admin\PersonnelController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\EquimentTypeController;
use App\Http\Controllers\EquimentsController;
use App\Http\Controllers\equipment\EquipmentController;
use App\Http\Controllers\PositionController;
use App\Jobs\SendEmailJob;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('addnhansu');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// Route::get('/personnel/delete', [App\Http\Controllers\PersonnelController::class, 'destroy'])->name('delete');
// Route::post('/personnel/add', [App\Http\Controllers\PersonnelController::class, 'store'])->name('create.user');

Route::group(['middleware' => 'auth'], function () {
	Route::get('department', [DepartmentController::class, 'index'])->name('department');
	Route::get('overview', [DepartmentController::class, 'overview'])->name('overview');
	Route::get('getEmployeeInDepartment/{id?}', [DepartmentController::class, 'getEmployeeInDepartment']);
	Route::get('get_departments', [DepartmentController::class, 'get_departments']);
	Route::post('search', [DepartmentController::class, 'search'])->name('department.search');
	Route::get('filter', [DepartmentController::class, 'filter'])->name('department.filter');
	Route::post('department', [DepartmentController::class, 'create_or_update'])->name('department.create_or_update');
	Route::delete('department', [DepartmentController::class, 'delete'])->name('department.delete');

	Route::post('searchUser', [DepartmentController::class, 'searchUsers'])->name('department.searchUsers');
	Route::get('department/{id?}', [DepartmentController::class, 'display'])->name('department.display');
	Route::get('department/user/{id?}', [DepartmentController::class, 'user'])->name('department.user');
	Route::get('department/get_users/{id?}/{user_max?}', [DepartmentController::class, 'get_users'])->name('department.get_users');
	Route::post('addUser', [DepartmentController::class, 'addUser'])->name('department.addUser');
	Route::post('deleteUser', [DepartmentController::class, 'deleteUser'])->name('department.deleteUser');
	Route::post('updateUser', [DepartmentController::class, 'updateUser'])->name('department.updateUser');

	Route::get('position', [PositionController::class, 'index'])->name("position");
	Route::get('get_position', [PositionController::class, 'get_positions']);
	Route::post('delete_position', [PositionController::class, 'delete_position'])->name('department.delete_position');
	Route::post('delete_nominee', [PositionController::class, 'delete_nominee'])->name('department.delete_nominee');
	Route::post('update_position', [PositionController::class, 'update_position'])->name('department.update_position');
	Route::post('update_nominee', [PositionController::class, 'update_nominee'])->name('department.update_nominee');
	Route::post('add_position', [PositionController::class, 'add_position'])->name('department.add_position');
	Route::post('add_nominee', [PositionController::class, 'add_nominee'])->name('department.add_nominee');

	//personnel

	Route::get('/personnel', [PersonnelController::class, 'show'])->name('personnel');
	Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
	Route::post('/personnel/new-user', [PersonnelController::class, 'add_new_user'])->name('add_new_user');
	Route::get('/personnel/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');
	Route::delete('/personnel', [PersonnelController::class, 'destroy'])->name('delete');
	Route::post('/personnel/add', [PersonnelController::class, 'store'])->name('create.user');
	Route::post('/personnel', [PersonnelController::class, 'update'])->name('update.user');
	Route::get('/personnel/search', [PersonnelController::class, 'search'])->name('Search');
	Route::post('/personnel/search-interviewer', [PersonnelController::class, 'search_interviewer'])->name('search_interviewer');
	Route::get('/personnel/search-cv', [PersonnelController::class, 'search_cv'])->name('search_cv');
	Route::get('/personnel/search-offer', [PersonnelController::class, 'search_offer'])->name('search_offer');
	Route::post('/personnel/profile', [UserProfileController::class, 'update_profile'])->name('update.profile');
	Route::post('/personnel/level', [PersonnelController::class, 'update_level'])->name('update.level');
	Route::get('/personnel/fillter', [PersonnelController::class, 'fillter'])->name('fillter');
	Route::get('/personnel/fillter-cv', [PersonnelController::class, 'fillter_cv'])->name('fillter_cv');
	Route::get('/personnel/fillter-offer', [PersonnelController::class, 'fillter_offer'])->name('fillter_offer');
	Route::get('/personnel/nominees', [PersonnelController::class, 'nominees'])->name('nominees');
	Route::get('/personnel/nominees-first', [PersonnelController::class, 'nominees_first'])->name('nominees_first');
	Route::get('/personnel/nominees-cv', [PersonnelController::class, 'nominees_cv'])->name('nominees_cv');
	Route::get('/personnel/cv', [PersonnelController::class, 'getAllCVT'])->name('getcv');
	Route::get('/personnel/cv-count', [PersonnelController::class, 'getcount'])->name('getcount');
	Route::get('/personnel/interview', [PersonnelController::class, 'getAllInter'])->name('getcv');
	Route::get('/personnel/cv-id', [PersonnelController::class, 'getCVbyID'])->name('getCVbyID');
	Route::post('/personnel/cv-id', [PersonnelController::class, 'update_status_cv'])->name('update_status_cv');
	Route::post('/personnel/cv', [PersonnelController::class, 'saveCV'])->name('savecv');
	Route::post('/personnel/cv-u', [PersonnelController::class, 'update_cv'])->name('update_cv');
	Route::get('/personnel/cv-u', [PersonnelController::class, 'get_cv_update'])->name('get_cv_update');
	Route::post('/personnel/cv-update', [PersonnelController::class, 'update_cv_all'])->name('update_cv_all');
	Route::post('/personnel/interview', [PersonnelController::class, 'Add_interview'])->name('Add_interview');
	Route::post('/personnel/interview/update', [PersonnelController::class, 'update_xd_interview'])->name('update_xd_interview');
	Route::get('/personnel/interview/find', [PersonnelController::class, 'find_interviewer'])->name('find_interviewer');
	Route::get('/personnel/offer', [PersonnelController::class, 'offer_cv'])->name('offer_cv');
	Route::post('/personnel/offer', [PersonnelController::class, 'send_offer'])->name('send_offer');
	Route::get('/personnel/detail', [PersonnelController::class, 'get_personnel_detail_equipment'])->name('get_personnel_detail_equipment');
	Route::get('/equipment/personnel', [PersonnelController::class, 'get_all_personnel_in_equipment'])->name('get_all_personnel_in_equipment');
	Route::get('/equipment_detail/allocation', [EquipmentController::class, 'get_all_equipment_detail_paginate_staus_0'])->name('get_all_equipment_detail_paginate_staus_0');
	//autho
	Route::get('/authorization', [AuthorizationController::class, 'index'])->name('index.authorization');
	Route::get('/authorization/id', [AuthorizationController::class, 'getAutho_Detail_By_Id'])->name('getAutho_Detail_By_Id');
	Route::post('/authorization/insert', [AuthorizationController::class, 'save'])->name('insert.authorization');
	Route::delete('/authorization', [AuthorizationController::class, 'delete'])->name('delete.authorization');
	Route::post('/authorization/recall', [AuthorizationController::class, 'recall_autho_user'])->name('recall_autho_user');
	Route::get('/authorization/user', [AuthorizationController::class, 'get_user_by_department'])->name('get_user_by_department');
	Route::post('/authorization/add', [AuthorizationController::class, 'set_autho_for_user'])->name('set_autho_for_user');
	Route::get('/authorization/search', [AuthorizationController::class, 'search_autho'])->name('search_autho');
	Route::post('/authorization', [AuthorizationController::class, 'set_page_size_autho'])->name('set_page_size_autho');
	Route::get('/authorization/all', [AuthorizationController::class, 'getAll_autho'])->name('getAll_autho');
	// thiết bị
	Route::get('/equipment', [EquipmentController::class, 'index'])->name('index.equipment');
	Route::post('/equipment', [EquipmentController::class, 'insert_equipment'])->name('insert.equipment');
	Route::get('/equiment_detail/paginate', [EquipmentController::class, 'get_all_equipment_paginate'])->name('get_all_equipment_paginate');
	Route::get('/equipment_detail', [EquipmentController::class, 'get_equipment_detail_by_equipment'])->name('get_equipment_detail_by_equipment');
	Route::get('/equipment_detail/product', [EquipmentController::class, 'get_all_equipment_detail'])->name('get_all_equipment_detail');
	Route::get('/equipment_detail/u', [EquipmentController::class, 'get_equipment_detail_by_id'])->name('get_equipment_detail_by_id');
	Route::post('/equipment_detail', [EquipmentController::class, 'update_equipment_detail'])->name('update_equipment_detail');
	Route::get('/equipment_detail_update', [EquipmentController::class, 'get_equipment_detail_paginate'])->name('get_equipment_detail_paginate');
	Route::get('/equipment_supplier', [EquipmentController::class, 'get_all_equipment_supplier'])->name('get_all_equipment_supplier');
	Route::get('/equipment_type', [EquipmentController::class, 'get_all_equipment_type'])->name('get_all_equipment_type');
	Route::delete('/equipment_type', [EquipmentController::class, 'delete_equipment_type_by_id'])->name('delete_equipment_type_by_id');
	Route::get('/equipment_type/s', [EquipmentController::class, 'get_equipment_type_by_id'])->name('get_equipment_type_by_id');
	Route::post('/equipment_type', [EquipmentController::class, 'insert_emquipment_types'])->name('insert_emquipment_types');
	Route::get('/equipment/search', [EquipmentController::class, 'search_emquipment'])->name('search_emquipment');
	Route::get('/equipment_search', [EquipmentController::class, 'search_emquipment_paginate'])->name('search_emquipment_paginate');
	Route::post('/equipment/add/quantity', [EquipmentController::class, 'add_emquipment_quantity'])->name('add_emquipment_quantity');
	Route::post('/suppliers', [EquipmentController::class, 'save_suppliers'])->name('save_suppliers');
	Route::get('/suppliers', [EquipmentController::class, 'get_ALL_Suppliers'])->name('get_ALL_Suppliers');
	Route::get('/supplier/s', [EquipmentController::class, 'get_suppliers_by_id'])->name('get_suppliers_by_id');
	Route::delete('/suppliers', [EquipmentController::class, 'delete_Suppliers_by_id'])->name('delete_Suppliers_by_id');
	Route::post('/equipment/update', [EquipmentController::class, 'update_equipment'])->name('update_equipment');
	Route::get('/equipment/fillter', [EquipmentController::class, 'equipment_fillter'])->name('equipment_fillter');
	Route::post('/equipment_detail/delete', [EquipmentController::class, 'equipment_detail_delete'])->name('equipment_detail_delete');
	Route::get('/equipment/allocation', [EquipmentController::class, 'get_all_equipment_staus_0'])->name('get_all_equipment_staus_0');
	Route::post('/equipment/allocation', [EquipmentController::class, 'allocation_equipment'])->name('allocation_equipment');
	Route::get('/equipment_detail/allocation/get', [EquipmentController::class, 'equipment_detail_allocation'])->name('equipment_detail_allocation');

	// phần trường làm 
	Route::group(
		['middleware' => 'auth'],
		function () {
			//End route thiết bị
			Route::post(
				'get_departments',
				function (Request $request) {
					$search = $request->search;

					if ($search == '') {
						$departments = Department::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
					} else {
						$departments = Department::orderby('name', 'asc')->select('id', 'name')->where('name', 'like', '%' . $search . '%')->limit(5)->get();
					}

					$response = array();
					foreach ($departments as $department) {
						$response[] = array("value" => $department->id, "label" => $department->name);
					}

					return response()->json($response);
				}
			)->name('department.get_departments');
			// Route::post('department', [DepartmentController::class, 'create'])->name('department.create');
			Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
			Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
			Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
			Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
			Route::get('/{page}', [PageController::class, 'index'])->name('page');
			Route::post('logout', [LoginController::class, 'logout'])->name('logout');
		}
	);
});
