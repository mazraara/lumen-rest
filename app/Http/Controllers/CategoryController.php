<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Create a new auth instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all data from category
     */
    public function index(Request $request)
    {
        $category = new Category;

        return response()->json([
            'success' => true,
            'result' => $category->all(),
        ]);
    }

    /**
     * Save new category
     */
    public function create(Request $request)
    {
        $category = new Category;
        $category->fill(['name' => $request->input('name')]);

        if ($category->save()) {
            return response()->json([
                'success' => true,
                'result' => 'New category created successfully',
            ]);
        }
    }

    /**
     * Get single Category details by id
     */
    public function show(Request $request, $id)
    {
        $category = Category::where('id', $id)->first();
        if ($category !== null) {
            return response()->json([
                'success' => true,
                'result' => $category,
            ]);
        } else {
            return response()->json([
                'success' => true,
                'result' => 'Category not found!',
            ]);
        }
    }

    /**
     * Update Category by id
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->has('name')) {
            $category->name = $request->input('name');
            if ($category->save()) {
                return response()->json([
                    'success' => true,
                    'result' => 'Success update '.$request->input('name'),
                ]);
            }
        } else {
            if ($category->save()) {
                return response()->json([
                    'success' => false,
                    'result' => 'Please fill the category name!',
                ]);
            }
        }
    }

    /**
     * Delete Category by id
     */
    public function delete(Request $request, $id)
    {
        $category = Category::find($id);
        if ($category->delete($id)) {
            return response()->json([
                'success' => true,
                'result' => 'Success delete category',
            ]);
        }
    }
}