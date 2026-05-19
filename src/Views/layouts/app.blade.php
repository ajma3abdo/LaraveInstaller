@php
    $currentRoute = request()->route()?->getName() ?? '';

    $allSteps = ['install::index' => __('laravel_installer.steps.welcome')];

    if (config('installer.licence.enable', false)) {
        $allSteps['install::licence'] = __('laravel_installer.steps.licence');
    }

    $allSteps['install::permissions'] = __('laravel_installer.steps.permissions');
    $allSteps['install::requirements'] = __('laravel_installer.steps.requirements');
    $allSteps['install::environment']  = __('laravel_installer.steps.environment');
    $allSteps['install::database']     = __('laravel_installer.steps.database');

    if (config('installer.admin.enable', false)) {
        $allSteps['install::admin'] = __('laravel_installer.steps.admin');
    }

    $allSteps['install::final'] = __('laravel_installer.steps.final');

    $stepKeys   = array_keys($allSteps);
    $currentIdx = array_search($currentRoute, $stepKeys);
    $totalSteps = count($stepKeys);
    $stepNumber = $currentIdx !== false ? $currentIdx + 1 : 1;
    $progress   = $totalSteps > 1 ? (($stepNumber - 1) / ($totalSteps - 1)) * 100 : 0;

    $rtlLocales = ['ar', 'he', 'fa', 'ur', 'yi', 'ps', 'sd', 'ug'];
    $isRtl      = in_array(app()->getLocale(), $rtlLocales);
    $dir        = $isRtl ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $dir }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('laravel_installer.title') }} — @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if ($isRtl)
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet"
            integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="/ajamaa/laravel-installer/app.min.css?v={{ rand() }}">
</head>

<body>
<div class="installer-wrapper">

    {{-- ── SIDEBAR ─────────────────────────────────── --}}
    <aside class="installer-sidebar">
        <div class="sidebar-glow"></div>

        <div class="sidebar-brand">
            @php
                $logoUrl   = config('installer.logo_url');
                $showLogo  = false;
                if ($logoUrl) {
                    if (str_starts_with($logoUrl, 'http://') || str_starts_with($logoUrl, 'https://')) {
                        $showLogo = true;
                    } elseif (str_starts_with($logoUrl, '/storage/')) {
                        $showLogo = \Illuminate\Support\Facades\Storage::disk('public')->exists(
                            ltrim(substr($logoUrl, strlen('/storage')), '/')
                        );
                    } else {
                        $showLogo = file_exists(public_path(ltrim($logoUrl, '/')));
                    }
                }
            @endphp
            @if ($showLogo)
                <img src="{{ $logoUrl }}" alt="Logo">
            @else
                <div style="font-size:1rem;font-weight:800;color:white;opacity:0.9;letter-spacing:0.02em;">Install Page</div>
            @endif
        </div>

        <nav class="sidebar-steps">
            @foreach ($allSteps as $routeKey => $stepName)
                @php
                    $idx         = array_search($routeKey, $stepKeys);
                    $isCompleted = $currentIdx !== false && $idx < $currentIdx;
                    $isActive    = $routeKey === $currentRoute;
                    $cls         = $isCompleted ? 'completed' : ($isActive ? 'active' : '');
                @endphp
                <div class="step-item {{ $cls }}">
                    <div class="step-indicator">
                        @if ($isCompleted)
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="3.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                        @else
                            {{ $idx + 1 }}
                        @endif
                    </div>
                    <div class="step-body">
                        <div class="step-num">{{ __('laravel_installer.steps.step') }} {{ $idx + 1 }}</div>
                        <div class="step-name">{{ $stepName }}</div>
                    </div>
                </div>
            @endforeach
        </nav>

        <div class="sidebar-footer">
            <p>Laravel Installer &copy; Ajamaa</p>
        </div>
    </aside>

    {{-- ── MAIN ─────────────────────────────────────── --}}
    <main class="installer-main">

        <div class="main-header">
            <div>
                <h1 class="main-header-title">@yield('title')</h1>
                <p class="main-header-sub">{{ __('laravel_installer.steps.step') }} {{ $stepNumber }} / {{ $totalSteps }}</p>
            </div>
            <span class="step-badge">{{ $stepNumber }} / {{ $totalSteps }}</span>
        </div>

        <div class="progress-track">
            <div class="progress-fill" style="width: {{ $progress }}%"></div>
        </div>

        <div class="main-content">
            @yield('content')
        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>
</html>
