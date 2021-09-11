<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Promotion;
use App\House;

class PaymentsController extends Controller
{
    public function make($house_id, $promotion_name) {

        $house = House::find($house_id);
        $promotion = Promotion::where('name', $promotion_name)->first();
        return view('admin.make.payments', compact('house', 'promotion'));
    }
}
