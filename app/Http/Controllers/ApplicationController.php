<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Internship;
use App\Notifications\ApplicationReceived;
use App\Notifications\ApplicationStatusUpdated;
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
            'cv'             => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'certificates.*' => 'nullable|file|mimes:pdf,jpg,png|max:5120',
            'certificates'   => 'nullable|array|max:5',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        $certificatePaths = [];
        if ($request->hasFile('certificates')) {
            foreach ($request->file('certificates') as $certificate) {
                $certificatePaths[] = $certificate->store('certificates', 'public');
            }
        }

        $application = Application::create([
            'internship_id'  => $request->internship_id,
            'student_id'     => Auth::id(),
            'message'        => $request->message,
            'portfolio_link' => $request->portfolio_link,
            'cv_path'        => $cvPath,
            'certificates'   => $certificatePaths,
        ]);

        $application->internship->business->notify(new ApplicationReceived($application));

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

        $application->student->notify(new ApplicationStatusUpdated($application));

        return back()->with('success', 'Application updated.');
    }
}
