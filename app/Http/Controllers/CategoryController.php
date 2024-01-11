<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Traits\RespondsTrait;

class CategoryController extends Controller
{
    use RespondsTrait;


    public function index()
    {
        $category = Category::get();
        return $this->successResponse('These are the category data', $category, 200);
    }

    public function store(CategoryRequest $request)
    {

        $data['name'] = $request->name;
        $data['admin_id'] = auth()->user()->id;
        Category::create($data);
        return $this->successResponse('Category Added Successfully', $data, 200);
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return $this->successResponse('This is the Category with id = ' . $category->id, $category, 200);
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $data['name'] = $request->name;
        $category->update($data);

        return $this->successResponse('Category with id = ' . $category->id . ' Updated Successfully', $data, 200);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        if ($category->product) {
            return $this->errorResponse('Category with id = ' . $category->id  . ' cannot be deleted due to dependency', 422);
        }
        $category->delete();
        return $this->successResponse('Category with id = ' . $category->id . ' deleted Successfully', $category, 200);
    }
}
