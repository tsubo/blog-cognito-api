<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function me()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    public function admin()
    {
        return response()->json(["admin" => true]);
    }

    public function manager()
    {
        return response()->json(["manager" => true]);
    }
}
