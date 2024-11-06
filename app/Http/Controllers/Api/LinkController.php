<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
  
    public function index()
    {
      
        // if (!Auth::check()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Unauthorized access'
        //     ], 401);
        // }

    
        $links = Link::orderBy('id', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Shortened links retrieved successfully',
            'data' => $links
        ], 200);
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'original_link' => 'required|url'
        ]);

        $link = Link::create([
            'original_link' => $request->original_link,
            'shorten_link' => substr(md5(time()), 0, 6) 
        ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Link created successfully',
            'data' => $link
        ], status: 201);
    }

   
    public function show(string $id)
    {
       
        // if (!Auth::check()) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Unauthorized access'
        //     ], 401);
        // }

        
        $link = Link::find($id);
        if (!$link) {
            return response()->json([
                'status' => 'not found',
                'message' => 'Shortened link not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Shortened link retrieved successfully',
            'data' => $link
        ], 200);
    }

  
    public function update(Request $request, string $id)
    {
        $link = Link::find($id);
        if (!$link) {
            return response()->json([
                'status' => 'error',
                'message' => 'Link not found'
            ], 404);
        }

        $request->validate([
            'url' => 'required|url'
        ]);

        $link->update([
            'url' => $request->url
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Link updated successfully',
            'data' => $link
        ], 200);
    }

  
    public function destroy(string $id)
    {
        $link = Link::find($id);
        if (!$link) {
            return response()->json([
                'status' => 'not found',
                'message' => 'Shortened Link not found'
            ], 404);
        }

        $link->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Shortened link deleted successfully'
        ], 200);
    
    }
}
