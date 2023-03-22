<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\equiment;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $position = [
            ['id' => 1, 'position' => 'Tổng Giám Đốc', 'level' => 1],
            ['id' => 2, 'position' => 'Giám Đốc', 'level' => 2],
            ['id' => 3, 'position' => 'Phó Giám Đốc', 'level' => 3],
            ['id' => 4, 'position' => 'Trưởng Phòng', 'level' => 4],
            ['id' => 5, 'position' => 'Phó Phòng', 'level' => 5],
            ['id' => 6, 'position' => 'Quản Lý Cấp Cao', 'level' => 6],
            ['id' => 7, 'position' => 'Quản Lý', 'level' => 7],
            ['id' => 8, 'position' => 'Trưởng Nhóm', 'level' => 8],
            ['id' => 9, 'position' => 'Chuyên Viên', 'level' => 9],
            ['id' => 10, 'position' => 'Nhân Viên', 'level' => 10],
            ['id' => 11, 'position' => 'Thử Việc', 'level' => 11],
            ['id' => 12, 'position' => 'Học Việc', 'level' => 12],
            ['id' => 13, 'position' => 'Thực Tập', 'level' => 13],
        ];

        DB::table('positions')->insert($position);

        $autho = [
            ['id' => 1, 'name_autho' => 'Full Quyền', 'authority' => '"true"', 'personnel' => '{"personnel_autho_access":"true","insert_personnel":"true","update_personnel":"true","delete_personnel":"true","accept_cv_autho":"true","update_cv_autho":"true","inter_cv_autho":"true","eva_cv_autho":"true","offer_cv_autho":"true","faild_cv_autho":"true"}', 'departments' => 'null', 'equipment' => 'null'],
        ];

        DB::table('authorities')->insert($autho);
        $nominees = [
            [
                'id' => 1,
                'position_id' => '1',
                'nominees' => 'Tổng Giám Đốc Công Ty TNHH ABC'
            ],
            ['id' => 2, 'position_id' => '1', 'nominees' => 'Tổng Giám Đốc Công Ty Cổ Phần XYZ'],
            ['id' => 3, 'position_id' => '2', 'nominees' => 'Giám Đốc Kỹ Thuật'],
            ['id' => 4, 'position_id' => '2', 'nominees' => 'Giám Đốc Maketing'],
            ['id' => 5, 'position_id' => '2', 'nominees' => 'Giám Đốc Pháp Chế'],
            ['id' => 6, 'position_id' => '2', 'nominees' => 'Giám Đốc Nhân Sự'],
            ['id' => 7, 'position_id' => '2', 'nominees' => 'Giám đốc Tài Chính'],
            ['id' => 8, 'position_id' => '2', 'nominees' => 'Giám đốc Vận Hành'],
            ['id' => 9, 'position_id' => '3', 'nominees' => 'Phó Giám Đốc Kỹ Thuật'],
            ['id' => 10, 'position_id' => '3', 'nominees' => 'Phó Giám Đốc Maketing'],
            ['id' => 11, 'position_id' => '3', 'nominees' => 'Phó Giám Đốc Pháp Chế'],
            ['id' => 12, 'position_id' => '3', 'nominees' => 'Phó Giám Đốc Nhân Sự'],
            ['id' => 13, 'position_id' => '3', 'nominees' => 'Phó Giám đốc Tài Chính'],
            ['id' => 14, 'position_id' => '3', 'nominees' => 'Phó Giám đốc Vận Hành'],
            ['id' => 15, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Kỹ Thuật'],
            ['id' => 16, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Maketing'],
            ['id' => 17, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Pháp Chế'],
            ['id' => 18, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Nhân Sự'],
            ['id' => 19, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Tài Chính'],
            ['id' => 20, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Vận Hành'],
            ['id' => 21, 'position_id' => '4', 'nominees' => 'Trưởng Phòng Kinh Doanh'],
            ['id' => 22, 'position_id' => '5', 'nominees' => 'Phó Phòng Kỹ Thuật'],
            ['id' => 23, 'position_id' => '5', 'nominees' => 'Phó Phòng Maketing'],
            ['id' => 24, 'position_id' => '5', 'nominees' => 'Phó Phòng Pháp Chế'],
            ['id' => 25, 'position_id' => '5', 'nominees' => 'Phó Phòng Nhân Sự'],
            ['id' => 26, 'position_id' => '5', 'nominees' => 'Phó Phòng Tài Chính'],
            ['id' => 27, 'position_id' => '5', 'nominees' => 'Phó Phòng Vận Hành'],
            ['id' => 28, 'position_id' => '5', 'nominees' => 'Phó Phòng Kinh Doanh'],
            ['id' => 29, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Kỹ Thuật'],
            ['id' => 30, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Maketing'],
            ['id' => 31, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Pháp Chế'],
            ['id' => 32, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Nhân Sự'],
            ['id' => 33, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Tài Chính'],
            ['id' => 34, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Vận Hành'],
            ['id' => 35, 'position_id' => '6', 'nominees' => 'Quản Lý Cấp Cao Kinh Doanh'],
            ['id' => 36, 'position_id' => '7', 'nominees' => 'Quản Lý A'],
            ['id' => 37, 'position_id' => '7', 'nominees' => 'Quản Lý B'],
            ['id' => 38, 'position_id' => '7', 'nominees' => 'Quản Lý C'],
            ['id' => 39, 'position_id' => '7', 'nominees' => 'Quản Lý D'],
            ['id' => 40, 'position_id' => '7', 'nominees' => 'Quản Lý E'],
            ['id' => 41, 'position_id' => '7', 'nominees' => 'Quản Lý F'],
            ['id' => 42, 'position_id' => '7', 'nominees' => 'Quản Lý G'],
            ['id' => 43, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm A'],
            ['id' => 44, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm B'],
            ['id' => 45, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm C'],
            ['id' => 46, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm D'],
            ['id' => 47, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm E'],
            ['id' => 48, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm F'],
            ['id' => 49, 'position_id' => '8', 'nominees' => 'Trưởng Nhóm G'],
            ['id' => 50, 'position_id' => '9', 'nominees' => 'Chuyên Viên A'],
            ['id' => 51, 'position_id' => '9', 'nominees' => 'Chuyên Viên B'],
            ['id' => 52, 'position_id' => '9', 'nominees' => 'Chuyên Viên C'],
            ['id' => 53, 'position_id' => '9', 'nominees' => 'Chuyên Viên D'],
            ['id' => 54, 'position_id' => '9', 'nominees' => 'Chuyên Viên E'],
            ['id' => 55, 'position_id' => '9', 'nominees' => 'Chuyên Viên F'],
            ['id' => 56, 'position_id' => '9', 'nominees' => 'Chuyên Viên G'],
            ['id' => 57, 'position_id' => '10', 'nominees' => 'Nhân Viên A'],
            ['id' => 58, 'position_id' => '10', 'nominees' => 'Nhân Viên B'],
            ['id' => 59, 'position_id' => '10', 'nominees' => 'Nhân Viên C'],
            ['id' => 60, 'position_id' => '10', 'nominees' => 'Nhân Viên D'],
            ['id' => 61, 'position_id' => '10', 'nominees' => 'Nhân Viên E'],
            ['id' => 62, 'position_id' => '10', 'nominees' => 'Nhân Viên F'],
            ['id' => 63, 'position_id' => '10', 'nominees' => 'Nhân Viên G'],
            ['id' => 64, 'position_id' => '11', 'nominees' => 'Thử Việc A'],
            ['id' => 65, 'position_id' => '11', 'nominees' => 'Thử Việc B'],
            ['id' => 66, 'position_id' => '11', 'nominees' => 'Thử Việc C'],
            ['id' => 67, 'position_id' => '11', 'nominees' => 'Thử Việc D'],
            ['id' => 68, 'position_id' => '11', 'nominees' => 'Thử Việc E'],
            ['id' => 69, 'position_id' => '11', 'nominees' => 'Thử Việc F'],
            ['id' => 70, 'position_id' => '11', 'nominees' => 'Thử Việc G'],
            ['id' => 71, 'position_id' => '12', 'nominees' => 'Học Việc A'],
            ['id' => 72, 'position_id' => '12', 'nominees' => 'Học Việc B'],
            ['id' => 73, 'position_id' => '12', 'nominees' => 'Học Việc C'],
            ['id' => 74, 'position_id' => '12', 'nominees' => 'Học Việc D'],
            ['id' => 75, 'position_id' => '12', 'nominees' => 'Học Việc E'],
            ['id' => 76, 'position_id' => '12', 'nominees' => 'Học Việc F'],
            ['id' => 77, 'position_id' => '12', 'nominees' => 'Học Việc G'],
            ['id' => 78, 'position_id' => '13', 'nominees' => 'Thực Tập A'],
            ['id' => 79, 'position_id' => '13', 'nominees' => 'Thực Tập B'],
            ['id' => 80, 'position_id' => '13', 'nominees' => 'Thực Tập C'],
            ['id' => 81, 'position_id' => '13', 'nominees' => 'Thực Tập D'],
            ['id' => 82, 'position_id' => '13', 'nominees' => 'Thực Tập E'],
            ['id' => 83, 'position_id' => '13', 'nominees' => 'Thực Tập F'],
            ['id' => 84, 'position_id' => '13', 'nominees' => 'Thực Tập G'],
        ];

        DB::table('nominees')->insert($nominees);

        $data = [
            ['id' => 1, "code" => 'SNC1', 'name' => 'Sconnect', '_lft' => 1, '_rgt' => 20, 'parent_id' => NULL],
            ['id' => 2, "code" => 'SNC2', 'name' => 'Phòng Công Nghệ', '_lft' => 2, '_rgt' => 9, 'parent_id' => 1],
            ['id' => 3, "code" => 'SNC3', 'name' => 'Nhóm Phát Triển Phần Mềm', '_lft' => 3, '_rgt' => 6, 'parent_id' => 2],
            ['id' => 4, "code" => 'SNC4', 'name' => 'Nhóm Quản Trị Hệ Thống', '_lft' => 7, '_rgt' => 8, 'parent_id' => 2],
            ['id' => 5, "code" => 'SNC5', 'name' => 'Phòng Hành Chính Nhân Sự', '_lft' => 18, '_rgt' => 19, 'parent_id' => 1],
            ['id' => 6, "code" => 'SNC7', 'name' => 'Phòng Pháp Chế', '_lft' => 10, '_rgt' => 13, 'parent_id' => 1],
            ['id' => 7, "code" => 'SNC8', 'name' => 'Phòng Pháp Chế 1', '_lft' => 11, '_rgt' => 12, 'parent_id' => 6],
            ['id' => 8, "code" => 'SNC7', 'name' => 'Phòng Pháp Chế', '_lft' => 18, '_rgt' => 19, 'parent_id' => 1]
        ];
        DB::table('departments')->insert($data);

        $equipmenttypes = [
            ['id' => 1, 'name' => 'Màn hình', 'code' => 'SCR'],
            ['id' => 2, 'name' => 'Case', 'code' => 'DES'],
            ['id' => 3, 'name' => 'Bàn phím không dây', 'code' => 'WKYB'],
            ['id' => 4, 'name' => 'Bàn phím có dây', 'code' => 'KYBL'],
            ['id' => 5, 'name' => 'Chuột không dây', 'code' => 'MSEN'],
            ['id' => 6, 'name' => 'Chuột có dây', 'code' => 'MSEY'],
            ['id' => 7, 'name' => 'Laptop', 'code' => 'LAP'],
            ['id' => 8, 'name' => 'Model mạng', 'code' => 'MDL'],
            ['id' => 9, 'name' => 'Tai nghe', 'code' => 'EAP'],
            ['id' => 10, 'name' => 'Link kiện', 'code' => 'CRM'],
        ];
        DB::table('equipment_types')->insert($equipmenttypes);

        $suppliers = [
            ['id' => 1, 'name' => 'Gaming Gear'],
            ['id' => 2, 'name' => 'MSI'],
            ['id' => 3, 'name' => 'Acer'],
            ['id' => 4, 'name' => 'Hp'],
            ['id' => 5, 'name' => 'Logitech'],
            ['id' => 6, 'name' => 'Viettel'],
            ['id' => 7, 'name' => 'Vinaphone'],
            ['id' => 8, 'name' => 'FPT'],
            ['id' => 9, 'name' => 'samsung'],
        ];
        DB::table('suppliers')->insert($suppliers);
        $equipments = [
            ['id' => 1,  'id_type' => 9, 'code' => 'SKU' . time() + 1, 'name' => 'tai nghe bluetooth samsung galaxy buds live đen (r180)'],
            ['id' => 2,  'id_type' => 3, 'code' => 'SKU' . time() + 2, 'name' => 'bàn phím cơ không dây dareu ek807g '],
            ['id' => 3,  'id_type' => 1, 'code' => 'SKU' . time() + 3, 'name' => 'màn hình dell u2419h'],
            ['id' => 4,  'id_type' => 6, 'code' => 'SKU' . time() + 4, 'name' => 'chuột logitech g102 lightsync rgb black'],
            ['id' => 5,  'id_type' => 10, 'code' => 'SKU' . time() + 5, 'name' => 'ram kingston fury beast rgb kf552c36bbeak2 16'],
            ['id' => 6,  'id_type' => 10, 'code' => 'SKU' . time() + 6, 'name' => 'ssd m2 nvme 256gb gigabyte'],
            ['id' => 7,  'id_type' => 10, 'code' => 'SKU' . time() + 7, 'name' => 'card đồ họa nvidia geforce gtx 1060 6g'],
            ['id' => 8,  'id_type' => 10, 'code' => 'SKU' . time() + 8, 'name' => 'nguồn máy tính 500w xigmatek z-power 600'],
            ['id' => 9,  'id_type' => 1,  'code' => 'SKU' . time() + 9, 'name' => 'ram 8gb ddr4 3200mhz samsung'],
            ['id' => 10, 'id_type' => 6,  'code' => 'SKU' . time() + 10, 'name' => 'hdd toshiba 2tb 7200rpm'],
            ['id' => 11, 'id_type' => 10, 'code' => 'SKU' . time() + 11, 'name' => 'bàn phím logitech k380'],
            ['id' => 12, 'id_type' => 10, 'code' => 'SKU' . time() + 12, 'name' => 'màn hình asus tuf gaming vg249q1a 24 ips 165hz gsync'],
            ['id' => 13, 'id_type' => 10, 'code' => 'SKU' . time() + 13, 'name' => 'laptop asus vivobook flip 14 tp470ea ec346w '],
            ['id' => 14, 'id_type' => 10, 'code' => 'SKU' . time() + 14, 'name' => 'macbook air m1 16gb 512gb '],
        ];
        DB::table('equipment')->insert($equipments);
        $equipment_details = [
            ['id' => 1, 'id_equipment' => 1, 'equipment_code' => 'SKU000010011', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 2, 'id_equipment' => 1, 'equipment_code' => 'SKU00000201', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 3, 'id_equipment' => 1, 'equipment_code' => 'SKU000013', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 4, 'id_equipment' => 1, 'equipment_code' => 'SKU00000401', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 5, 'id_equipment' => 1, 'equipment_code' => 'SKU00000501', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 6, 'id_equipment' => 1, 'equipment_code' => 'SKU00000601', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 7, 'id_equipment' => 1, 'equipment_code' => 'SKU000008701', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 8, 'id_equipment' => 1, 'equipment_code' => 'SKU00000071', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 9, 'id_equipment' => 1, 'equipment_code' => 'SKU00000091', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 10, 'id_equipment' => 1, 'equipment_code' => 'SKU00008001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 11, 'id_equipment' => 1, 'equipment_code' => 'SKU000019001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 12, 'id_equipment' => 1, 'equipment_code' => 'SKU00001001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 15, 'id_equipment' => 1, 'equipment_code' => 'SKU00040001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 13, 'id_equipment' => 1, 'equipment_code' => 'SKU00002001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 17, 'id_equipment' => 1, 'equipment_code' => 'SKU00060001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 14, 'id_equipment' => 1, 'equipment_code' => 'SKU00003001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 19, 'id_equipment' => 1, 'equipment_code' => 'SKU00080001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 16, 'id_equipment' => 1, 'equipment_code' => 'SKU00050001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 21, 'id_equipment' => 1, 'equipment_code' => 'SKU000100001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 18, 'id_equipment' => 1, 'equipment_code' => 'SKU00070001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 23, 'id_equipment' => 1, 'equipment_code' => 'SKU000120001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 20, 'id_equipment' => 1, 'equipment_code' => 'SKU00009001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 25, 'id_equipment' => 2, 'equipment_code' => 'SKU000140002', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'dareu', 'date_added' => Carbon::now(), 'supplier_id' => 8],
            ['id' => 22, 'id_equipment' => 1, 'equipment_code' => 'SKU000110001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 27, 'id_equipment' => 4, 'equipment_code' => 'SKU001400004', 'warranty_expiration_date' => '2024/03/12',  'specifications' => ' g102 lightsync rgb black', 'date_added' => Carbon::now(), 'supplier_id' => 6],
            ['id' => 24, 'id_equipment' => 1, 'equipment_code' => 'SKU000130001', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'Samsung', 'date_added' => Carbon::now(), 'supplier_id' => 9],
            ['id' => 29, 'id_equipment' => 6, 'equipment_code' => 'SKU017000006', 'warranty_expiration_date' => '2024/03/12',  'specifications' => ' m2 nvme 256gb gigabyte', 'date_added' => Carbon::now(), 'supplier_id' => 4],
            ['id' => 26, 'id_equipment' => 3, 'equipment_code' => 'SKU000015003', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'dell u2419h', 'date_added' => Carbon::now(), 'supplier_id' => 7],
            ['id' => 31, 'id_equipment' => 8, 'equipment_code' => 'SKU002000008', 'warranty_expiration_date' => '2024/03/12',  'specifications' => '500w xigmatek z-power 600', 'date_added' => Carbon::now(), 'supplier_id' => 2],
            ['id' => 28, 'id_equipment' => 5, 'equipment_code' => 'SKU000016005', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'fury beast rgb kf552c36bbeak2 16', 'date_added' => Carbon::now(), 'supplier_id' => 5],
            ['id' => 30, 'id_equipment' => 7, 'equipment_code' => 'SKU000018007', 'warranty_expiration_date' => '2024/03/12',  'specifications' => 'gtx 1060 6g', 'date_added' => Carbon::now(), 'supplier_id' => 3],
        ];
        DB::table('equipment_details')->insert($equipment_details);

        // $equipments = [
        //     ['id' => 1, 'name' => 'Gaming Gear', 'image' => '1.jpg', 'specifications' => 'Ngon - bổ - rẻ', 'status' => 0, 'price' => 10000000,  'warranty_date' => '2023/2/25', 'equipment_type_id' => 1, 'supplier_id' => 1],
        //     ['id' => 2, 'name' => 'Gaming Gear 1', 'image' => '1.jpg', 'specifications' => 'Ngon - bổ - rẻ', 'status' => 0, 'price' => 10000000,  'warranty_date' => '2023/2/25', 'equipment_type_id' => 2, 'supplier_id' => 2],
        //     ['id' => 3, 'name' => 'Gaming Gear 2', 'image' => '1.jpg', 'specifications' => 'Ngon - bổ - rẻ', 'status' => 0, 'price' => 10000000,  'warranty_date' => '2023/2/25', 'equipment_type_id' => 3, 'supplier_id' => 3],
        //     ['id' => 4, 'name' => 'Gaming Gear 3', 'image' => '1.jpg', 'specifications' => 'Ngon - bổ - rẻ', 'status' => 0, 'price' => 10000000,  'warranty_date' => '2023/2/25', 'equipment_type_id' => 4, 'supplier_id' => 4],
        //     ['id' => 5, 'name' => 'Gaming Gear 4', 'image' => '1.jpg', 'specifications' => 'Ngon - bổ - rẻ', 'status' => 0, 'price' => 10000000,  'warranty_date' => '2023/2/25', 'equipment_type_id' => 5, 'supplier_id' => 4],
        // ];
        // DB::table('equipments')->insert($equipments);

        // $storehouses = [
        //     ['id' => 1, 'name' => 'Kho 1', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 2, 'name' => 'Kho 2', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 3, 'name' => 'Kho 3', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 4, 'name' => 'Kho 4', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 5, 'name' => 'Kho 5', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 6, 'name' => 'Kho 6', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 7, 'name' => 'Kho 7', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 8, 'name' => 'Kho 8', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        //     ['id' => 9, 'name' => 'Kho 9', 'image' => 'Ảnh.jpg', 'address' => 'Địa chỉ 1', 'status' => true],
        // ];
        // DB::table('storehouses')->insert($storehouses);


        // $use_details = [
        //     ['id' => 1, 'user_id' => 1, 'equipment_id' => 1, 2],
        //     ['id' => 2, 'user_id' => 2, 'equipment_id' => 2, 2],
        // ];
        // DB::table('use_details')->insert($use_details);
        DB::table('users')->insert([
            'fullname' => 'Đặng Anh Tuấn',
            'email' => 'admin@argon.com',
            'password' => bcrypt('admin'),
            'personnel_code' => 'SCN0001',
            'level' => 2,
            'img_url' => 'marie.jpg',
            'autho' => 1,
        ]);
    }
}
