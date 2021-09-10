<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Promotion;
use App\House;

class PaymentsController extends Controller
{
    public function make($id, $promotion_name) {

        $house = House::find($id);
        $promotion = Promotion::where('name', $promotion_name)->get();
        return view('admin.make.payments', compact('house', 'promotion'));
    }
}
