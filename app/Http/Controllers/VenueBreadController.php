<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueBreadController extends Controller
{
    public function getVenuesByRegion($region_id)
    {
        return Venue::where('region_id', '=', $region_id)
            ->pluck('id', 'name');
    }
}
