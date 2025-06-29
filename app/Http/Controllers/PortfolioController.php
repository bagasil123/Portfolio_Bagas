<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Menampilkan halaman portofolio utama.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data profil pertama dari database
        $profile = Profile::first();

        // Ambil semua data skill dan kelompokkan berdasarkan kategori
        $skillsByCategory = Skill::all()->groupBy('category');

        // Ambil semua data proyek dan kelompokkan berdasarkan kategori
        $projectsByCategory = Project::all()->groupBy('category');

        // Kirim semua data ke view 'welcome.blade.php'
        return view('welcome', compact('profile', 'skillsByCategory', 'projectsByCategory'));
    }
}