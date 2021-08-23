<?php
//Route::get( '/namaroute', 'Namacontroler@Nama_fungsi'
//nama route bebas saja, boleh nama fungsi
Route::get( '/', 'Home@index' );

//route halaman registrasi
Route::get( '/registrasi', 'Registrasi@index' );

//route simpan data registrasi
Route::post( '/regis', 'Registrasi@regis' );
Route::get( '/login', 'Suplier@login' );
//route utk login suplier
Route::post( '/masukSuplier', 'Suplier@masukSuplier' );
//route untuk keluar suplier
Route::get( '/suplierkeluar', 'Suplier@suplierKeluar' );
//route halaman login
Route::get( '/masukadmin', 'Admin@index' );
//dummy data admin
//Route::get( '/adminGenerate', 'Admin@adminGenerate' );
//route fungsi login admin
Route::post( '/loginadmin', 'Admin@loginAdmin' );
//route pengajuan
Route::get( '/pengajuan', 'Pengajuan@pengajuan' );
Route::get( '/keluaradmin', 'Admin@keluarAdmin' );
Route::get( '/listadmin', 'Admin@listAdmin' );
Route::post( '/tambahadmin', 'Admin@tambahAdmin' );
Route::post( '/ubahadmin', 'Admin@ubahAdmin' );
Route::get( '/hapusadmin/{id}', 'Admin@hapusAdmin' );
Route::get( '/listpengadaan', 'Pengadaan@index' );
Route::post( '/tambahpengadaan', 'Pengadaan@tambahPengadaan' );
Route::get( '/hapusgambar/{id}', 'Pengadaan@hapusGambar' );
Route::post( '/uploadgambar', 'Pengadaan@uploadGambar' );
Route::get( '/hapuspengadaan/{id}', 'Pengadaan@hapusPengadaan' );
Route::post( '/ubahpengadaan', 'Pengadaan@ubahPengadaan' );
Route::get( '/listsuplier', 'Pengadaan@listSuplier' );
Route::post( '/tambahpengajuan', 'Pengajuan@tambahPengajuan' );
Route::get( '/terimapengajuan/{id}', 'Pengajuan@terimaPengajuan' );
Route::get( '/tolakpengajuan/{id}', 'Pengajuan@tolakPengajuan' );
Route::get( '/riwayatku', 'Pengajuan@riwayatku' );
Route::post( '/tambahlaporan', 'Pengajuan@tambahLaporan' );
Route::get( '/laporan', 'Pengajuan@laporan' );
Route::get( '/selesaipengajuan/{id}', 'Pengajuan@selesaiPengajuan' );
Route::get( '/pengajuanselesai', 'Pengajuan@pengajuanSelesai' );
Route::get( '/tolaklaporan/{id}', 'Pengajuan@tolaklaporan' );
Route::get( '/listSup', 'Suplier@listSup' );
Route::get( '/nonAktif/{id}', 'Suplier@nonAktif' );
Route::get( '/Aktif/{id}', 'Suplier@Aktif' );
Route::post( '/ubahpasswordsup', 'suplier@ubahPassword' );
Route::post( '/ubahpasswordadm', 'Admin@ubahPassword' );




?>
