<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Add a new bookmark
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:lowongan,id',
        ]);

        $bookmark = Bookmark::create([
            'user_id' => Auth::id(),
            'job_id' => $request->job_id,
        ]);

        return response()->json(['message' => 'Bookmark added successfully', 'bookmark' => $bookmark], 201);
    }

    // Remove a bookmark
    public function destroy($id)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('job_id', $id)->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['message' => 'Bookmark removed successfully'], 200);
        }

        return response()->json(['message' => 'Bookmark not found'], 404);
    }

    // Get all bookmarks for the authenticated user
    public function index()
    {
        $bookmarks = Bookmark::with('job')->where('user_id', Auth::id())->get();
        return response()->json(['bookmarks' => $bookmarks], 200);
    }
}
