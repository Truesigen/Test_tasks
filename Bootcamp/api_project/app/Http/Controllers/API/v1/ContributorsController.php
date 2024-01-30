<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Contributor;
use App\Services\API\ContributorService;
use Illuminate\Http\Request;

class ContributorsController extends BaseController
{
    /**
     * route(/contributors/{collection}/add)
     * creating new contributor by user name & amount
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Services\Api\ContributorService  $service
     */
    public function create(Request $request, ContributorService $service)
    {
        $validation = $service->validate($request->input(), $request->collection);

        if ($validation->fails()) {
            return response()->json(['status' => 'Unprocessable Content', 'code' => 422, 'message' => $validation->errors()->all()], 422);
        }

        $insertData = Contributor::create($validation->validated());

        if ($insertData->exists) {
            return response()->json(['status' => 'Created', 'code' => 201, 'contributor' => $validation->validated()], 201);
        }
    }
}
