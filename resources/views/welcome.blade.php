@extends('layouts.app')

@section('title', 'স্বাগতম')

@section('content')
<div class="text-center">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 bangla-text mb-4">
            কৃষি টিপস অ্যাপ্লিকেশনে স্বাগতম
        </h1>
        <p class="text-lg text-gray-600 bangla-text max-w-2xl mx-auto">
            এই অ্যাপ্লিকেশনে আপনি কৃষি সংক্রান্ত বিভিন্ন টিপস এবং পরামর্শ পাবেন। 
            নতুন টিপস যোগ করুন, সম্পাদনা করুন এবং ব্যবস্থাপনা করুন।
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
        <!-- View Tips Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 bangla-text mb-2">
                সব টিপস দেখুন
            </h3>
            <p class="text-gray-600 bangla-text mb-4">
                বিদ্যমান সকল কৃষি টিপস ব্রাউজ করুন এবং বিভিন্ন বিভাগ অনুযায়ী ফিল্টার করুন।
            </p>
            <a href="{{ route('agri-tips.index') }}" 
               class="inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition-colors">
                টিপস দেখুন
            </a>
        </div>

        <!-- Add New Tip Card -->
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 bangla-text mb-2">
                নতুন টিপস যোগ করুন
            </h3>
            <p class="text-gray-600 bangla-text mb-4">
                নতুন কৃষি টিপস তৈরি করুন এবং কৃষক সম্প্রদায়ের সাথে জ্ঞান ভাগ করুন।
            </p>
            <a href="{{ route('agri-tips.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors">
                টিপস যোগ করুন
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="mt-12 max-w-4xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-900 bangla-text mb-6">
            বৈশিষ্ট্যসমূহ
        </h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 bangla-text mb-2">বিভাগ অনুযায়ী সাজানো</h4>
                <p class="text-sm text-gray-600 bangla-text">ফসল চাষ, কীটপতঙ্গ ব্যবস্থাপনা, মাটির যত্ন ইত্যাদি বিভাগে টিপস সাজানো।</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 bangla-text mb-2">সহজ ব্যবস্থাপনা</h4>
                <p class="text-sm text-gray-600 bangla-text">টিপস যোগ করা, সম্পাদনা এবং মুছে ফেলার সহজ ইন্টারফেস।</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="font-medium text-gray-900 bangla-text mb-2">বাংলা ভাষা সাপোর্ট</h4>
                <p class="text-sm text-gray-600 bangla-text">সম্পূর্ণ বাংলা ভাষায় ইন্টারফেস এবং কন্টেন্ট সাপোর্ট।</p>
            </div>
        </div>
    </div>
</div>
@endsection