{{-- Memberitahu Blade untuk menggunakan kerangka dari layouts/main.blade.php --}}
@extends('layouts.main')

{{-- Memulai bagian konten yang akan dimasukkan ke dalam @yield('content') --}}
@section('content')

    <header class="header" id="header">
        <div class="logo">
            <img src="{{ asset('assets/profile/B.png') }}" alt="Logo B" style="width: 10%; height: 10%; object-fit: cover; border-radius: 50%;"/>
        </div>
        <a href="{{ asset('CV_Bagas_Indra_Lesmana.pdf') }}" download class="download-btn">Download CV</a>
    </header>

    <main class="container" id="mainContainer">
        {{-- Profile Section --}}
        {{-- Pengecekan @if($profile) memastikan bagian ini hanya tampil jika ada data profil --}}
        @if($profile)
        <section class="profile-section">
            <div class="profile-card">
                <div class="profile-content">
                    <div class="profile-image">
                        <img src="{{ $profile->profile_image_url }}" alt="{{ $profile->name }}" style="width: 135%; height: 135%; object-fit: cover; border-radius: 50%;" />
                    </div>
                    <div class="profile-info">
                        <h1>{{ $profile->name }}</h1>
                        <p>{{ $profile->description_1 }}</p>
                        <p>{{ $profile->description_2 }}</p>
                        <div class="contact-info">
                            <a class="contact-item" href="mailto:{{ $profile->email }}" target="_blank" rel="noopener" style="color: #fff;">
                                <ion-icon name="mail-outline"></ion-icon> {{ $profile->email }}
                            </a>
                            <a class="contact-item" href="{{ $profile->instagram_url }}" target="_blank" rel="noopener" style="color: #fff;">
                                <ion-icon name="logo-instagram"></ion-icon> @bgs_indrlsmn
                            </a>
                            <div class="contact-item"><ion-icon name="location-outline"></ion-icon> {{ $profile->location }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- Tech Stack Section --}}
        @if($skillsByCategory->isNotEmpty())
        <section>
            <h2 class="section-title fade-in">Tech Stack</h2>
            <div class="cards-grid">
                @foreach($skillsByCategory as $category => $skills)
                <div class="tool-card fade-in">
                    <h3>{{ $category }}</h3>
                    <div class="tool-icons">
                        @foreach($skills as $skill)
                        {{-- Pastikan filter CSS Anda tidak memblokir gambar SVG dari Cloudinary --}}
                        <img src="{{ $skill->icon_url }}" alt="{{ $skill->name }}" title="{{ $skill->name }}" class="tool-icon" style="filter: invert(56%) sepia(22%) saturate(1162%) hue-rotate(156deg) brightness(92%) contrast(92%);">
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Projects Section --}}
        @if($projectsByCategory->isNotEmpty())
        <section>
            <h2 class="section-title fade-in">Projects</h2>
            @foreach($projectsByCategory as $category => $projects)
            <div class="project-divider fade-in" style="display: flex; align-items: center; margin: 50px 0 24px 0;">
                <hr style="flex: 1; border: none; border-top: 2px solid #3aa8c5; opacity: 0.3; margin-right: 16px;">
                <span style="color: #3aa8c5; font-weight: 600; letter-spacing: 1px; font-size: 2em;"> {{ $category }} </span>
                <hr style="flex: 1; border: none; border-top: 2px solid #3aa8c5; opacity: 0.3; margin-left: 16px;">
            </div>
            <div class="cards-grid">
                @foreach($projects as $project)
                <div class="project-card fade-in">
                    <div class="project-envelope">
                        <div class="project-back"></div>
                        <div class="project-flap"></div>
                        <div class="project-content">
                            <h3>{{ $project->title }}</h3>
                            <div class="project-image" style="text-align:center; margin-bottom: 12px;">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="max-width:100%; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.08);" />
                            </div>
                            <div class="description">
                                <div class="project-links" style="margin-top:8px;">
                                    @if($project->live_demo_url)
                                    <a href="{{ $project->live_demo_url }}" target="_blank" rel="noopener" class="project-link" style="color:#61dafb; text-decoration:underline; margin-right:12px;">Live Demo</a>
                                    @endif
                                    @if($project->source_code_url)
                                    <a href="{{ $project->source_code_url }}" target="_blank" rel="noopener" class="project-link" style="color:#68d391; text-decoration:underline;">Source Code</a>
                                    @endif
                                </div>
                            </div>
                            <div class="tech-stack">
                                {!! $project->tech_stack_description !!} {{-- {!! !!} untuk render HTML --}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </section>
        @endif
        {{-- Desktop Mode Suggestion Popup --}}
        <div id="desktopModePopup" class="popup-overlay">
            <div class="popup-content">
                <div class="popup-icon">
                    <ion-icon name="desktop-outline"></ion-icon>
                </div>
                <h2>Pengalaman Terbaik di Desktop</h2>
                <p>
                    Portofolio ini dirancang dengan detail interaktif yang paling baik dinikmati pada layar yang lebih besar.
                    Untuk pengalaman maksimal, kami sarankan untuk mengaktifkan "Situs Desktop" pada browser Anda.
                </p>
                <button id="confirmDesktopMode" class="popup-button">Saya Mengerti</button>
            </div>
        </div>
    </main>

{{-- Mengakhiri bagian konten --}}
@endsection
