<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;

        $this->authorize('view',$listing);

        
        //Accept Offer 
        $offer->update(['accepted_at' => now()]);

        //Set sold_at Column in Listing
        $listing->sold_at = now();
        $listing->save();

        //Rejecte Other Offers
        $listing->offers()->except($offer)->update([
            'rejected_at' => now()
        ]);



        return redirect()->back()->with('success','Offer Accepted Successfully');
    }
}
