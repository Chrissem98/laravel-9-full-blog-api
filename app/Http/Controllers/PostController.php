<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Pipeline\Pipeline;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Pipes\Posts\PostSortFilter;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Pipes\Posts\PostFieldsFilter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = app(Pipeline::class)
                    ->send(Post::query())
                    ->through([
                        PostFieldsFilter::class,
                        PostSortFilter::class,
                    ])
                    ->thenReturn()
                    ->paginate(20);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::updateOrCreate($request->all());

        return response()->json([
            'message' => 'Post created successfully',
            'success' => [
                'data' => new PostResource($post),
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return response()->json([
            'message' => 'Post updated successfully',
            'success' => [
                'data' => new PostResource($post),
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->delete())
            return response()->json([
                'message' => 'Deleted succeed',
                'success' => [
                    'remove-data' => new PostResource($post),
                ],
            ]);
    }
}
