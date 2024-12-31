<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $posts = Post::query()
            ->when(\request('status'), function ($q) {
                $q->where('status', \request('status'));
            })->latest()->get();

        return Inertia::render('Post/Index', props: [
            'posts' => $posts,
            'postStatus' => ['active', 'inactive'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Post::create($data);

        return redirect(route('posts.index'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): Response
    {
        return Inertia::render('Post/Edit', props: [
            'post' => $post,
            'active' => 'active',
            'inactive' => 'inactive',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): Application|Redirector|RedirectResponse
    {
        $post->delete();
        return redirect(route('posts.index'));
    }
}
