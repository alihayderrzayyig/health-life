<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StorPostRequest;
use App\Http\Requests\api\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Traits\HttpResponses;

class PostController extends Controller
{

    use HttpResponses;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(
            // Post::where('user_id', Auth()->user()->id)->get()
            Post::all()
        );
        // return Post::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorPostRequest $request)
    {
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                // $imageName = $request['title'] . '-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $imageName = 'post-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('post_images'), $imageName);
                Image::create([
                    'post_id' => $post->id,
                    'image' => $imageName
                ]);
            }
        }

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->only(['title', 'description']));
        
        if ($request->has('images')) {
            $post->deletePostImages();
            foreach ($request->file('images') as $image) {
                $imageName = 'post-image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('post_images'), $imageName);
                Image::create([
                    'post_id' => $post->id,
                    'image' => $imageName
                ]);
            }
        }
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $this->isNotAuthorized($post) ? $this->isNotAuthorized($post) : $post->deletePost();
        // return response(null,204);
    }


    /**
     * Search for name.
     *
     * @param  String  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        // return $name;
        return Post::where('title', 'like', '%' . $name . '%')->get();
    }

    private function isNotAuthorized($post)
    {
        if (Auth::user()->id !== $post->user_id) {
            return $this->error('', 'You are not authorized to make this request!', 403);
        }
    }
}
