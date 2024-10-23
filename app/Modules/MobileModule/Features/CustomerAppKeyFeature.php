<?php

namespace App\Modules\MobileModule\Features;

use App\Next\Core\Feature;
use Illuminate\Http\Request;

class CustomerAppKeyFeature extends Feature
{
    /**
     * Execute the feature.
     */
    public function handle(Request $request): int
    {
        return 0;
    }
}
