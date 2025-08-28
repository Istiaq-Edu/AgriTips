@extends('layouts.app')

@section('title', 'কৃষি টিপস সম্পাদনা করুন')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="{{ route('agri-tips.show', $agriTip) }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                ফিরে যান
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900">কৃষি টিপস সম্পাদনা করুন</h1>
        <p class="text-gray-600 mt-2">কৃষি বিষয়ক তথ্য ও পরামর্শ আপডেট করুন</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-4 rounded-t-2xl border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900">✏️ টিপস সম্পাদনা করুন</h2>
            </div>
        </div>
        <form method="POST" action="{{ route('agri-tips.update', $agriTip) }}" id="editTipForm" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    শিরোনাম <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title', $agriTip->title) }}"
                       maxlength="255"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('title') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
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
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                    বিভাগ <span class="text-red-500">*</span>
                </label>
                <select name="category" 
                        id="category" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('category') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                        required>
                    <option value="">বিভাগ নির্বাচন করুন</option>
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" {{ old('category', $agriTip->category->value) === $value ? 'selected' : '' }}>
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
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    বিবরণ <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="8"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 @error('description') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                          placeholder="কৃষি টিপসের বিস্তারিত বিবরণ লিখুন..."
                          required>{{ old('description', $agriTip->description) }}</textarea>
                
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
                        class="flex-1 sm:flex-none inline-flex justify-center items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-medium rounded-xl transition-all hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    💾 পরিবর্তন সংরক্ষণ করুন
                </button>
                
                <a href="{{ route('agri-tips.show', $agriTip) }}" 
                   class="flex-1 sm:flex-none inline-flex justify-center items-center px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl transition-all hover:scale-105 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    ❌ বাতিল করুন
                </a>
            </div>
        </form>
    </div>

    <!-- Help Text -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm text-blue-800">
                <h4 class="font-medium mb-1">সম্পাদনার নির্দেশনা:</h4>
                <ul class="space-y-1 text-blue-700">
                    <li>• প্রয়োজনীয় ক্ষেত্রগুলো পরিবর্তন করুন</li>
                    <li>• শিরোনাম সংক্ষিপ্ত ও স্পষ্ট রাখুন (সর্বোচ্চ ২৫৫ অক্ষর)</li>
                    <li>• উপযুক্ত বিভাগ নির্বাচন করুন</li>
                    <li>• বিবরণে বিস্তারিত ও কার্যকর তথ্য দিন</li>
                    <li>• সহজ ও বোধগম্য ভাষা ব্যবহার করুন</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Last Updated Info -->
    <div class="mt-4 text-sm text-gray-500 text-center">
        <p>সর্বশেষ আপডেট: {{ $agriTip->updated_at->format('d/m/Y h:i A') }}</p>
        <p>তৈরি করা হয়েছে: {{ $agriTip->created_at->format('d/m/Y h:i A') }}</p>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editTipForm');
    const titleInput = document.getElementById('title');
    const categorySelect = document.getElementById('category');
    const descriptionTextarea = document.getElementById('description');
    const submitBtn = document.getElementById('submitBtn');
    const titleCounter = document.getElementById('titleCounter');
    const descriptionCounter = document.getElementById('descriptionCounter');

    // Store original values to detect changes
    const originalValues = {
        title: titleInput.value,
        category: categorySelect.value,
        description: descriptionTextarea.value
    };

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

    // Check if form has changes
    function hasChanges() {
        return titleInput.value !== originalValues.title ||
               categorySelect.value !== originalValues.category ||
               descriptionTextarea.value !== originalValues.description;
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
        
        const formHasChanges = hasChanges();
        
        submitBtn.disabled = !isValid || !formHasChanges;
        
        // Update submit button text based on changes
        if (!formHasChanges) {
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                কোন পরিবর্তন নেই
            `;
        } else {
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                পরিবর্তন সংরক্ষণ করুন
            `;
        }
        
        // Update field styles
        updateFieldValidation(titleInput, title.length > 0 && title.length <= 255);
        updateFieldValidation(categorySelect, category !== '');
        updateFieldValidation(descriptionTextarea, description.length > 0);
        
        return isValid && formHasChanges;
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
            
            let errorMessage = 'দয়া করে সব প্রয়োজনীয় ক্ষেত্র সঠিকভাবে পূরণ করুন।';
            
            if (!hasChanges()) {
                errorMessage = 'কোন পরিবর্তন করা হয়নি। দয়া করে প্রয়োজনীয় পরিবর্তন করুন।';
            }
            
            // Show validation message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md mb-4';
            errorDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span>${errorMessage}</span>
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
                আপডেট করা হচ্ছে...
            `;
        }
    });

    // Warn user about unsaved changes when leaving page
    window.addEventListener('beforeunload', function(e) {
        if (hasChanges()) {
            e.preventDefault();
            e.returnValue = 'আপনার পরিবর্তনগুলো সংরক্ষিত হয়নি। আপনি কি নিশ্চিত যে আপনি পেজ ছেড়ে যেতে চান?';
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

    // Initial textarea resize
    descriptionTextarea.style.height = 'auto';
    descriptionTextarea.style.height = (descriptionTextarea.scrollHeight) + 'px';
});
</script>
@endpush

@push('styles')
<style>
    /* Custom focus styles for better accessibility */
    .focus\:ring-green-500:focus {
        --tw-ring-color: rgb(34 197 94 / 0.5);
    }
    
    .focus\:ring-red-500:focus {
        --tw-ring-color: rgb(239 68 68 / 0.5);
    }
    
    /* Smooth transitions for validation states */
    input, select, textarea {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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
    
    /* Disabled button styling */
    button:disabled {
        cursor: not-allowed;
        opacity: 0.6;
    }
</style>
@endpush
@endsection