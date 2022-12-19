<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function filter(Request $request, User $user)
    {
        $user = $user->newQuery();

        // Search for a user based on their name.
        if ($request->has('name')) {
            $user->where('name', $request->name);
        }

        // Search for a user based on their email.
        if ($request->has('email')) {
            $user->where('email', $request->email);
        }

        // Search for a user based on their cpf.
        if ($request->has('cpf')) {
            $user->where('cpf', $request->cpf);
        }

        if(!$user) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return $user->get();
    }
}
