<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: ProductController.php
 * Date: 2022-12-27
 */

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Models\Master\Product;
use App\Http\Controllers\Controller;
use App\Repository\Master\ProductRepository;
use App\Http\Resources\Master\ProductResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\API\Product\ProductStoreRequest;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $product = Product::with(['item', 'unit', 'retailer'])
            ->when($request->retailer, function ($query) use ($request) {
                $query->where('retailer_id', [$request->retailer]);
            })
            ->when($request->status == 'Active', function ($query) {
                $query->active();
            })
            ->when($request->status == 'Inactive', function ($query) {
                $query->inactive();
            })
            ->when($request->keyword, function ($query) use ($request) {
                $query->search($request->keyword);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate();
        return new ProductResource($product, 'fetchdata', Response::HTTP_OK, 'Product retrieved successfully.');
    }

    public function store(ProductStoreRequest $request)
    {

        try {
            $product = new Product();
            $product->item_id = $request->item_id;
            $product->retailer_id = $request->retailer_id;
            $product->unit_id = $request->unit_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->thick = $request->thick;
            $product->width = $request->width;
            $product->length = $request->length;
            $product->flap = $request->flap;
            $product->gusset = $request->gusset;
            $product->pillow_bag = $request->pillow_bag;
            $product->pillow_fold = $request->pillow_fold;
            $product->airhole = $request->airhole;
            $product->sealtape = $request->sealtape;
            $product->sealtape_type = $request->sealtape_type;
            $product->perforation = $request->perforation;
            $product->printing = $request->printing;
            $product->color = $request->color;
            $product->price = $request->price;
            $product->price_buy = $request->price_buy;

            $product->is_active = $request->is_active;
            $product->save();
            return new ProductResource($product, 'store', Response::HTTP_CREATED, 'Product created successfully.');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $product = Product::with(['item', 'retailer', 'unit'])->find($id);
        return new ProductResource($product, 'fetchdata', Response::HTTP_OK, 'Product retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([
            'item_id' => $request->item_id,
            'retailer_id' => $request->retailer_id,
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'description' => $request->description,
            'thick' => $request->thick,
            'width' => $request->width,
            'length' => $request->length,
            'flap' => $request->flap,
            'gusset' => $request->gusset,
            'pillow_bag' => $request->pillow_bag,
            'pillow_fold' => $request->pillow_fold,
            'airhole' => $request->airhole,
            'sealtape' => $request->sealtape,
            'sealtape_type' => $request->sealtape_type,
            'perforation' => $request->perforation,
            'printing' => $request->printing,
            'color' => $request->color,
            'price' => $request->price,
            'price_buy' => $request->price_buy,
            'is_active' => $request->is_active,
        ]);

        return new ProductResource($product, 'update', Response::HTTP_OK, 'Product updated successfully.');
    }
}
