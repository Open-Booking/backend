<?php

namespace App\Modules\MobileModule\Http\Controllers;

use App\Modules\MobileModule\Features\IndexCategoryFeature;
use App\Next\Core\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->serve(new IndexCategoryFeature());
    }
}
