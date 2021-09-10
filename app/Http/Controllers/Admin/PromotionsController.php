<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Promotion;
use App\House;

class PromotionsController extends Controller
{
    public function promote($id) {
        $house = House::find($id);
        $promotions = Promotion::all();
        return view('admin.sponsor.promotions', compact('promotions', 'house'));
    }
}
