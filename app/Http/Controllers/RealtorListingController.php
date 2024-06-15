<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->boolean('deleted'));

        $filters = [
            'deleted' => $request->boolean('deleted'),
            'by' => $request->get('by'),
            'order' => $request->get('order')
        ];

        // dd($filters);

        // dd(Auth::user()->listings);
        return inertia(
            'Realtor/index',
            [
                'paginator' => Auth::user()->listings()->withCount('images')->withCount('offers')->filter($filters)->paginate(5)->withQueryString(),
                'filters' => $filters
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Realtor/create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->create($request->validate([
            'beds' => 'required|integer|min:0|max:1000',
            'baths' => 'required|integer|min:0|max:1000',
            'area' => 'required|integer|min:25|max:1000',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required',
            'price' => 'required|integer|min:10',
        ]));
        return redirect()->route("realtor.listing.index")->with('success', 'Listing Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $listing->load('offers','offers.bidder');
        return inertia(
            'Realtor/show',
            [
                'listing' => $listing
            ]
        );
    }

    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/edit',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update($request->validate([
            'beds' => 'required|integer|min:0|max:1000',
            'baths' => 'required|integer|min:0|max:1000',
            'area' => 'required|integer|min:25|max:1000',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required',
            'price' => 'required|integer|min:10',
        ]));
        return redirect()->route("realtor.listing.index")->with('success', 'Listing Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $result = $listing->deleteOrFail();
        if ($result) {
            return redirect()->back()->with('success', 'Deleted Successfully');
        } else {
            return redirect()->back()->with('fail', 'Could Not Delete');
        }
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success', 'Restored Successfully');
    }
}
