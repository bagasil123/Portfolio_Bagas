<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrNew([]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description_1' => 'required|string',
            'description_2' => 'required|string',
            'email' => 'required|email',
            'instagram_url' => 'required|url',
            'location' => 'required|string',
            'profile_image_url' => 'nullable|url',
        ]);

        // ================== LOGIKA PERBAIKAN DI SINI ==================

        // Cari profil yang ada atau buat instance model baru
        $profile = Profile::firstOrNew(['id' => 1]);

        // Cek apakah ada URL gambar baru yang dikirim dari widget
        if ($request->filled('profile_image_url')) {
            // Jika ada, gunakan URL baru
            $profile->profile_image_url = $validatedData['profile_image_url'];
        } elseif (!$profile->exists) {
            // Jika TIDAK ada URL baru DAN ini adalah profil BARU (belum ada di DB),
            // kita berikan string kosong agar lolos dari error database.
            $profile->profile_image_url = '';
        }
        // Jika tidak ada URL baru dan profil sudah ada, kita tidak melakukan apa-apa,
        // sehingga URL lama tetap tersimpan.

        // Isi sisa data
        $profile->name = $validatedData['name'];
        $profile->description_1 = $validatedData['description_1'];
        $profile->description_2 = $validatedData['description_2'];
        $profile->email = $validatedData['email'];
        $profile->instagram_url = $validatedData['instagram_url'];
        $profile->location = $validatedData['location'];

        // Simpan ke database
        $profile->save();

        // ================== AKHIR PERBAIKAN ==================

        return redirect()->route('admin.profiles.index')->with('success', 'Profile updated successfully.');
    }
}
