<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role admin
    	$adminRole = new Role();
    	$adminRole->name = "admin";
    	$adminRole->display_name = "Admin";
    	$adminRole->save();
        // Membuat Akun admin
    	$admin = new User();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@gmail.com';
    	$admin->password = bcrypt('rahasia');
    	$admin->save();
    	$admin->attachRole($adminRole);
        // Membuat role karyawan
        $karyawanRole = new Role();
        $karyawanRole->name = "karyawan";
        $karyawanRole->display_name = "Karyawan";
        $karyawanRole->save();
        // Membuat role karyawan
        $karyawan = new User();
        $karyawan->name = 'Karyawan';
        $karyawan->email = 'karyawan@gmail.com';
        $karyawan->password = bcrypt('rahasia');
        $karyawan->save();
        $karyawan->attachRole($karyawanRole);
    }
}
