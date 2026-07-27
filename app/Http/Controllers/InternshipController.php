<?php
namespace App\Http\Controllers;

use App\Models\Internship;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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

        // Calculate match percentage for each internship if user is a student
        $matchData = [];
        if (Auth::check() && Auth::user()->role === 'student') {
            $studentSkills     = Auth::user()->skills ?? '';
            $studentSkillArray = array_map('trim', explode(',', $studentSkills));

            foreach ($internships as $internship) {
                $internshipSkills     = $internship->skills_required ?? '';
                $internshipSkillArray = array_map('trim', explode(',', $internshipSkills));

                $matchedSkills = array_intersect($studentSkillArray, $internshipSkillArray);
                $matchCount    = count($matchedSkills);
                $totalSkills   = max(count($studentSkillArray), 1);

                $matchPercentage = ($matchCount / $totalSkills) * 100;

                $matchData[$internship->id] = [
                    'percentage'     => round($matchPercentage),
                    'matched_skills' => array_values($matchedSkills),
                ];
            }
        }

        return view('internships.index', compact('internships', 'matchData'));
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
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'skills_required' => 'nullable|string',
            'location'        => 'required|string|max:255',
            'type'            => 'required|in:remote,onsite,hybrid',
            'duration'        => 'required|string|max:255',
            'deadline'        => 'required|string|max:255',
        ]);

        Internship::create([
            'business_id'     => Auth::id(),
            'title'           => $request->title,
            'description'     => $request->description,
            'skills_required' => $request->skills_required,
            'location'        => $request->location,
            'type'            => $request->type,
            'duration'        => $request->duration,
            'deadline'        => $request->deadline,
        ]);

        return redirect()->route('internships.index')->with('success', 'Internship posted successfully.');
    }

    public function show(Internship $internship)
    {
        // Calculate match percentage for this internship if user is a student
        $matchData = null;
        if (Auth::check() && Auth::user()->role === 'student') {
            $studentSkills        = Auth::user()->skills ?? '';
            $studentSkillArray    = array_map('trim', explode(',', $studentSkills));
            $internshipSkills     = $internship->skills_required ?? '';
            $internshipSkillArray = array_map('trim', explode(',', $internshipSkills));

            $matchedSkills = array_intersect($studentSkillArray, $internshipSkillArray);
            $matchCount    = count($matchedSkills);
            $totalSkills   = max(count($studentSkillArray), 1);

            $matchPercentage = ($matchCount / $totalSkills) * 100;

            if ($matchPercentage > 0) {
                $matchData = [
                    'percentage'     => round($matchPercentage),
                    'matched_skills' => array_values($matchedSkills),
                ];
            }
        }

        return view('internships.show', compact('internship', 'matchData'));
    }

    public function applications(Internship $internship)
    {
        return view('internships.applications', compact('internship'));
    }

    public function matched()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            $studentSkills     = $user->skills ?? '';
            $studentSkillArray = array_map('trim', explode(',', $studentSkills));

            $internships        = Internship::where('is_active', true)->get();
            $matchedInternships = [];

            foreach ($internships as $internship) {
                $internshipSkills     = $internship->skills_required ?? '';
                $internshipSkillArray = array_map('trim', explode(',', $internshipSkills));

                $matchedSkills = array_intersect($studentSkillArray, $internshipSkillArray);
                $matchCount    = count($matchedSkills);
                $totalSkills   = max(count($studentSkillArray), 1);

                $matchPercentage = ($matchCount / $totalSkills) * 100;

                if ($matchPercentage > 0) {
                    $matchedInternships[] = [
                        'internship'       => $internship,
                        'match_percentage' => round($matchPercentage),
                        'matched_skills'   => array_values($matchedSkills),
                    ];
                }
            }

            usort($matchedInternships, function ($a, $b) {
                return $b['match_percentage'] - $a['match_percentage'];
            });

            // Manual pagination instead of collection paginate
            $page    = request()->input('page', 1);
            $perPage = 10;
            $offset  = ($page - 1) * $perPage;
            $items   = \array_slice($matchedInternships, $offset, $perPage);
            $total   = \count($matchedInternships);

            $internships = new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

            return view('internships.matched', compact('internships', 'studentSkills'));
        }

        return redirect()->route('dashboard');
    }
}
