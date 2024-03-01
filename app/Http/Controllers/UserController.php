<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function showUsers()
        {
            $users = User::all();
            return response()->json($users);
        }


        public function delete($id)
        {
            try {
                // Find the user by ID
                $user = User::findOrFail($id);
                
                // Delete the user
                $user->delete();
                
                // Return a success response
                return response()->json(['message' => 'User deleted successfully']);
            } catch (\Exception $e) {
                // Return an error response if the user was not found or if there was an error during deletion
                return response()->json(['error' => 'Failed to delete user'], 500);
            }
        }
            
}
