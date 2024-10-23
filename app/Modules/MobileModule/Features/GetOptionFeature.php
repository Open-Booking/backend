<?php

namespace App\Modules\MobileModule\Features;

use App\Helpers\JsonResponder;
use App\Modules\MobileModule\Jobs\GetOptionJob;
use App\Next\Core\Feature;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class GetOptionFeature extends Feature
{
    public function __construct(private readonly string $key)
    {
    }

    /**
     * Execute the feature.
     */
    public function handle(): JsonResponse
    {
        $options = $this->run(new GetOptionJob($this->key));

        return JsonResponder::success('Option data has been successfully retrieved', $options['data'], Arr::only($options, ['current_page', 'per_page', 'total']));
    }
}
