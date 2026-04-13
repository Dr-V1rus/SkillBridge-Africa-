<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Contact;
use App\Models\Internship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents     = User::where('role', 'student')->count();
        $totalBusinesses   = User::where('role', 'business')->count();
        $totalInternships  = Internship::count();
        $totalApplications = Application::count();
        $unreadMessages    = Contact::where('is_read', false)->count();

        return view('admin.dashboard', compact('totalStudents', 'totalBusinesses', 'totalInternships', 'totalApplications', 'unreadMessages'));
    }

    public function users()
    {
        $students   = User::where('role', 'student')->get();
        $businesses = User::where('role', 'business')->get();
        return view('admin.users', compact('students', 'businesses'));
    }

    public function internships()
    {
        $internships = Internship::with('business')->latest()->get();
        return view('admin.internships', compact('internships'));
    }

    public function applications()
    {
        $applications = Application::with(['student', 'internship'])->latest()->get();
        return view('admin.applications', compact('applications'));
    }

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function markContactRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        return back()->with('success', 'Marked as read.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function deleteInternship($id)
    {
        $internship = Internship::findOrFail($id);
        $internship->delete();
        return back()->with('success', 'Internship deleted.');
    }
    public function replyContact(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->reply      = $request->reply;
        $contact->is_replied = true;
        $contact->save();

        // Send email to user
        Mail::raw("Hello {$contact->name},\n\nThank you for contacting SkillBridge Africa.\n\nHere is our response:\n\n{$request->reply}\n\n\nBest regards,\nSkillBridge Africa Team", function ($mail) use ($contact) {
            $mail->to($contact->email)
                ->subject("Re: {$contact->subject}");
        });

        return back()->with('success', 'Reply sent successfully.');
    }
}
