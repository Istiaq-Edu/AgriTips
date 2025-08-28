@extends('layouts.app')

@section('title', 'কৃষি টিপস তালিকা')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">কৃষি টিপস</h1>
            <p class="text-gray-600 mt-1">কৃষি বিষয়ক সহায়ক পরামর্শ ও তথ্য</p>
        </div>
        
        <!-- Add New Tip Button -->
        <a href="{{ route('agri-tips.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            নতুন টিপস যোগ করুন
        </a>
    </div>

    <!-- Category Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <form method="GET" action="{{ route('agri-tips.index') }}" class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
            <label for="category" class="text-sm font-medium text-gray-700 whitespace-nowrap">
                বিভাগ অনুযায়ী ফিল্টার:
            </label>
            
            <div class="flex flex-col sm:flex-row gap-2 flex-1">
                <select name="category" id="category" 
                        class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-sm">
                    <option value="">সব বিভাগ</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ $selectedCategory === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                
                <div class="flex gap-2">
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-colors">
                        ফিল্টার করুন
                    </button>
                    
                    @if($selectedCategory)
                        <a href="{{ route('agri-tips.index') }}" 
                           class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-md transition-colors">
                            সব দেখুন
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Tips Count and Filter Status -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-sm text-gray-600">
        <div>
            @if($selectedCategory)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                    {{ $categories[$selectedCategory] }}
                </span>
            @endif
            
            @if($tips->total() > 0)
                মোট {{ $tips->total() }} টি টিপস পাওয়া গেছে
                @if($tips->hasPages())
                    (পৃষ্ঠা {{ $tips->currentPage() }} এর {{ $tips->lastPage() }})
                @endif
            @else
                কোনো টিপস পাওয়া যায়নি
            @endif
        </div>
        
        @if($tips->hasPages())
            <div class="text-xs">
                {{ $tips->firstItem() }}-{{ $tips->lastItem() }} দেখানো হচ্ছে
            </div>
        @endif
    </div>

    <!-- Tips Grid -->
    @if($tips->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tips as $tip)
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 card-hover">
                    <!-- Card Header -->
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="font-semibold text-gray-900 text-lg leading-tight line-clamp-2">
                                <a href="{{ route('agri-tips.show', $tip) }}" 
                                   class="hover:text-green-600 transition-colors">
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
                            <span class="category-badge {{ $categoryClass }} whitespace-nowrap">
                                {{ $categoryIcon }} {{ $tip->category->labelBangla() }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <div class="p-4">
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                            {{ Str::limit($tip->description, 120) }}
                        </p>
                    </div>
                    
                    <!-- Card Footer -->
                    <div class="px-4 py-3 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-100 rounded-b-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $tip->created_at->format('d M Y') }}
                            </div>
                            
                            <a href="{{ route('agri-tips.show', $tip) }}" 
                               class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700 transition-all hover:scale-105">
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
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    {{ $tips->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
            <div class="max-w-md mx-auto">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    @if($selectedCategory)
                        এই বিভাগে কোনো টিপস নেই
                    @else
                        এখনো কোনো কৃষি টিপস যোগ করা হয়নি
                    @endif
                </h3>
                
                <p class="text-gray-600 mb-6">
                    @if($selectedCategory)
                        "{{ $categories[$selectedCategory] }}" বিভাগে কোনো টিপস পাওয়া যায়নি। অন্য বিভাগ দেখুন অথবা নতুন টিপস যোগ করুন।
                    @else
                        কৃষি বিষয়ক সহায়ক তথ্য ও পরামর্শ শেয়ার করতে নতুন টিপস যোগ করুন।
                    @endif
                </p>
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    @if($selectedCategory)
                        <a href="{{ route('agri-tips.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            সব টিপস দেখুন
                        </a>
                    @endif
                    
                    <a href="{{ route('agri-tips.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
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