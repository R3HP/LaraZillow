<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{

    public function before(?User $user,$ability){
        if($user?->is_admin){
            return true;
        }

    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): bool
    {
        if($listing->owner->id == $user?->id){
            return true;
        }
        return $listing->sold_at === null;
        // if($listing->sold_at){
        //     return false;
        // }
        // return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, Listing $listing): bool
    {

        if ($listing->sold_at === null && ($user?->id === $listing->owner_id))
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, Listing $listing): bool
    {
        if ($user?->id === $listing->owner_id)
            return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user, Listing $listing): bool
    {
        if ($user?->id === $listing->owner_id)
            return true;
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user, Listing $listing): bool
    {
        if ($user?->id === $listing->owner_id)
            return true;
        return false;
    }
}
