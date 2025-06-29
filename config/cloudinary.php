<?php

/**
 * File konfigurasi manual untuk Cloudinary.
 * Dibuat karena `vendor:publish` tidak berhasil.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cloudinary Cloud URL
    |--------------------------------------------------------------------------
    |
    | URL ini berisi kredensial utama Anda (API Key, Secret, Cloud Name).
    | Nilainya diambil dari file .env Anda.
    |
    */
    'cloud_url' => env('cloudinary://731423719135264:TZDe2Cqika8tBrO73mg-jjSfUl8@dex2f8xur'),


    /*
    |--------------------------------------------------------------------------
    | Opsi cURL Tambahan
    |--------------------------------------------------------------------------
    |
    | Di sinilah kita menempatkan solusi untuk masalah SSL di lingkungan lokal.
    |
    */
    'curl_options' => [
        /**
         * ------------------------------------------------------------------
         * SOLUSI UNTUK SSL ERROR DI LINGKUNGAN LOKAL (XAMPP/MAMP)
         * ------------------------------------------------------------------
         * Baris ini memberitahu cURL secara eksplisit di mana harus mencari
         * file sertifikat SSL, mengatasi masalah verifikasi koneksi ke Cloudinary.
         */
        CURLOPT_CAINFO => '/Applications/XAMPP/xamppfiles/etc/ssl/cacert.pem',
    ],


    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Opsional Lainnya
    |--------------------------------------------------------------------------
    |
    | Anda bisa mengabaikan ini untuk sekarang.
    |
    */
    'params' => [
        'folder' => env('CLOUDINARY_FOLDER', 'portfolio'),
        'resource_type' => 'auto',
    ],

];
