<?php

namespace App\Services\API;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class ContributorService
{
    public function validate(array $input, $collectionId = null)
    {
        $rules = [
            'user_name' => 'required|string|max:255',
            'amount' => 'required|integer',
            'collection_id' => 'integer|exists:App\Models\Collection,id',
        ];

        if (isset($collectionId)) {
            $input = Arr::add($input, 'collection_id', $collectionId);
        }

        return Validator::make($input, $rules);
    }
}
