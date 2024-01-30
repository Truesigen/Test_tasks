<?php

namespace App\Services\API;

use App\Models\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CollectionService
{
    public function validate(array $data)
    {
        $rules = [
            'title' => ['required', 'max:255', Rule::unique('collections')],
            'description' => 'required|max:255|string',
            'target_amount' => 'required|integer',
            'link' => ['required', 'url', Rule::unique('collections')],
        ];

        return Validator::make($data, $rules);
    }

    public function insertValidatedData(array $validatedData): Collection
    {
        $collection = Collection::create($validatedData);

        return $collection;
    }

    public function validateId($id)
    {
        return Validator::make(['id' => $id], ['id' => 'integer|exists:App\Models\Collection,id']);
    }

    public function collectionByFilter(string $filter)
    {
        return Collection::latest()->filter($filter)->get();
    }
}
