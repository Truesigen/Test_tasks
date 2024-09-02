<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;



class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'success' => true,
            'page' => $this->currentPage(),
            'count' => $this->count(),
            'total_pages' => $this->lastPage(),
            'total_users' => $this->total(),
            'links' => [
                'next_url' => $this->nextPageUrl(),
                'prev_url' => $this->previousPageUrl()
            ],
            'users' => $this->collection
        ];
    }
}
