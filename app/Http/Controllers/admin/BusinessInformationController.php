<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\BusinessInformation;
use App\Http\Controllers\Controller;

class BusinessInformationController extends Controller
{
    // Show the form for creating business information
    // Show the business information
    public function show()
    {
        // Assuming there's only one set of business information, get the first entry
        $businessInformation = BusinessInformation::first();

        return view('admin.business-information.show-business-information', compact('businessInformation'));
    }
    //show method ends
    public function create()
    {
        $business_information = BusinessInformation::first()->get();

        return view('admin.business-information.create-business-information',compact('business_information'));
    }

    // Store business information in the database
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:business_information',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'website' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ]);

        // Create new business information
        BusinessInformation::create($validatedData);

        return redirect()->route('admin.business-information.create')->with('success', 'Business Information has been successfully saved.');
    }

    // Show the form for editing business information
    public function edit(BusinessInformation $businessInformation)
    {
        return view('admin.business-information.edit-business-information', compact('businessInformation'));
    }

    // Update the business information in the database
    public function update(Request $request, BusinessInformation $businessInformation)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email|unique:business_information,email,' . $businessInformation->id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'website' => 'nullable|url',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
        ]);

        // Update the business information
        $businessInformation->update($validatedData);

        return redirect()->route('admin.business-information.edit', $businessInformation->id)->with('success', 'Business Information has been successfully updated.');
    }
}
