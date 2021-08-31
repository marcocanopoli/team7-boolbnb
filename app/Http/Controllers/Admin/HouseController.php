<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;
use App\HouseType;
use App\Service;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $validation = [
        'title' => 'required|max:100',
        'rooms' => 'required|numeric|min:1|max:255',
        'beds' => 'required|numeric|min:1|max:255',
        'bathrooms' => 'required|numeric|min:1|max:255',
        'square_meters' => 'required|numeric|min:14|max:1000',
        'city' => 'required|max:60',
        'address' => 'required|max:100',
        'zip_code' => 'required|min:4|max:10',
        'description' => 'required|max:3000',
        'price' => 'required|numeric|min:1|max:9999',
        'guests' => 'required|numeric|min:1|max:20',
        'visible' => 'required|numeric|min:0|max:1',
        'services' => 'required|exists:services,id',
        'house_types' => 'required|exists:house_types,id',
    ];

    public function index() {
        $houses = House::where('user_id', Auth::id())->get();
        return view('admin.houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $houseTypes = HouseType::all();
        $services = Service::all();

        return view('admin.houses.create', compact('houseTypes', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate($this->validation);
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        return view('admin.houses.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
