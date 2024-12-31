<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::all());
    }

    public function store(PostStoreRequest $request): PostResource
    {
        return new PostResource($request);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        return new PostResource($post);
    }
}
