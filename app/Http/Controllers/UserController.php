<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        Log::info('Attempting login for email: ' . $email);

        $user = DB::table('users')->where('email', $email)->first();

        if (!$user) {
            Log::warning('User not found for email: ' . $email);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        if ($password !== $user->password) {
            Log::warning('Password mismatch for email: ' . $email);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        Log::info('Password match successful for email: ' . $email);

        return response()->json([
            'message' => 'Login successful',
            'user' => $user, // Return user details if needed on the client side
        ], 200);
    }
}
