<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\House;
use App\HouseType;
use App\Service;
use App\Photo;
use App\Promotion;
use DateInterval;
use DateTime;

class HouseController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments($house_id, $promotion_name) {

        $house = House::find($house_id);
        $promotion = Promotion::where('name', $promotion_name)->first();

        if($this->isSponsored($house)) {
            $lastPromotionDate = $house->promotions->last()->pivot->end_date;
            $start_date = new DateTime($lastPromotionDate);
        }else {
            $start_date = new DateTime();
        }

        $end_date = clone $start_date;
        $duration = new DateInterval('P'.$promotion->duration.'D'); 
        $end_date->add($duration);

        $house->promotions()->attach($promotion, 
        [
            'start_date' => $start_date->format('Y-m-d H:i:s'),
            'end_date' => $end_date->format('Y-m-d H:i:s')
        ]);
        
        return redirect()
            ->route('admin.houses.index')
            ->with('sponsored', $house->title)
            ->with('promotion', $promotion->duration);
    }

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
        'house_type_id' => 'required|exists:house_types,id',
        'photos.*' => 'image|max:2048'
    ];

    private $createValidationPhoto = [
        'photos' => 'required|array|min:1|max:15',
    ];

    private $editValidationPhoto = [
        'photos' => 'array|min:1|max:15',
    ];

    private function getCoordinates($data) {
        $addressQuery = $data['city'] . ' ' . $data['address'] . ' ' . $data['zip_code'];
        $addressQuery = urlencode($addressQuery);
        $addressQuery = $addressQuery . ".json";
        
        $coordinatesResponse = Http::get('https://api.tomtom.com/search/2/geocode/' . $addressQuery, [
            'key' => '9klnGNAqb9IZGTnJpPeD3XymW9LUsIDx'
        ]);
        
        $coordinatesResponse->json();        
        return $coordinatesResponse['results'][0]['position'];
    }

    private function isSponsored($house) {
        $activeSponsor = false;
        if(count($house->promotions) > 0) {
            $lastPromotionDate = $house->promotions->last()->pivot->end_date;
            $now = new DateTime();

            if ($lastPromotionDate > $now->format('Y-m-d H:i:s')) {
                $activeSponsor = true;
            }
        }
        return $activeSponsor;
    }

    public function index() {
        $houses = House::where('user_id', Auth::id())->get();
        $activeSponsors = [];
        foreach($houses as $house) {
            $activeSponsor = $this->isSponsored($house);
            $activeSponsors[$house->id] = $activeSponsor;
        }
        return view('admin.houses.index', compact('houses', 'activeSponsors'));
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

        $allCreateValidation = array_merge($this->createValidationPhoto, $this->validation);
        $request->validate($allCreateValidation);

        $data['user_id'] = Auth::id();
        
        $coordinates = $this->getCoordinates($data);
        
        $data['latitude'] = $coordinates['lat'];
        $data['longitude'] = $coordinates['lon'];
        
        $newHouse = new House();
        $newHouse->fill($data);
        $newHouse->save();
        
        $newHouse->services()->attach($data['services']);

        foreach ($data['photos'] as $photo) {
            $path = Storage::put('houses/photos/' . $newHouse->id, $photo);
            Photo::create(['house_id' => $newHouse->id, 'path' => $path]);
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
        $activeSponsor = $this->isSponsored($house);
        $houseTypes = HouseType::all();
        return view('admin.houses.show', compact('house', 'houseTypes', 'activeSponsor'));
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
        if ($house['visible'] == 0) {
            $house['visible'] = 2;
        }
        return view('admin.houses.edit', compact('house', 'houseTypes', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        $data = $request->all();
        if ($data['visible'] == '2') {
            $data['visible'] = 0;
        }
        $allEditValidation = array_merge($this->editValidationPhoto, $this->validation);
        $request->validate($allEditValidation);

        //add photo ok
        if(array_key_exists('photos', $data)) {
            foreach ($data['photos'] as $photo) {
                $path = Storage::put('houses/photos/' . $house->id, $photo);
                Photo::create([
                    'house_id' => $house->id,
                    'path' => $path
                ]);
            }
        }

       //delete photos
        if (array_key_exists('delete-imgs', $data)) {

            if (count($house->photos) == (count($data['delete-imgs']))) {
                return back()->withErrors("Attenzione! Non è possibile eliminare tutte le foto!");
            }
            else {
                foreach ($data['delete-imgs'] as $photoCheckbox) {
                    $photo = Photo::find($photoCheckbox);
                    Storage::delete($photo->path);
                    $photo->delete();
                }
            }

            //delete empty folder
            $photoCount = Photo::where('house_id', $house->id)->count(); 
            if($photoCount == 0) {
                Storage::deleteDirectory('houses/photos/' . $house->id);
            }
        }

        $coordinates = $this->getCoordinates($data);
        
        $data['latitude'] = $coordinates['lat'];
        $data['longitude'] = $coordinates['lon'];

        $house->update($data);
        $house->services()->sync($data['services']);

        return redirect()
        ->route('admin.houses.show', $house->id)
        ->with('updated', $house->title);
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
