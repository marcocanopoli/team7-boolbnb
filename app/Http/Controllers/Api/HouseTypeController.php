<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HouseType;

class HouseTypeController extends Controller
{
    public function index() {

        $houses_types = HouseType::all();

        return response()->json($houses_types);
    }
}
