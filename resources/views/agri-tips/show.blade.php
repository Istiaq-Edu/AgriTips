@extends('layouts.app')

@section('title', $agriTip->title . ' - কৃষি টিপস')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb Navigation -->
    <nav class="flex items-center space-x-2 text-sm text-gray-600">
        <a href="{{ route('agri-tips.index') }}" class="hover:text-green-600 transition-colors">
            কৃষি টিপস
        </a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-gray-900 font-medium">টিপস বিস্তারিত</span>
    </nav>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header Section -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                <div class="flex-1">
                    <!-- Category Badge -->
                    <div class="mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            {{ \App\TipCategory::from($agriTip->category)->labelBangla() }}
                        </span>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 leading-tight mb-3">
                        {{ $agriTip->title }}
                    </h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            তৈরি: {{ $agriTip->created_at->format('d M Y, h:i A') }}
                        </div>
                        
                        @if($agriTip->updated_at->ne($agriTip->created_at))
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                আপডেট: {{ $agriTip->updated_at->format('d M Y, h:i A') }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 lg:flex-col lg:w-auto">
                    <!-- Edit Button -->
                    <a href="{{ route('agri-tips.edit', $agriTip) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        সম্পাদনা করুন
                    </a>
                    
                    <!-- Delete Button -->
                    <button type="button" 
                            onclick="confirmDelete()"
                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        মুছে ফেলুন
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Content Section -->
        <div class="px-6 py-6">
            <div class="prose prose-lg max-w-none">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    বিস্তারিত বিবরণ
                </h2>
                
                <div class="text-gray-700 leading-relaxed whitespace-pre-line text-base">
                    {{ $agriTip->description }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navigation Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4">
        <a href="{{ route('agri-tips.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            সব টিপসে ফিরে যান
        </a>
        
        <a href="{{ route('agri-tips.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            নতুন টিপস যোগ করুন
        </a>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <!-- Modal Header -->
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">টিপস মুছে ফেলার নিশ্চিতকরণ</h3>
            </div>
            
            <!-- Modal Content -->
            <div class="mb-6">
                <p class="text-gray-600 mb-3">
                    আপনি কি নিশ্চিত যে এই কৃষি টিপসটি মুছে ফেলতে চান?
                </p>
                <div class="bg-gray-50 rounded-lg p-3 border-l-4 border-red-400">
                    <p class="text-sm text-gray-700 font-medium">{{ $agriTip->title }}</p>
                </div>
                <p class="text-sm text-red-600 mt-3 font-medium">
                    ⚠️ এই কাজটি পূর্বাবস্থায় ফেরানো যাবে না।
                </p>
            </div>
            
            <!-- Modal Actions -->
            <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                <button type="button" 
                        onclick="closeDeleteModal()"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                    বাতিল করুন
                </button>
                
                <form method="POST" action="{{ route('agri-tips.destroy', $agriTip) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full sm:w-auto px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                        হ্যাঁ, মুছে ফেলুন
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete() {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.getElementById('deleteModal').classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
@endpush

@push('styles')
<style>
    .prose {
        color: inherit;
    }
    
    .prose h2 {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    
    /* Ensure proper Bangla text rendering */
    .whitespace-pre-line {
        white-space: pre-line;
        word-wrap: break-word;
        line-height: 1.7;
    }
    
    /* Better text spacing for Bangla content */
    .leading-relaxed {
        line-height: 1.75;
    }
</style>
@endpush
@endsection