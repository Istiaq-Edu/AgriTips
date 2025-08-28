@extends('layouts.app')

@section('title', 'নতুন কৃষি টিপস যোগ করুন')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8 bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('agri-tips.index') }}"
               class="inline-flex items-center text-gray-700 hover:text-green-700 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                ফিরে যান
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800">নতুন কৃষি টিপস যোগ করুন</h1>
        <p class="text-gray-600 mt-2">কৃষি বিষয়ক সহায়ক তথ্য ও পরামর্শ শেয়ার করুন</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-200">
        <div class="bg-green-100 px-6 py-4 rounded-t-2xl border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">✍️ নতুন টিপস তৈরি করুন</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('agri-tips.store') }}" id="createTipForm" class="p-8 space-y-6">
            @csrf
            
            <!-- Title Field -->
            <div>
                <label for="title" class="block text-base font-medium text-gray-700 mb-2">
                    শিরোনাম <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title') }}"
                       maxlength="255"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-base @error('title') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                       placeholder="কৃষি টিপসের শিরোনাম লিখুন..."
                       required>
                
                <!-- Character Counter -->
                <div class="flex justify-between items-center mt-1">
                    <div class="text-xs text-gray-500">
                        <span id="titleCounter">0</span>/255 অক্ষর
                    </div>
                    @error('title')
                        <div class="text-red-600 text-xs">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Category Field -->
            <div>
                <label for="category" class="block text-base font-medium text-gray-700 mb-2">
                    বিভাগ <span class="text-red-500">*</span>
                </label>
                <select name="category"
                        id="category"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-base py-2 @error('category') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        required>
                    <option value="">বিভাগ নির্বাচন করুন</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ old('category') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                
                @error('category')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-base font-medium text-gray-700 mb-2">
                    বিবরণ <span class="text-red-500">*</span>
                </label>
                <textarea name="description"
                           id="description"
                           rows="8"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 text-base @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                           placeholder="কৃষি টিপসের বিস্তারিত বিবরণ লিখুন..."
                           required>{{ old('description') }}</textarea>
                
                <!-- Character Counter -->
                <div class="flex justify-between items-center mt-1">
                    <div class="text-xs text-gray-500">
                        <span id="descriptionCounter">0</span> অক্ষর
                    </div>
                    @error('description')
                        <div class="text-red-600 text-xs">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                <button type="submit"
                        id="submitBtn"
                        class="flex-1 sm:flex-none btn-primary inline-flex justify-center items-center disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    💾 টিপস সংরক্ষণ করুন
                </button>
                
                <a href="{{ route('agri-tips.index') }}"
                   class="flex-1 sm:flex-none inline-flex justify-center items-center px-8 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    ❌ বাতিল করুন
                </a>
            </div>
        </form>
    </div>

    <!-- Help Text -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-2xl p-6 shadow-lg">
        <div class="flex items-start space-x-4">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="text-sm text-blue-800">
                <h4 class="font-bold mb-3 text-lg">💡 টিপস লেখার নির্দেশনা:</h4>
                <ul class="space-y-2 text-blue-700">
                    <li class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-blue-400 rounded-full flex-shrink-0"></span>
                        <span>শিরোনাম সংক্ষিপ্ত ও স্পষ্ট রাখুন (সর্বোচ্চ ২৫৫ অক্ষর)</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-blue-400 rounded-full flex-shrink-0"></span>
                        <span>উপযুক্ত বিভাগ নির্বাচন করুন</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-blue-400 rounded-full flex-shrink-0"></span>
                        <span>বিবরণে বিস্তারিত ও কার্যকর তথ্য দিন</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <span class="w-2.5 h-2.5 bg-blue-400 rounded-full flex-shrink-0"></span>
                        <span>সহজ ও বোধগম্য ভাষা ব্যবহার করুন</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createTipForm');
    const titleInput = document.getElementById('title');
    const categorySelect = document.getElementById('category');
    const descriptionTextarea = document.getElementById('description');
    const submitBtn = document.getElementById('submitBtn');
    const titleCounter = document.getElementById('titleCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');

    // Character counters
    function updateTitleCounter() {
        const length = titleInput.value.length;
        titleCounter.textContent = length;
        
        if (length > 255) {
            titleCounter.parentElement.classList.add('text-red-600');
            titleCounter.parentElement.classList.remove('text-gray-500');
        } else {
            titleCounter.parentElement.classList.add('text-gray-500');
            titleCounter.parentElement.classList.remove('text-red-600');
        }
    }

    function updateDescriptionCounter() {
        const length = descriptionTextarea.value.length;
        descriptionCounter.textContent = length;
    }

    // Real-time validation
    function validateForm() {
        const title = titleInput.value.trim();
        const category = categorySelect.value;
        const description = descriptionTextarea.value.trim();
        
        const isValid = title.length > 0 && 
                       title.length <= 255 && 
                       category !== '' && 
                       description.length > 0;
        
        submitBtn.disabled = !isValid;
        
        // Update field styles
        updateFieldValidation(titleInput, title.length > 0 && title.length <= 255);
        updateFieldValidation(categorySelect, category !== '');
        updateFieldValidation(descriptionTextarea, description.length > 0);
        
        return isValid;
    }

    function updateFieldValidation(field, isValid) {
        if (field.value.trim() === '') {
            // No validation styling for empty fields (neutral state)
            field.classList.remove('border-green-300', 'border-red-300');
            field.classList.add('border-gray-300');
        } else if (isValid) {
            field.classList.remove('border-red-300', 'border-gray-300');
            field.classList.add('border-green-300');
        } else {
            field.classList.remove('border-green-300', 'border-gray-300');
            field.classList.add('border-red-300');
        }
    }

    // Event listeners
    titleInput.addEventListener('input', function() {
        updateTitleCounter();
        validateForm();
    });

    categorySelect.addEventListener('change', validateForm);
    
    descriptionTextarea.addEventListener('input', function() {
        updateDescriptionCounter();
        validateForm();
    });

    // Form submission handling
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            
            // Show validation message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md mb-4';
            errorDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>দয়া করে সব প্রয়োজনীয় ক্ষেত্র সঠিকভাবে পূরণ করুন।</span>
                </div>
            `;
            
            // Remove existing error messages
            const existingError = form.querySelector('.bg-red-50');
            if (existingError) {
                existingError.remove();
            }
            
            form.insertBefore(errorDiv, form.firstChild);
            
            // Scroll to top of form
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Remove error message after 5 seconds
            setTimeout(() => {
                if (errorDiv.parentNode) {
                    errorDiv.remove();
                }
            }, 5000);
        } else {
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                সংরক্ষণ করা হচ্ছে...
            `;
        }
    });

    // Initialize counters and validation
    updateTitleCounter();
    updateDescriptionCounter();
    validateForm();

    // Auto-resize textarea
    descriptionTextarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>
@endpush

@push('styles')
<style>
    /* Custom focus styles for better accessibility */
    .focus\:border-green-500:focus {
        border-color: var(--color-primary);
    }
    .focus\:ring-green-500:focus {
        --tw-ring-color: rgba(76, 175, 80, 0.5); /* Using primary color with transparency */
    }
    
    .focus\:border-red-500:focus {
        border-color: #EF4444;
    }
    .focus\:ring-red-500:focus {
        --tw-ring-color: rgba(239, 68, 68, 0.5);
    }
    
    /* Smooth transitions for validation states */
    input, select, textarea {
        transition: all 0.2s ease-in-out;
    }
    
    /* Loading animation */
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
@endpush
@endsection