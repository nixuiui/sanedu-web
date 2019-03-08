<?php

use Illuminate\Database\Seeder;
use App\Models\SetPustaka;

class SetPustakaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SetPustaka::create( [
            'id'=>1001,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Super Admin'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1002,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Admin'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1003,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Admin Tiket'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1004,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Member'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1005,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'User'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1006,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Admin Ujian'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1007,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Admin Simulai'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1008,
            'id_kategori'=>10,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Pengawas'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1101,
            'id_kategori'=>11,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Tiket Member'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1102,
            'id_kategori'=>11,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Tiket User'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1103,
            'id_kategori'=>11,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Tiket Partisipan'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1201,
            'id_kategori'=>12,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'LINE'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1202,
            'id_kategori'=>12,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'WhatsApp'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1301,
            'id_kategori'=>13,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'SD'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1302,
            'id_kategori'=>13,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'SMP'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1303,
            'id_kategori'=>13,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'SMA'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1401,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_nasional.png',
            'nama'=>'Ujian Nasional'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1402,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_tengah_semester.png',
            'nama'=>'Ujian Tengah Semester'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1403,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_semester',
            'nama'=>'Ujian Semester'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1404,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_sbmptn.png',
            'nama'=>'SBMPTN'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1405,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_stan.png',
            'nama'=>'STAN'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1406,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_poltekes.png',
            'nama'=>'POLTEKES'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1407,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_politeknik.png',
            'nama'=>'POLITEKNIK'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1408,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_stis.png',
            'nama'=>'STIS'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1409,
            'id_kategori'=>14,
            'id_parent'=>NULL,
            'image'=>'ujian_kedinasan.png',
            'nama'=>'KEDINASAN'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1501,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_matematika.png',
            'nama'=>'Matematika'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1502,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_bahasa_indo.png',
            'nama'=>'Bahasa Indonesia'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1503,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_bahasa_inggris.png',
            'nama'=>'Bahasa Inggris'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1504,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ipa.png',
            'nama'=>'IPA'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1505,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ips.png',
            'nama'=>'IPS'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1506,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sbmptn_campuran.png',
            'nama'=>'IPC'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1507,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ipa.png',
            'nama'=>'IPA TERPADU'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1508,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ips.png',
            'nama'=>'IPS TERPADU'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1509,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sejarah.png',
            'nama'=>'Sejarah'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1510,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ekonomi.png',
            'nama'=>'Ekonomi'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1511,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sosiologi.png',
            'nama'=>'Sosiologi'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1512,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_geografi.png',
            'nama'=>'Geografi'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1513,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_biologi.png',
            'nama'=>'Biologi'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1514,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_kimia.png',
            'nama'=>'Kimia'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1515,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_fisika.png',
            'nama'=>'Fisika'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1516,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sbmptn_saintek.png',
            'nama'=>'SAINTEK'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1517,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sbmptn_soshum.png',
            'nama'=>'SOSHUM'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1518,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sbmptn_campuran.png',
            'nama'=>'CAMPUR'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1519,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_sttd.png',
            'nama'=>'STTD'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1520,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_tni.png',
            'nama'=>'TNI'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1521,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_polri.png',
            'nama'=>'POLRI'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1522,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_ipdn.png',
            'nama'=>'IPDN'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1523,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_politeknik.png',
            'nama'=>'POLITEKNIK'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1524,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_poltekes.png',
            'nama'=>'POLTEKES'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1525,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_stan.png',
            'nama'=>'STAN'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1526,
            'id_kategori'=>15,
            'id_parent'=>NULL,
            'image'=>'mapel_stis.png',
            'nama'=>'STIS'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1601,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'1'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1602,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'2'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1603,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'3'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1604,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'4'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1605,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'5'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1606,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'6'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1607,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'7'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1608,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'8'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1609,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'9'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1610,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'10'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1611,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'11'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1612,
            'id_kategori'=>16,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'12'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1701,
            'id_kategori'=>17,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Beasiswa'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1702,
            'id_kategori'=>17,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Universitas'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1703,
            'id_kategori'=>17,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Lowongan Kerja'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1801,
            'id_kategori'=>18,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Penambahan Saldo'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1802,
            'id_kategori'=>18,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Membeli Soal Ujian\r\n'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1803,
            'id_kategori'=>18,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Membeli Simulasi'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1901,
            'id_kategori'=>19,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Persiapan Publish'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1902,
            'id_kategori'=>19,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Publish'
            ] );
            
            
                        
            SetPustaka::create( [
            'id'=>1903,
            'id_kategori'=>19,
            'id_parent'=>NULL,
            'image'=>NULL,
            'nama'=>'Tutup Pendaftaran'
            ] );
    }
}
