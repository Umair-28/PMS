<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class TaskController extends Controller
{
    public function getAllTasks(Request $request)
    {
        $user = $request->user();
        if($user->hasRole("developer")){
            $tasks = DB::table('tasks')->where('assignee',$user->name)->get();
            return response()->json($tasks);
        }

        $tasks = DB::table('tasks')->get();
        return response()->json($tasks);
    }

    public function create(Request $request)
    {
        $user = $request->user();
        //dd($user->name);

        if($user->hasRole('admin') ||  $user->hasRole('project-leader')){
            $validator = Validator::make($request->all(), [
                'description' => ['required', 'string', 'max:255'],
                'assignee' => ['required', 'string'],
    
                'status' => ['nullable', 'string'],
                'priority' => ['nullable', 'string'],
                'due_date' => ['nullable', 'date'], // Add validation for 'due_date'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'error' => 'Validation failed',
                    'messages' => $validator->errors(),
                ], 422); // Return 422 Unprocessable Entity status code for validation failure
            }
    
            // Create a new task instance
            $task = Task::create([
                'description' => $request->description,
                'assignee' => $request->assignee,
                'assigned_by' => $user->name,
                'status' => $request->status ?? 'Back Log',
                'priority' => $request->priority ?? 'Normal',
                'due_date' => $request->due_date ?? now(),
            ]);
    
            // Return a response with the newly created task
            return response()->json([
                'message' => 'Task Successfully Created',
                'task' => $task,
            ]);
        }

       
    }

    public function update(Request $request, $id)
{
    $user = $request->user();
    
    // Validate input based on user role
    if ($user->role === 'develop') {
        $validatedData = $request->validate([
            'status' => ['required', 'string'], // Only allow updating status for developers
        ]);
    } else {
        // Admin and leader roles can update all fields
        $validatedData = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'assignee' => ['required', 'string'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'due_date' => ['required', 'date'],
        ]);
    }

    // Update the task
    $task = Task::findOrFail($id);
    $task->update($validatedData);

    // Return a success response
    return response()->json(['message' => 'Task updated successfully']);
}




            public function delete($id)
            {
                try {
                    // Find the task by ID
                    $task = Task::findOrFail($id);
                    
                    // Delete the task
                    $task->delete();
                    
                    // Return a success response
                    return response()->json(['message' => 'Task deleted successfully']);
                } catch (\Exception $e) {
                    // Return an error response if the task was not found or if there was an error during deletion
                    return response()->json(['error' => 'Failed to delete task'], 500);
                }
            }
        
}
