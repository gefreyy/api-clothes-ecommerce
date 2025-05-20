<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function listGenders() {
        $genders = Gender::all();
        return response()->json($genders);
    }
}
