<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Traits\RespondsTrait;
use App\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    use RespondsTrait;
    public function index()
    {
        $product = Product::get();
        return $this->successResponse('These are the product data', $product, 200);
    }

    public function store(ProductRequest $request)
    {
        $data['name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['price'] = $request->price;

        $image = $request->file('image');
        if ($image) {
            $imageUploadedPath = $image->store('product', 'public');
            $image_path = Storage::disk('public')->url($imageUploadedPath);
            $data['image'] =  url($imageUploadedPath);
        }

        // $data['image'] =  $image;
        dd(  $data);
        Product::create($data);
        return $this->successResponse('Product Added Successfully', $data, 200);
    }

    public function show($id)
    {

        $product = Product::findOrFail($id);
        return $this->successResponse('This is the Product with id = ' . $id, $product, 200);
    }


    public function update(ProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);
        $data['name'] = $request->name;
        $product->update($data);

        return $this->successResponse('Category with id = ' . $id . ' Updated Successfully', $data, 200);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->successResponse('Category with id = ' . $id . ' deleted Successfully', $category, 200);
    }
}
