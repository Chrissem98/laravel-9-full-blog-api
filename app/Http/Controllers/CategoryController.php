<?php

namespace App\Http\Controllers;

use App\Http\Pipes\Categories\CategoryFieldsFilter;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Response;
use Illuminate\Pipeline\Pipeline;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // dd(request()->has('fields'));
        $categories = app(Pipeline::class)
                        ->send(Category::query())
                        ->through([
                            CategoryFieldsFilter::class
                        ])
                        ->thenReturn()
                        ->paginate(20);

        // dd($categories);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $request
     * @return Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::updateOrCreate($request->all());

        return response()->json([
            'message' => 'Category created successfully',
            'success' => [
                'data' => new CategoryResource($category),
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json([
            'message' => 'Category updated successfully',
            'success' => [
                'data' => new CategoryResource($category),
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        if($category->delete())
            return response()->json([
                'message' => 'Deleted succeed',
                'success' => [
                    'remove-data' => new CategoryResource($category),
                ],
            ]);
    }
}