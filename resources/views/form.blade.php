@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="form-container">
            <div class="form-header">
                <div class="row align-items-center gy-2">
                    <div class="col-12 text-center order-1 order-sm-2 col-sm-3 text-sm-end">
                        <div class="logo-container">
                            <img src="{{ asset('edb-logo.jpeg') }}" alt="EDB Logo" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 text-center order-2 order-sm-1 col-sm-9 text-sm-start">
                        <h2 class="mb-1">Workshop on SME Businesses</h2>
                        <p class="text-muted mb-0">Please fill out the form below</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('form.submit') }}" method="POST">
                @csrf
                
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label required">Full Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Business Name -->
                <div class="mb-3">
                    <label for="business_name" class="form-label required">Business Name</label>
                    <input type="text" class="form-control @error('business_name') is-invalid @enderror" id="business_name" name="business_name" value="{{ old('business_name') }}" required>
                    @error('business_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Number of Employees -->
                <div class="mb-3">
                    <label for="no_of_employees" class="form-label required">Number of Employees</label>
                    <input type="number" class="form-control @error('no_of_employees') is-invalid @enderror" id="no_of_employees" name="no_of_employees" value="{{ old('no_of_employees') }}" min="1" required>
                    @error('no_of_employees')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Nature of Business -->
                <div class="mb-3">
                    <label for="nature_of_business" class="form-label required">Nature of Business</label>
                    <textarea class="form-control @error('nature_of_business') is-invalid @enderror" id="nature_of_business" name="nature_of_business" rows="3" required>{{ old('nature_of_business') }}</textarea>
                    @error('nature_of_business')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Contact Number -->
                <div class="mb-3">
                    <label for="contact_number" class="form-label required">Contact Number</label>
                    <input type="tel" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label required">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Services Interested In -->
                <div class="mb-4 mt-4 pt-2">
                    <label class="form-label required mb-3">Existing Website:</label>
                    @error('services')
                        <div class="text-danger mb-2">{{ $message }}</div>
                    @enderror
                    
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <div class="form-check mb-3 service-option">
                                <input class="form-check-input" type="checkbox" name="services[]" value="web_application" id="web_application" {{ is_array(old('services')) && in_array('web_application', old('services')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="web_application">
                                    Web Application
                                </label>
                            </div>
                            
                            <div class="form-check mb-3 service-option">
                                <input class="form-check-input" type="checkbox" name="services[]" value="erp" id="erp" {{ is_array(old('services')) && in_array('erp', old('services')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="erp">
                                    ERP (Enterprise Resource Planning)
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12 col-sm-6">
                            <div class="form-check mb-3 service-option">
                                <input class="form-check-input" type="checkbox" name="services[]" value="mobile_app" id="mobile_app" {{ is_array(old('services')) && in_array('mobile_app', old('services')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="mobile_app">
                                    Mobile App
                                </label>
                            </div>
                            
                            <div class="form-check mb-3 service-option">
                                <input class="form-check-input" type="checkbox" name="services[]" value="nothing" id="nothing" {{ is_array(old('services')) && in_array('nothing', old('services')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="nothing">
                                    Nothing at this time
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid gap-2 mt-4 pt-1">
                    <button type="submit" class="btn btn-primary btn-lg">Submit Form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Ensure "Nothing" is exclusive with other options
    document.addEventListener('DOMContentLoaded', function() {
        const nothingCheckbox = document.getElementById('nothing');
        const serviceCheckboxes = document.querySelectorAll('input[name="services[]"]:not(#nothing)');
        
        // When "Nothing" is checked, uncheck other options
        nothingCheckbox.addEventListener('change', function() {
            if (this.checked) {
                serviceCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });
        
        // When any other option is checked, uncheck "Nothing"
        serviceCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    nothingCheckbox.checked = false;
                }
            });
        });
    });
</script>
@endsection 