<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function listColors() {
        $colors = Color::all();
        return response()->json($colors);
    }
}
