<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::with(["category", "messages"])->where("user_id", Auth::id())->get();
        return view("admin.apartments.index", compact("apartments"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $categories = Category::all();
        return view("admin.apartments.create", compact("services", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        //Validazione
        $form_data = $request->validated();
        //Aggiungo user_id
        $form_data["user_id"] = Auth::id();
        //Genero lo slug
        $form_data["slug"] = Helpers::generateSlug($form_data["title"]);

        //Chiamo api tomtom per latitudine e longitudine
        $address = $form_data['street_address'] . " " . $form_data["house_number"] . " " . $form_data["postal_code"];
        $address = urlencode($address);
        $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $address . ".json?key=QEZMPbAxyM5B51twR2BRzWuWxSUDiBYg";
        $response = Http::withOptions(['verify' => false])->get($urlTomTom);
        $data = json_decode($response->body(), true);

        //Setto latitudie e longitudine
        $form_data["latitude"] = $data["results"][0]["position"]["lat"];
        $form_data["longitude"] = $data["results"][0]["position"]["lon"];

        //Aggiungo l'immagine se c'è nello storage e salvo il percorso
        $path = Storage::put("apartment_images", $form_data["cover_image"]);
        $form_data["cover_image"] = $path;

        if ($request->has('visible')) {
            $form_data['visible'] = 1;
        } else {
            $form_data['visible'] = 0;
        }

        //Creo appartmanento
        $newApartment = Apartment::create($form_data);

        //Creo Indirizzo
        $newApartmentAddress = Address::create([
            'apartment_id' => $newApartment->id,
            'latitude' => $form_data['latitude'],
            'longitude' => $form_data['longitude'],
            'street_address' => $form_data['street_address'],
            'house_number' => $form_data['house_number'],
            'postal_code' => $form_data['postal_code']
        ]);

        //Aggiungo l'indirizzo all'appartamento
        $newApartment->address()->save($newApartmentAddress);

        //Aggiungo i servizi alla tabella ponte se essi ci sono
        if ($request->has("services")) {
            $newApartment->services()->attach($form_data["services"]);
        }

        return redirect()->route("admin.apartments.show", $newApartment->slug)->with("message", "$newApartment->title created with success!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        return view("admin.apartments.show", compact("apartment"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $categories = Category::all();
        $services = Service::all();
        return view("admin.apartments.edit", compact("apartment", "categories", "services"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApartmentRequest  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->validated();
        $form_data["slug"] = Helpers::generateSlug($form_data["title"]);

        //Se la modifica include l'immagine
        if ($request->hasFile("cover_image")) {
            //Se il post da modificare ha già l'immagine andiamo a eliminarla
            if ($apartment->cover_image) {
                Storage::delete($apartment->cover_image);
            }

            $path = Storage::put("apartment_images", $form_data["cover_image"]);
            $form_data["cover_image"] = $path;
        }

        $apartment->update($form_data);

        if (
            $form_data["street_address"] != $apartment->address->street_address
            || $form_data["house_number"] != $apartment->address->house_number
            ||  $form_data["postal_code"] != $apartment->address->postal_code
        ) {
            //Chiamo api tomtom per latitudine e longitudine
            $address = $form_data['street_address'] . " " . $form_data["house_number"] . " " . $form_data["postal_code"];
            $address = urlencode($address);
            $urlTomTom = "https://api.tomtom.com/search/2/geocode/" . $address . ".json?key=QEZMPbAxyM5B51twR2BRzWuWxSUDiBYg";
            $response = Http::withOptions(['verify' => false])->get($urlTomTom);
            $data = json_decode($response->body(), true);

            //Setto latitudie e longitudine
            $form_data["latitude"] = $data["results"][0]["position"]["lat"];
            $form_data["longitude"] = $data["results"][0]["position"]["lon"];
        } else {

            //Setto latitudie e longitudine
            $form_data["latitude"] = $apartment->address->latitude;
            $form_data["longitude"] =  $apartment->address->longitude;
        }

        $apartment->address()->update([
            'apartment_id' => $apartment->id,
            'latitude' => $form_data['latitude'],
            'longitude' => $form_data['longitude'],
            'street_address' => $form_data['street_address'],
            'house_number' => $form_data['house_number'],
            'postal_code' => $form_data['postal_code']
        ]);

        // $apartment->address()->update($newAddress);

        //Se riceviamo i servizi
        if ($request->has('services')) {
            //Sincronizzo le services con quelle presenti
            $apartment->services()->sync($form_data["services"]);
        } else {
            //Rimuovo le services
            $apartment->services()->detach();
        }

        return redirect()->route("admin.apartments.show", $apartment->slug)->with("message", "$apartment->title modified with success!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->cover_image) {
            Storage::delete($apartment->cover_image);
        }

        $apartment->services()->detach();
        $apartment->address()->delete();
        $apartment->sponsorships()->detach();
        $apartment->messages()->delete();
        $apartment->views()->delete();

        $apartment->delete();

        return redirect()->back()->with("message", "$apartment->title was canceled with success!");
    }
}
