<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Name of file: ItemController.php
 * Date: 2022-12-12
 */

namespace App\Http\Controllers\Master;

use App\Models\Master\Item;
use App\Http\Controllers\Controller;
use App\Http\Resources\Master\ItemResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\API\Item\ItemStoreRequest;
use App\Http\Requests\API\Item\ItemUpdateRequest;
use App\Repository\Master\ItemRepository;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $item = Item::with(['unit', 'subgroup'])
            ->where(function ($query) use ($request) {
                if ($request->has('status')) {
                    if ($request->get("status") == "Active") {
                        $query->active();
                    } else if ($request->get("status") == "Inactive") {
                        $query->inactive();
                    } else {
                        $query;
                    }
                }
                if ($request->has('keyword')) {
                    $query->where('name', 'like', '%' . $request->get('keyword') . '%');
                }
            })
            ->orderBy('created_at', 'DESC')
            ->paginate();
        return new ItemResource($item, 'fetchdata', Response::HTTP_CREATED, 'Item get successfully');
    }

    public function store(ItemStoreRequest $request)
    {
        $item = Item::create($request->all());
        return new ItemResource($item, 'store', Response::HTTP_CREATED, 'Item created successfully');
    }

    public function show($id)
    {
        $item = Item::with(['subgroup', 'unit'])->find($id);
        if (!$item) {
            return new ItemResource(null, 'fetchdata', Response::HTTP_NOT_FOUND, 'Item not found');
        }
        return new ItemResource($item, 'fetchdata', Response::HTTP_CREATED, 'Item get successfully');
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());
        return new ItemResource($item, 'update', Response::HTTP_CREATED, 'Item updated successfully');
    }
}
