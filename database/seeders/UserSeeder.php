<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            /**
             *  ==== AKADEMIK ====
             */
            [
                'name'      => '',
                'password'  => bcrypt('inipasswordkah?'),
                'role'      => 'Akademik',
                'is_admin'  => false
            ],
            [
                'name'      => 'dian',
                'password'  => bcrypt('piyetoki?'),
                'role'      => 'Akademik',
                'is_admin'  => false
            ],
            /**
             *  ==== KEUANGAN ====
             */
            [
                'name'      => 'tatiek',
                'password'  => bcrypt('teruspiye!'),
                'role'      => 'Keuangan',
                'is_admin'  => false
            ],
            [
                'name'      => 'santi',
                'password'  => bcrypt('terusgitu!'),
                'role'      => 'Keuangan',
                'is_admin'  => false
            ],
            /**
             *  ==== P3M ====
             */
            [
                'name'      => 'anis',
                'password'  => bcrypt('kudukuat!'),
                'role'      => 'P3M',
                'is_admin'  => false
            ], 
             /**
             *  ==== PLK ====
             */
            [
                'name'      => 'retta',
                'password'  => bcrypt('poosengaku!'),
                'role'      => 'PLK',
                'is_admin'  => false
            ],  
             /**
             *  ==== Asdir 1 ====
             */
            [
                'name'      => 'fitro',
                'password'  => bcrypt('nggakosongkok!'),
                'role'      => 'Asdir1',
                'is_admin'  => true
            ],
             /**
             *  ==== Asdir 2 ====
             */
            [
                'name'      => 'anke',
                'password'  => bcrypt('h@duh'),
                'role'      => 'Asdir2',
                'is_admin'  => false
            ],   
            /**
             *  ==== BPMI ====
             */
            [
                'name'      => 'dzul',
                'password'  => bcrypt('akuganteng!'),
                'role'      => 'BPMI',
                'is_admin'  => true
            ], 
            [
                'name'      => 'eva',
                'password'  => bcrypt('buevadicari!'),
                'role'      => 'BPMI',
                'is_admin'  => true
            ],   
            [
                'name'      => 'mafisa',
                'password'  => bcrypt('hayuksemangat!'),
                'role'      => 'BPMI',
                'is_admin'  => true
            ], 
            [
                'name'      => 'eko',
                'password'  => bcrypt('iniadminloh!'),
                'role'      => 'BPMI',
                'is_admin'  => true
            ], 
            /**
             *  ==== TIK ====
             */
            [
                'name'      => 'fiqi',
                'password'  => bcrypt('okelah123'),
                'role'      => 'TIK',
                'is_admin'  => true
            ],   
            /**
             *  ==== LAB. HT - Komputer & Sarpras ====
             */
            [
                'name'      => 'dedi',
                'password'  => bcrypt('ngonotanin?'),
                'role'      => 'Laboran',
                'is_admin'  => false
            ],               
            [
                'name'      => 'isnin',
                'password'  => bcrypt('iyomasded?'),
                'role'      => 'Laboran',
                'is_admin'  => false
            ],   
            /**
             *  ==== Perpustakaan ====
             */
            [
                'name'      => 'nita',
                'password'  => bcrypt('akufullsenyum!'),
                'role'      => 'Perpustakaan',
                'is_admin'  => false
            ],   
            /**
             *  ==== D3 Komputer ====
             */
            [
                'name'      => 'heru',
                'password'  => bcrypt('horeee!!'),
                'role'      => 'D3Komputer',
                'is_admin'  => false
            ],   
            /**
             *  ==== D3 Akuntansi ====
             */
            [
                'name'      => 'thomas',
                'password'  => bcrypt('yathomas!'),
                'role'      => 'D3Akuntansi',
                'is_admin'  => false
            ], 
            /**
             *  ==== D3 Perhotelan ====
             */
            [
                'name'      => 'wiwin',
                'password'  => bcrypt('wehehehe?'),
                'role'      => 'D3Hotel',
                'is_admin'  => false
            ],     
            /**
             *  ==== D3 Administrasi ====
             */
            [
                'name'      => 'ika',
                'password'  => bcrypt('sotosegerboyolali'),
                'role'      => 'D3Administrasi',
                'is_admin'  => true
            ],
            /**
             *  ==== D4 Manajemen ====
             */
            [
                'name'      => 'nina',
                'password'  => bcrypt('itsmenina'),
                'role'      => 'D4Manajemen',
                'is_admin'  => false
            ],   
            /**
             *  ==== D4 Perhotelan ====
             */
            [
                'name'      => 'anis',
                'password'  => bcrypt('pusingpindo'),
                'role'      => 'D4Perhotelan',
                'is_admin'  => false
            ],                      
        ]);
    }
}
