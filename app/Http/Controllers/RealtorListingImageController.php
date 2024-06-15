<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        $listing->load('images');
        // dd($listing);
        return inertia(
            'Realtor/Image/create',
            [
                'listing' => $listing
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Listing $listing, Request $request)
    {

        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:png|max:5000',
            ],[
                'images.*.mimes' => 'Images Should Be Of Types:png'
            ]);
            
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');
                $listing->images()->save(new ListingImage([
                    'file_name' => $path
                ]));
            }
            return redirect()->back()->with('success', 'Images Uploaded');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing,ListingImage $image)
    {
        
        // dd($image);
        // dd($image->src);
        // Storage::delete( $image->src);
        Storage::disk('public')->delete($image->file_name);
        
        // $listing->images()->delete($image);
        $image->delete();
    }
}
