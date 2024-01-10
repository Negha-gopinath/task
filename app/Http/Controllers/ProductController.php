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
        $data['admin_id'] = auth()->user()->id;

        $image = $request->file('image');
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $imagePath = 'uploads/products';
            $path =  $imagePath . '/' . $imageName;
            $imageUploadedPath = $image->move($imagePath, $imageName);

            $data['image'] =  $path;
        }

        Product::create($data);
        return $this->successResponse('Product Added Successfully', $data, 200);
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);

        return $this->successResponse('This is the Product with id = ' . $product->id, $product, 200);
    }


    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data['name'] = $request->name;
        $data['category_id'] = $request->category_id;
        $data['price'] = $request->price;

        $image = $request->file('image');
        if ($image) {
            if ($product->image != "" && file_exists(storage_path($product->image))) {
                unlink(storage_path($product->image));
            }
            $imageName = $image->getClientOriginalName();
            $imagePath = 'uploads/products';
            $path =  $imagePath . '/' . $imageName;
            $imageUploadedPath = $image->move($imagePath, $imageName);

            $data['image'] =  $path;
        }
        $product->update($data);

        return $this->successResponse('Product with id = ' . $product->id . ' Updated Successfully', $data, 200);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        if ($product->image != "" && file_exists(storage_path($product->image))) {
            unlink(storage_path($product->image));
        }
        $product->delete();
        return $this->successResponse('Product with id = ' . $product->id . ' deleted Successfully', $product, 200);
    }
}
