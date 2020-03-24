<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return response([
            'success'   => true,
            'message'   => 'All Posts',
            'data'      => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required'    => 'Input Title Required!',
                'content.required'    => 'Input Content Required!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Input Field Blank',
                'data'      => $validator->errors()
            ], 400);
        } else {
            $post = Post::create([
                'title'     => $request->input('title'),
                'content'   => $request->input('content')
            ]);

            if ($post) {
                return response()->json([
                    'success'   => true,
                    'message'   => 'Post Created'
                ], 200);
            } else {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Posting Failed'
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return response()->json([
                'success'   => true,
                'message'   => 'Post Details',
                'data'      => $post
            ], 200);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Post Not Found',
                'data'      => ''
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ],
            [
                'title.required'    => 'Input Title Required!',
                'content.required'    => 'Input Content Required!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success'   => false,
                'message'   => 'Input Field Blank',
                'data'      => $validator->errors()
            ], 400);
        } else {
            $post = Post::whereId($request->input('id'))->update([
                'title'     => $request->input('title'),
                'content'   => $request->input('content'),
            ]);

            if ($post) {
                return response()->json([
                    'success'   => 'true',
                    'message'   => 'Post Updated'
                ], 200);
            } else {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Post Fail Updated'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'success'   => true,
                'message'   => 'Post Deleted'
            ], 200);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Post Fail Deleted'
            ], 500);
        }
    }
}
