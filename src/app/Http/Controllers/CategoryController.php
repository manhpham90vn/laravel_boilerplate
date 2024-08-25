<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return $this->successResponse($categories, 'Products retrieved successfully.');
    }
}
