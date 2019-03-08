<?php

use Illuminate\Database\Seeder;
use App\Models\SetKategori;

class SetKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetKategori::create( [
            'id'=>10,
            'nama'=>'Role User'
        ]);
                    
        SetKategori::create( [
            'id'=>11,
            'nama'=>'Kategori Tiket'
        ]);
                    
        SetKategori::create( [
            'id'=>12,
            'nama'=>'Kategori Grup Chat'
        ]);
                    
        SetKategori::create( [
            'id'=>13,
            'nama'=>'Tingkat Sekolah'
        ]);
                    
        SetKategori::create( [
            'id'=>14,
            'nama'=>'Jenis Ujian'
        ]);
                    
        SetKategori::create( [
            'id'=>15,
            'nama'=>'Mata Pelajaran'
        ]);
                    
        SetKategori::create( [
            'id'=>16,
            'nama'=>'Tingkat Kelas'
        ]);
                    
        SetKategori::create( [
            'id'=>17,
            'nama'=>'Kategori Informasi'
        ]);
                    
        SetKategori::create( [
            'id'=>18,
            'nama'=>'Riwayat Saldo'
        ]);
                    
        SetKategori::create( [
            'id'=>19,
            'nama'=>'Status Simulasi'
        ]);
    }
}
