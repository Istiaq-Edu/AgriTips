@extends('layouts.app')

@section('title', 'কৃষি টিপস তালিকা')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-lg shadow-md">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">কৃষি টিপস</h1>
            <p class="text-gray-600 mt-1">কৃষি বিষয়ক সহায়ক পরামর্শ ও তথ্য</p>
        </div>
        
        <!-- Add New Tip Button -->
        <a href="{{ route('agri-tips.create') }}"
           class="btn-primary inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            নতুন টিপস যোগ করুন
        </a>
    </div>

    <!-- Category Filter -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
        <form method="GET" action="{{ route('agri-tips.index') }}" class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
            <label for="category" class="text-base font-medium text-gray-700 whitespace-nowrap">
                বিভাগ অনুযায়ী ফিল্টার:
            </label>
            
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <select name="category" id="category"
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-base py-2">
                    <option value="">সব বিভাগ</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ $selectedCategory === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                
                <div class="flex gap-3">
                    <button type="submit"
                            class="btn-primary text-sm">
                        ফিল্টার করুন
                    </button>
                    
                    @if($selectedCategory)
                        <a href="{{ route('agri-tips.index') }}"
                           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-medium rounded-md transition-colors duration-200">
                            সব দেখুন
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Tips Count and Filter Status -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-sm text-gray-700">
        <div>
            @if($selectedCategory)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-200 text-green-800 mr-2">
                    {{ $categories[$selectedCategory] }}
                </span>
            @endif
            
            @if($tips->total() > 0)
                মোট <span class="font-semibold">{{ $tips->total() }}</span> টি টিপস পাওয়া গেছে
                @if($tips->hasPages())
                    (পৃষ্ঠা <span class="font-semibold">{{ $tips->currentPage() }}</span> এর <span class="font-semibold">{{ $tips->lastPage() }}</span>)
                @endif
            @else
                কোনো টিপস পাওয়া যায়নি
            @endif
        </div>
        
        @if($tips->hasPages())
            <div class="text-xs text-gray-500">
                {{ $tips->firstItem() }}-{{ $tips->lastItem() }} দেখানো হচ্ছে
            </div>
        @endif
    </div>

    <!-- Tips Grid -->
    @if($tips->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tips as $tip)
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 card-hover overflow-hidden">
                    @php
                        $barClass = match($tip->category->value) {
                            'crop_cultivation' => 'crop',
                            'pest_management' => 'pest',
                            'soil_care' => 'soil',
                            'irrigation' => 'irrigation',
                            'fertilizer' => 'fertilizer',
                            'harvesting' => 'harvesting',
                            'livestock' => 'livestock',
                            'weather' => 'weather',
                            default => 'crop'
                        };
                    @endphp
                    <div class="category-bar {{ $barClass }}"></div>
                    <!-- Card Header -->
                    <div class="p-5 border-b border-gray-200">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="font-semibold text-gray-900 text-xl leading-tight line-clamp-2">
                                <a href="{{ route('agri-tips.show', $tip) }}"
                                   class="hover:text-green-700 transition-colors duration-200">
                                    {{ $tip->title }}
                                </a>
                            </h3>
                            
                            <!-- Category Badge -->
                            @php
                                $categoryClass = match($tip->category->value) {
                                    'crop_cultivation' => 'category-crop',
                                    'pest_management' => 'category-pest',
                                    'soil_care' => 'category-soil',
                                    'irrigation' => 'category-irrigation',
                                    'fertilizer' => 'category-fertilizer',
                                    'harvesting' => 'category-harvesting',
                                    'livestock' => 'category-livestock',
                                    'weather' => 'category-weather',
                                    default => 'category-crop'
                                };
                                $categoryIcon = match($tip->category->value) {
                                    'crop_cultivation' => '🌱',
                                    'pest_management' => '🐛',
                                    'soil_care' => '🌍',
                                    'irrigation' => '💧',
                                    'fertilizer' => '🧪',
                                    'harvesting' => '🌾',
                                    'livestock' => '🐄',
                                    'weather' => '🌤️',
                                    default => '🌱'
                                };
                            @endphp
                            <span class="category-badge {{ $categoryClass }} whitespace-nowrap text-sm">
                                {{ $categoryIcon }} {{ $tip->category->labelBangla() }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-5">
                        <p class="text-gray-700 text-base leading-relaxed line-clamp-3">
                            {{ Str::limit($tip->description, 150) }}
                        </p>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $tip->created_at->format('d M Y') }}
                            </div>
                            
                            <a href="{{ route('agri-tips.show', $tip) }}"
                               class="inline-flex items-center text-base font-medium text-green-700 hover:text-green-800 transition-all duration-200 hover:scale-105">
                                বিস্তারিত দেখুন
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($tips->hasPages())
            <div class="flex justify-center">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                    {{ $tips->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-8 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-20 h-20 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    @if($selectedCategory)
                        এই বিভাগে কোনো টিপস নেই
                    @else
                        এখনো কোনো কৃষি টিপস যোগ করা হয়নি
                    @endif
                </h3>
                
                <p class="text-gray-700 mb-6">
                    @if($selectedCategory)
                        "{{ $categories[$selectedCategory] }}" বিভাগে কোনো টিপস পাওয়া যায়নি। অন্য বিভাগ দেখুন অথবা নতুন টিপস যোগ করুন।
                    @else
                        কৃষি বিষয়ক সহায়ক তথ্য ও পরামর্শ শেয়ার করতে নতুন টিপস যোগ করুন।
                    @endif
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    @if($selectedCategory)
                        <a href="{{ route('agri-tips.index') }}"
                           class="inline-flex items-center px-5 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            সব টিপস দেখুন
                        </a>
                    @endif
                    
                    <a href="{{ route('agri-tips.create') }}"
                       class="btn-primary inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        প্রথম টিপস যোগ করুন
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection