@extends('layouts.app')

@section('title', 'স্বাগতম')

@section('content')
<div class="text-center">
    <!-- Hero Section -->
    <div class="mb-12 relative">
        <div class="absolute inset-0 gradient-bg opacity-5 rounded-3xl"></div>
        <div class="relative py-12 px-6">
            <div class="w-20 h-20 gradient-bg rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl icon-bounce">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L22 9L13.09 9.74L12 16L10.91 9.74L2 9L10.91 8.26L12 2Z"/>
                    <path d="M12 16C12 16 16 18 16 22H8C8 18 12 16 12 16Z"/>
                </svg>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 bangla-text mb-6 leading-tight">
                কৃষি টিপস অ্যাপ্লিকেশনে 
                <span class="text-green-600">স্বাগতম</span>
            </h1>
            <p class="text-xl text-gray-600 bangla-text max-w-3xl mx-auto leading-relaxed">
                🌱 এই অ্যাপ্লিকেশনে আপনি কৃষি সংক্রান্ত বিভিন্ন টিপস এবং পরামর্শ পাবেন। 
                নতুন টিপস যোগ করুন, সম্পাদনা করুন এবং ব্যবস্থাপনা করুন।
            </p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto mb-12">
        <!-- View Tips Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-green-100">
            <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 7.5V9M15 11.5V9.5L21 9V11L15 11.5ZM11 15.5V13.5L5 13V15L11 15.5ZM11 18V16L5 15.5V17.5L11 18ZM12 7.5C12.8 7.5 13.5 8.2 13.5 9S12.8 10.5 12 10.5 10.5 9.8 10.5 9 11.2 7.5 12 7.5ZM12 11.5C13.4 11.5 14.5 12.6 14.5 14S13.4 16.5 12 16.5 9.5 15.4 9.5 14 10.6 11.5 12 11.5Z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 bangla-text mb-3">
                📚 সব টিপস দেখুন
            </h3>
            <p class="text-gray-600 bangla-text mb-6 leading-relaxed">
                বিদ্যমান সকল কৃষি টিপস ব্রাউজ করুন এবং বিভিন্ন বিভাগ অনুযায়ী ফিল্টার করুন। 
                ফসল চাষ থেকে শুরু করে কীটপতঙ্গ ব্যবস্থাপনা পর্যন্ত সব তথ্য।
            </p>
            <a href="{{ route('agri-tips.index') }}" 
               class="inline-flex items-center btn-primary px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                টিপস দেখুন
            </a>
        </div>

        <!-- Add New Tip Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-yellow-100">
            <div class="w-20 h-20 gradient-bg-secondary rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 bangla-text mb-3">
                ✍️ নতুন টিপস যোগ করুন
            </h3>
            <p class="text-gray-600 bangla-text mb-6 leading-relaxed">
                নতুন কৃষি টিপস তৈরি করুন এবং কৃষক সম্প্রদায়ের সাথে জ্ঞান ভাগ করুন। 
                আপনার অভিজ্ঞতা শেয়ার করে অন্যদের সাহায্য করুন।
            </p>
            <a href="{{ route('agri-tips.create') }}" 
               class="inline-flex items-center btn-secondary px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                টিপস যোগ করুন
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-900 bangla-text mb-8 text-center">
            🌟 বৈশিষ্ট্যসমূহ
        </h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 card-hover border border-green-200">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L15.09 8.26L22 9L15.09 9.74L12 16L8.91 9.74L2 9L8.91 8.26L12 2Z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 bangla-text mb-3">🗂️ বিভাগ অনুযায়ী সাজানো</h4>
                <p class="text-sm text-gray-700 bangla-text leading-relaxed">ফসল চাষ, কীটপতঙ্গ ব্যবস্থাপনা, মাটির যত্ন, সেচ ব্যবস্থা ইত্যাদি বিভাগে টিপস সুন্দরভাবে সাজানো।</p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 card-hover border border-blue-200">
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 bangla-text mb-3">⚡ সহজ ব্যবস্থাপনা</h4>
                <p class="text-sm text-gray-700 bangla-text leading-relaxed">টিপস যোগ করা, সম্পাদনা এবং মুছে ফেলার অত্যন্ত সহজ ও ব্যবহারবান্ধব ইন্টারফেস।</p>
            </div>
            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 card-hover border border-purple-200">
                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.87 15.07L10.33 12.56L10.36 12.53C12.1 10.59 13.34 8.36 14.07 6H17V4H10V2H8V4H1V6H12.17C11.5 7.92 10.44 9.75 9 11.35C8.07 10.32 7.3 9.19 6.69 8H4.69C5.42 9.63 6.42 11.17 7.67 12.56L2.58 17.58L4 19L9 14L12.11 17.11L12.87 15.07Z"/>
                    </svg>
                </div>
                <h4 class="text-lg font-bold text-gray-900 bangla-text mb-3">🇧🇩 বাংলা ভাষা সাপোর্ট</h4>
                <p class="text-sm text-gray-700 bangla-text leading-relaxed">সম্পূর্ণ বাংলা ভাষায় ইন্টারফেস এবং কন্টেন্ট সাপোর্ট। সুন্দর বাংলা ফন্ট রেন্ডারিং।</p>
            </div>
        </div>
    </div>
</div>
@endsection