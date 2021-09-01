<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\House;
use App\HouseType;
use App\Service;
use App\Photo;

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
        'visible' => 'required|numeric|min:1|max:2',
        'services' => 'required|exists:services,id',
        'house_types' => 'required|exists:house_types,id',
        'photos' => 'required|array|min:1|max:15',
        'photos.*' => 'image|max:2048'
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
        if ($data['visible'] == '2') {
            $data['visible'] = 0;
        }

        $request->validate($this->validation);
        $data['user_id'] = Auth::id();
        $data['longitude'] = 11.1111;
        $data['latitude'] = 22.2222;        
        
        $newHouse = new House();
        $newHouse->fill($data);
        $newHouse->save();
        
        $newHouse->services()->attach($data['services']);

        foreach ($data['photos'] as $photo) {
            $path = Storage::put('houses/photos/' . $newHouse->id, $photo);
            Photo::create([
                'house_id' => $newHouse->id,
                'path' => $path
            ]);
        }

        return redirect()
            ->route('admin.houses.show', $newHouse->id)
            ->with('created', $newHouse->title);
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
    public function edit(House $house)
    {
        $houseTypes = HouseType::all();
        $services = Service::all();
        return view('admin.houses.edit', compact('house', 'houseTypes', 'services'));
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
    public function destroy(House $house)
    {
        $house->delete();

        foreach ($house->photos as $photo) {
            Storage::delete($photo->path);
        }
        Storage::deleteDirectory('houses/photos/' . $house->id);

        return redirect()
            ->route('admin.houses.index')
            ->with('deleted', $house->title);
    }
}
