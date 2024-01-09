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
        Category::create($data);
        return $this->successResponse('Category Added Successfully', $data, 200);
    }

    public function show($id)
    {

        $category = Category::findOrFail($id);
        return $this->successResponse('This is the Category with id = ' . $id, $category, 200);
    }


    public function update(CategoryRequest $request, $id)
    {

        $category = Category::whereId($id);
        $data['name'] = $request->name;
        $category->update($data);

        return $this->successResponse('Category with id = ' . $id . ' Updated Successfully', $data, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->product){
            return $this->errorResponse('Category with id = ' . $id . ' cannot be deleted due to dependency',422 );
        }
        $category->delete();
        return $this->successResponse('Category with id = ' . $id . ' deleted Successfully', $category, 200);
    }
}
