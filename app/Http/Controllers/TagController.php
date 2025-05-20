<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function listTags() {
        $tags = Tag::all();
        return response()->json($tags);
    }
}
