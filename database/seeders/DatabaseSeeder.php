<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\EmployeeLeave;
use App\Models\PatientDailySummary;
use App\Models\PatientMedicine;
use App\Models\PatientStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // These are the predefined data that will be inserted into the database when the application is installed

         DB::table('funds')->insert([
             'type' => 'Board',
             'balance' => 0,
         'created_at' => now(),
         'updated_at' => now(),
         ]);
         DB::table('funds')->insert([
             'type' => 'Lab',
             'balance' => 0,
         'created_at' => now(),
         'updated_at' => now(),
         ]);

         // fund_departments
         DB::table('fund_departments')->insert([
             'id' => 1,
             'name' => 'ICU',
             'slug' => 'icu',
             'fund_id' => 1,
             'created_at' => now(),
             'updated_at' => now(),
         ]);
         DB::table('fund_departments')->insert([
             'id' => 2,
             'name' => 'OT',
             'slug' => 'ot',
             'fund_id' => 1,
             'created_at' => now(),
             'updated_at' => now(),
         ]);
                DB::table('fund_departments')->insert([
                     'id' => 5,
                     'name' => 'Radiology',
                     'slug' => 'radiology',
                     'fund_id' => 2,
                     'created_at' => now(),
                     'updated_at' => now(),
                 ]);
                DB::table('fund_departments')->insert([
                    'id' => 6,
                    'name' => 'Pathology',
                    'slug' => 'pathology',
                    'fund_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('patient_discounts')->insert([
                    'patient_type' => 'GENERAL',
                    'discount' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('patient_discounts')->insert([
                    'patient_type' => 'DMSC',
                    'discount' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('patient_discounts')->insert([
                    'patient_type' => 'MOD',
                    'discount' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('patient_discounts')->insert([
                    'patient_type' => 'MED',
                    'discount' => 15,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('patient_discounts')->insert([
                    'patient_type' => 'CBD',
                    'discount' => 9,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

        //        add Uncategorized fund department for both find type
                DB::table('fund_departments')->insert([
                    'id' => 3,
                    'name' => 'Uncategorized',
                    'slug' => 'board-uncategorized',
                    'fund_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('fund_departments')->insert([
                    'id' => 4,
                    'name' => 'Uncategorized',
                    'slug' => 'lab-uncategorized',
                    'fund_id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

//                add admin user
                DB::table('users')->insert([
                    'name' => 'Admin',
                    'email' => 'admin@mail.com',
                    'password' => bcrypt('password'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'department_id' => 1,
                ]);


    }
}
