<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function getAllProjects()
        {
            $projects = DB::table('projects')->get();
            return response()->json($projects);
        }

    public function createProject(Request $request)
        {
            $user = $request->user();
        //dd($user->name);

        if($user->hasRole('admin') ||  $user->hasRole('project-leader')){
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255'],
                'start_date' => ['required', 'date'],
                'end_date'=>['nullable','date'],
                'project_leader' => ['required', 'string', 'max:255'],
                'priority' => ['nullable', 'string']
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors(),
                ], 422); // Return 422 Unprocessable Entity status code for validation failure
            }
    
            // Create a new task instance
            $project = Projects::create([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date ?? now(),
                'end_date' => $request->end_date,
                'project_leader' => $request->project_leader,
                'created_by' => $user->name,
                'status' => $request->status ?? 'Planning',
                'priority' => $request->priority ?? 'Normal'
            ]);
    
            // Return a response with the newly created task
            return response()->json([
                'message' => 'Project Successfully Created',
                'project' => $project,
            ]);
        }
        }

        public function deleteProject($id)
        {
            try {
                // Find the task by ID
                $task = Projects::findOrFail($id);
                
                // Delete the task
                $task->delete();
                
                // Return a success response
                return response()->json(['message' => 'Project deleted successfully']);
            } catch (\Exception $e) {
                // Return an error response if the task was not found or if there was an error during deletion
                return response()->json(['error' => 'Failed to delete project'], 500);
            }
        }    
}
