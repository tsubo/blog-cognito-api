<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Post::all());
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = new Post($request->all());
        $post->save();

        return response()->json($post);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        // dump(Auth::user());
        Gate::authorize('admin-req', $request);

        $post->fill($request->all());
        $post->save();

        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        // dump(Auth::user());
        Gate::authorize('manager');

        $post->delete();

        return response()->json($post);
    }
}
