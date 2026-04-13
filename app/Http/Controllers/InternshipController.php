<?php
namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Internship::where('is_active', true);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->duration) {
            $query->where('duration', $request->duration);
        }

        $internships = $query->latest()->paginate(10);

        return view('internships.index', compact('internships'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'business') {
            abort(403, 'Only businesses can post internships.');
        }
        return view('internships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'type'        => 'required|in:remote,onsite,hybrid',
            'duration'    => 'required|string|max:255',
            'deadline'    => 'required|string|max:255',
        ]);

        Internship::create([
            'business_id' => Auth::id(),
            'title'       => $request->title,
            'description' => $request->description,
            'location'    => $request->location,
            'type'        => $request->type,
            'duration'    => $request->duration,
            'deadline'    => $request->deadline,
        ]);

        return redirect()->route('internships.index')->with('success', 'Internship posted successfully.');
    }

    public function show(Internship $internship)
    {
        return view('internships.show', compact('internship'));
    }

    public function applications(Internship $internship)
    {
        return view('internships.applications', compact('internship'));
    }
}
