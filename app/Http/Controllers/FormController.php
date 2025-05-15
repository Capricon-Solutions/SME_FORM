<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'no_of_employees' => 'required|integer|min:1',
            'nature_of_business' => 'required|string|max:255',
            'contact_number' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'services' => 'required|array',
            'services.*' => 'in:web_application,erp,mobile_app,nothing',
        ]);

        // Save the form data to the database
        Form::create($validated);

        return redirect()->route('form.show')->with('success', 'Form submitted successfully!');
    }
} 