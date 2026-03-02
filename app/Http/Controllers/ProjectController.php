<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    // A. Create Project
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'owner_email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project = Project::create($request->all());

        return response()->json($project, 201);
    }

    // D. Deployment Readiness Endpoint
    public function readiness(Project $project)
    {
        $totalChecks = $project->deploymentChecks()->count();
        $completedChecks = $project->deploymentChecks()->where('is_completed', true)->count();
        $isReady = $totalChecks > 0 && $totalChecks === $completedChecks;

        return response()->json([
            'project' => $project->name,
            'total_checks' => $totalChecks,
            'completed_checks' => $completedChecks,
            'is_ready_for_deployment' => $isReady,
        ]);
    }

    // E. List Projects
    public function index()
    {
        $projects = Project::withCount([
            'deploymentChecks as total_checks',
            'deploymentChecks as completed_checks' => function ($query) {
                $query->where('is_completed', true);
            }
        ])->orderBy('created_at', 'desc')->get(); 


        $projectsTransformed = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'name' => $project->name,
                'owner_email' => $project->owner_email,
                'release_date' => $project->release_date,
                'total_checks' => (int) $project->total_checks,
                'completed_checks' => (int) $project->completed_checks,
            ];
        });

        return response()->json($projectsTransformed);
    }
}