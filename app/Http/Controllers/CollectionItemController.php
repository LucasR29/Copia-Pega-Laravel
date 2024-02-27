<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionItemRequest;
use App\Http\Requests\UpdateCollectionItemRequest;
use App\Http\Resources\CollectionItemResource;
use App\Models\CollectionItem;
use Illuminate\Support\Facades\DB;

class CollectionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection_items = CollectionItem::getMany();

        return CollectionItemResource::collection($collection_items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionItemRequest $request)
    {
        DB::beginTransaction();

        $collectionItem = CollectionItem::create($request->validated());

        DB::commit();

        return new CollectionItemResource($collectionItem);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $collection_item = CollectionItem::find($id);

        if(!$collection_item) {
            return response()->json(['message' => 'Collection Item not found'], 404);
        }

        return new CollectionItemResource($collection_item);
    }

    public function showByCollection($collectionId)
    {
        $collection_item = CollectionItem::listWhere('collection_id', $collectionId);

        if(!$collection_item) {
            return response()->json(['message' => 'Collection Item not found'], 404);
        }

        return CollectionItemResource::collection($collection_item);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CollectionItem $collectionItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionItemRequest $request, CollectionItem $collectionItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CollectionItem $collectionItem)
    {
        //
    }
}
