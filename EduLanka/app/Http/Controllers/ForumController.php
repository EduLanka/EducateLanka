<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::all();

        if (Auth::user()->role == 2) {
            return view('student.forum', compact('forums'));
        } elseif (Auth::user()->role == 3) {
            return view('teacher.forum', compact('forums'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        Forum::create([
            'title' => $request->title,
            'description' =>  $request->description,
            'creator_id' => Auth::user()->id,
        ]);

        Session::flash('success', 'Forum created successfully');

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $forum = Forum::findOrFail($id);
    return response()->json($forum);
}

public function getPosts(string $id)
{
    $forum = Forum::findOrFail($id);
    $posts = $forum->posts()->with('user')->get();

    // Append the image URLs to the posts data
    $postsWithImages = $posts->map(function ($post) {
        $post->image_url = asset('EduLanka/public/posts/' . $post->image);
        return $post;
    });

    return response()->json($postsWithImages);
}

public function sharePost(Request $request,$forumId){
    $forumId = $request->input('forum_id');
    $imageName = null;

    if ($request->hasFile('image')) {
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('EduLanka\public\posts'), $imageName);

    }
    Post::create([
        'title' => $request->title,
        'description' =>  $request->description,
        'image' => $imageName,
        'user_id' => Auth::user()->id,
        'forum_id' => $forumId,
    ]);

    // Find the forum by ID
    $forum = Forum::findOrFail($forumId);

    // Increment and update the num_posts value
    $forum->num_posts = $forum->num_posts + 1;
    $forum->save();

    Session::flash('success', 'Post added to forum successfully');

    return redirect()->back();
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
