<!DOCTYPE html>
<html lang="bn" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'কৃষি টিপস') - Agricultural Tips</title>
    
    <!-- Google Fonts: Noto Sans Bengali and Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="soft-pattern font-bengali min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur sticky top-0 z-40 border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo/Brand -->
                    <a href="{{ route('agri-tips.index') }}" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform duration-200 ease-in-out">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"/>
                                <path d="M12 16C12 16 16 18 16 22H8C8 18 12 16 12 16Z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-gray-800">কৃষি টিপস</span>
                            <div class="text-xs text-green-700 font-medium">Agricultural Tips</div>
                        </div>
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('welcome') }}"
                       class="flex items-center space-x-2 text-gray-600 hover:text-green-700 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50
                               {{ request()->routeIs('welcome') ? 'text-green-700 bg-green-100 shadow-sm' : '' }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                        </svg>
                        <span>হোম</span>
                    </a>
                    <a href="{{ route('agri-tips.index') }}"
                       class="flex items-center space-x-2 text-gray-600 hover:text-green-700 px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50
                               {{ request()->routeIs('agri-tips.*') && !request()->routeIs('agri-tips.create') ? 'text-green-700 bg-green-100 shadow-sm' : '' }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>সব টিপস</span>
                    </a>
                    <a href="{{ route('agri-tips.create') }}"
                       class="flex items-center space-x-2 btn-primary px-4 py-2 text-sm font-medium shadow-md hover:shadow-lg
                               {{ request()->routeIs('agri-tips.create') ? 'bg-green-700' : '' }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>নতুন টিপস</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md flex items-center space-x-2">
                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md flex items-center space-x-2">
                <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">দয়া করে নিম্নলিখিত ত্রুটিগুলি সংশোধন করুন:</span>
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gradient text-white py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-3">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"/>
                            <path d="M12 16C12 16 16 18 16 22H8C8 18 12 16 12 16Z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">কৃষি টিপস</span>
                </div>
                <p class="text-gray-400 text-sm mb-2">
                    🌱 কৃষি জ্ঞান ভাগাভাগির প্ল্যাটফর্ম
                </p>
                <p class="text-gray-500 text-xs">
                    &copy; {{ date('Y') }} কৃষি টিপস। সকল অধিকার সংরক্ষিত।
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>