<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::where('user_id', Auth::id())->orderBy('created_at', 'desc');

        // Filter by search query
        if ($request->filled('search')) {
            $query->where('description', 'LIKE', '%' . $request->search . '%')
            ->orWhere('subject_type', 'LIKE', '%' . $request->search . '%');
        }

        // Filter by date range
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $activities = $query->paginate(10);

        return view('user_dashboard.activities', compact('activities'));
    }
}
