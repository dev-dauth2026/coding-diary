<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; 

class UserSettingsController extends Controller
{
    /**
     * Display the user settings page.
     */
    public function index()
    {
        $user = Auth::user();

        // Retrieve enum values dynamically
        $profileVisibilityOptions = $this->getEnumValues('users', 'profile_visibility');
        $languageOptions = $this->getEnumValues('users', 'language');

        return view('user_dashboard.settings', compact('user', 'profileVisibilityOptions', 'languageOptions'));
    }

    /**
     * Update the user's privacy settings.
     */
    public function updatePrivacy(Request $request)
    {
        $profileVisibilityOptions = implode(',', $this->getEnumValues('users', 'profile_visibility'));

        $request->validate([
            'profile_visibility' => 'required|string|in:' . $profileVisibilityOptions,
            'activity_status' => 'required|boolean',
        ]);

        $user = Auth::user();
        
        // Update the user settings
        $user->profile_visibility = $request->input('profile_visibility');
        $user->activity_status = $request->input('activity_status');
        $user->save(); 

        return redirect()->route('account.settings.index')->with('success', 'Privacy settings updated successfully.');
    }

    /**
     * Update the user's language preference.
     */
    public function updateLanguage(Request $request)
    {
        $languageOptions = implode(',', $this->getEnumValues('users', 'language'));

        $request->validate([
            'language' => 'required|string|in:' . $languageOptions,
        ]);

        $user = Auth::user();
        $user->update(['language' => $request->language]);

        return redirect()->route('account.settings.index')->with('success', 'Language updated successfully.');
    }

    /**
     * Helper method to get enum values from a table column.
     */
    private function getEnumValues($table, $column)
    {
        // Fetch the column definition using a raw SQL query
        $columnType = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = ?", [$column]);

        // Check if the column exists and has a valid type
        if (empty($columnType) || !isset($columnType[0]->Type)) {
            return []; // Return an empty array if column is not found or type is not set
        }

        $type = $columnType[0]->Type;

        // Check if the type is an enum and extract values
        if (preg_match('/^enum\((.*)\)$/', $type, $matches)) {
            // Extract the enum values and remove surrounding quotes
            $enum = array_map(fn($value) => trim($value, "'"), explode(',', $matches[1]));
            return $enum;
        }

        return []; // Return an empty array if no enum type is matched
    }

     /**
     * Update the user's Two-Factor Authentication (2FA) settings.
     */
    public function update2FA(Request $request)
    {
        $user = Auth::user();

        // Check if 2FA should be enabled or disabled
        $user->two_factor_enabled = $request->has('enable_2fa');
        $user->save();

        return redirect()->route('account.settings.index')->with('success', 'Two-Factor Authentication settings updated successfully.');
    }

     /**
     * Deactivate the user's account.
     */
    public function deactivateAccount(Request $request)
    {
        $user = Auth::user();

        // Deactivate the account by setting 'active' or any relevant status field to false
        $user->active = false;  // Assuming you have an 'active' column in the 'users' table
        $user->save();

        // Log out the user after deactivation
        Auth::logout();

        // Redirect to the home page or login page with a success message
        return redirect()->route('account.home')->with('success', 'Your account has been deactivated.');
    }

    public function downloadData(){
        {
            $user = Auth::user();
    
            // Load a view file and pass user data to it
            $pdf = Pdf::loadView('pdf.user_data', compact('user'));
    
            // Return the generated PDF for download
            return $pdf->download('user_data.pdf');
        }
    }


}
