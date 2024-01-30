<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\CollectionsResource;
use App\Http\Resources\SingleCollectionResource;
use App\Models\Collection;
use App\Services\API\CollectionService;
use Illuminate\Http\Request;

class CollectionsController extends BaseController
{
    /**
     * route(/collections)
     * return all collections
     */
    public function index()
    {
        $apiData = CollectionsResource::collection(Collection::all());

        return response()->json(['status' => 'OK', 'code' => 200, 'collections' => $apiData], 200);
    }

    /**
     * route(/collections/add)
     * creating new collection
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Services\API\CollectionService  $service
     */
    public function create(Request $request, CollectionService $service)
    {
        $validation = $service->validate($request->input());

        if ($validation->fails()) {
            return response()->json(['status' => 'Unprocessable Content', 'code' => 422, 'message' => $validation->errors()->all()], 422);
        }

        $insertedData = $service->insertValidatedData($validation->validated());

        $collection = new CollectionsResource($insertedData);

        return response()->json(['status' => 'Created', 'code' => 201, 'collection' => $collection], 201);
    }

    /**
     * route(/collections/{collection}/show)
     * return collection by Id
     *
     * @param  App\Services\API\CollectionService  $service
     * @param  string  $id
     */
    public function show(CollectionService $service, $id)
    {
        $validation = $service->validateId($id);

        if ($validation->fails()) {
            return response()->json(['status' => 'Unprocessable Content', 'code' => 422, 'message' => $validation->errors()->all()], 422);
        }

        $apiData = new SingleCollectionResource(Collection::find($id));

        return response()->json(['status' => 'OK', 'code' => 200, 'collection' => $apiData], 200);
    }

    /**
     * route(/collections/filtered)
     * return collection filtered by target amount
     * target_amount from GET request
     *
     * @param  App\Services\API\CollectionService  $service
     */
    public function findByTargetAmount(CollectionService $service)
    {
        $tag = request('target_amount');

        if (is_null($tag)) {
            return response()->json(['status' => 'Bad Request', 'code' => 400, 'message' => 'Filter is not exists or another than [target_amount].'], 400);
        }

        $apiData = $service->collectionByFilter($tag);

        return response()->json(['status' => 'OK', 'code' => 200, 'collections' => CollectionsResource::collection($apiData)]);
    }

    public function update(Request $request, $id)
    {
        //TODO update
    }

    public function destroy($id)
    {
        //TODO delete
    }
}
