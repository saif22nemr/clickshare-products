<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

use App\Http\Resources\ProductResource;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index(Request $request)
    {
        $request->validate([
            'prePage' => 'integer|nullable|min:1',
            'page' => 'nullable|integer|min:1',
            'sort' => 'nullable|in:created_at,quantity,name',
            'order' => 'nullable|in:desc,asc',
        ]);
        $prePage = $request->prePage > 0 ? $request->prePage : 20;
        $sort = !empty($request->sort) ? $request->sort : 'created_at';
        $order = !empty($request->order) ? $request->order : 'desc';
        $products = Product::orderBy($sort , $order)->paginate($prePage);
        return $this->successResponse(data: [
            'products' => $products->items(),
            'hasMorePage' => $products->hasMorePages(),
            'currentPage' => $products->currentPage(),
            'lastPage' => $products->lastPage(),
        ]);
    }

    public function show(Product $product)
    {
        return $this->successResponse(data: new ProductResource($product));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $user = auth('sanctum')->user();
        $data['user_id'] = $user->id;

        $product = Product::create($data);
        return $this->successResponse(message: trans('app.success_message'), data: new ProductResource($product));
    }
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $user = auth('sanctum')->user();
        $product->update($data);
        return $this->successResponse(message: trans('app.success_message'), data: new ProductResource($product));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->successResponse(message: trans('app.deleted_success'), data: new ProductResource($product));
    }
}
