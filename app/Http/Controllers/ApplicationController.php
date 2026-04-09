<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function create(Internship $internship)
    {
        return view('applications.create', compact('internship'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'internship_id'  => 'required|exists:internships,id',
            'message'        => 'required|string',
            'portfolio_link' => 'nullable|url',
        ]);

        Application::create([
            'internship_id'  => $request->internship_id,
            'student_id'     => Auth::id(),
            'message'        => $request->message,
            'portfolio_link' => $request->portfolio_link,
        ]);

        return redirect()->route('internships.index')->with('success', 'Application submitted.');
    }

    public function index()
    {
        $applications = Auth::user()->applications()->with('internship.business')->get();
        return view('applications.index', compact('applications'));
    }

    public function update(Request $request, Application $application)
    {
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Application updated.');
    }
}
