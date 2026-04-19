<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Internship;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function getFeed()
    {
        $activities = [];
        
        $recentApplications = Application::with(['student', 'internship'])
            ->latest()
            ->take(5)
            ->get();
            
        foreach ($recentApplications as $app) {
            $activities[] = [
                'message' => $app->student->name . ' applied for ' . $app->internship->title,
                'time' => $app->created_at->diffForHumans(),
                'type' => 'application'
            ];
        }
        
        $recentInternships = Internship::with('business')
            ->latest()
            ->take(3)
            ->get();
            
        foreach ($recentInternships as $internship) {
            $activities[] = [
                'message' => $internship->business->name . ' posted: ' . $internship->title,
                'time' => $internship->created_at->diffForHumans(),
                'type' => 'internship'
            ];
        }
        
        $recentStudents = User::where('role', 'student')
            ->latest()
            ->take(3)
            ->get();
            
        foreach ($recentStudents as $student) {
            $activities[] = [
                'message' => 'New student joined: ' . $student->name,
                'time' => $student->created_at->diffForHumans(),
                'type' => 'student'
            ];
        }
        
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        
        return response()->json(['activities' => array_slice($activities, 0, 10)]);
    }
}
