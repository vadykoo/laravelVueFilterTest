<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keywords = $request->get('name');
        $bedrooms = $request->get('bedrooms');
        $bathrooms = $request->get('bathrooms');
        $storeys = $request->get('storeys');
        $garages = $request->get('garages');
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');

        if(isset($keywords)) {
            $properties = Property::where('name', 'like', '%' . $keywords . '%')->get();
        }else{
            $properties = Property::all();
        }

        $properties = $properties->when($bedrooms, function ($query) use ($bedrooms) {
            return $query->where('bedrooms', $bedrooms);
        });
        $properties = $properties->when($bathrooms, function ($query) use ($bathrooms) {
            return $query->whereIn('bathrooms', $bathrooms);
        });
        $properties = $properties->when($storeys, function ($query) use ($storeys) {
            return $query->whereIn('storeys', $storeys);
        });
        $properties = $properties->when($garages, function ($query) use ($garages) {
            return $query->whereIn('garages', $garages);
        });
        $properties = $properties->when($minPrice, function ($query) use ($minPrice) {
            return $query->where('price', '>=', $minPrice);
        });
        $properties = $properties->when($maxPrice, function ($query) use ($maxPrice) {
            return $query->where('price', '<=', $maxPrice);
        });

        return response()->json($properties
            ->makeHidden(['created_at', 'updated_at'])
            ->values()
            ->toArray()
        );
    }
}
