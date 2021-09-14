<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\House;
use App\Message;

class ChartController extends Controller
{
    public function index() 
    {
        $messages = [];
        $houses = House::where('user_id', Auth::id())->get();

        foreach ($houses as $house) {
            $messages[] = Message::where('house_id', $house->id)
            ->with('house')
            ->get();    
        }
    
        return view('admin.chart.index', compact('messages', 'house'));
    }
}
