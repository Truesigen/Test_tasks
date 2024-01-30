<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'target_amount' => $this->target_amount,
            'link' => $this->link,
            'contributors_list' => $this->getContributorsList(),
        ];
    }

    public function getContributorsList(): array
    {
        $contributorData = [];
        foreach ($this->contributors as $contributor) {
            $contributorData[$contributor->user_name][] = $contributor->amount;
        }

        return $contributorData;
    }
}
