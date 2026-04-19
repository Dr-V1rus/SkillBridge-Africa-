<?php

namespace App\Http\Controllers;

use App\Models\Internship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AIMatchingController extends Controller
{
    public function getMatches()
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['matches' => [], 'authenticated' => false]);
        }
        
        if ($user->role === 'student') {
            $matches = $this->matchStudentToInternships($user);
            return response()->json(['matches' => $matches, 'role' => 'student', 'authenticated' => true]);
        } elseif ($user->role === 'business') {
            $matches = $this->matchBusinessToStudents($user);
            return response()->json(['matches' => $matches, 'role' => 'business', 'authenticated' => true]);
        }
        
        return response()->json(['matches' => [], 'authenticated' => true]);
    }
    
    private function matchStudentToInternships($student)
    {
        $studentSkills = $student->skills ?? '';
        $studentSkillArray = array_map('trim', explode(',', $studentSkills));
        
        $internships = Internship::where('is_active', true)->get();
        $matches = [];
        
        foreach ($internships as $internship) {
            $internshipSkills = $internship->skills_required ?? '';
            $internshipSkillArray = array_map('trim', explode(',', $internshipSkills));
            
            $matchedSkills = array_intersect($studentSkillArray, $internshipSkillArray);
            $matchCount = count($matchedSkills);
            $totalSkills = max(count($studentSkillArray), 1);
            
            $matchPercentage = ($matchCount / $totalSkills) * 100;
            
            if ($matchPercentage > 0) {
                $matches[] = [
                    'internship' => $internship,
                    'business_name' => $internship->business->name,
                    'match_percentage' => round($matchPercentage),
                    'matched_skills' => array_values($matchedSkills)
                ];
            }
        }
        
        usort($matches, function($a, $b) {
            return $b['match_percentage'] - $a['match_percentage'];
        });
        
        return array_slice($matches, 0, 5);
    }
    
    private function matchBusinessToStudents($business)
    {
        $businessInternships = Internship::where('business_id', $business->id)->get();
        $allSkills = [];
        
        foreach ($businessInternships as $internship) {
            $skills = explode(',', $internship->skills_required ?? '');
            $allSkills = array_merge($allSkills, array_map('trim', $skills));
        }
        
        $allSkills = array_unique($allSkills);
        
        $students = User::where('role', 'student')->get();
        $matches = [];
        
        foreach ($students as $student) {
            $studentSkills = explode(',', $student->skills ?? '');
            $studentSkills = array_map('trim', $studentSkills);
            
            $matchedSkills = array_intersect($allSkills, $studentSkills);
            $matchCount = count($matchedSkills);
            $totalSkills = max(count($allSkills), 1);
            
            $matchPercentage = ($matchCount / $totalSkills) * 100;
            
            if ($matchPercentage > 0) {
                $matches[] = [
                    'student' => $student,
                    'match_percentage' => round($matchPercentage),
                    'matched_skills' => array_values($matchedSkills),
                    'applications_count' => $student->applications->count()
                ];
            }
        }
        
        usort($matches, function($a, $b) {
            return $b['match_percentage'] - $a['match_percentage'];
        });
        
        return array_slice($matches, 0, 5);
    }
}
