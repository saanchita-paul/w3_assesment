<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\DeploymentCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DeploymentCheckController extends Controller
{
    // B. Add Deployment Check
    public function store(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $deploymentCheck = $project->deploymentChecks()->create($request->all());

        return response()->json($deploymentCheck, 201);
    }

    // C. Mark Check as Completed
    public function complete(DeploymentCheck $deploymentCheck)
    {
        if ($deploymentCheck->is_completed) {
            return response()->json(['message' => 'This check is already completed.'], 409);
        }

        $deploymentCheck->update([
            'is_completed' => true,
            'completed_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Check marked as completed', 'check' => $deploymentCheck]);
    }
}
