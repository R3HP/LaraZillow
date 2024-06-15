<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except('index','show');
        $this->authorizeResource(Listing::class,'listing');
        // $this->authorizeResource(Offer::class,'offer');
    }

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        // dd($request->query());
        // dd(Listing::orderByDesc('created_at')->where('price','>=',1000000));

        // dd(Listing::orderByDesc('created_at')->paginate(10));
        return inertia('Listing/index',[
            'paginator' => Listing::mostRecent()->filter($filters)->withoutSold()->paginate(10),
                'filters' => $filters
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $firstoffersMadeByUser =  Auth::user() ? $listing->offers()->byMe()->first() : null;
        $listing->load(['images']);
        return inertia('Listing/show',[
            'listing' => $listing,
            'offerMadeByUser' => $firstoffersMadeByUser
        ]);
    }
}
