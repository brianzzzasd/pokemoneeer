<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HateResource extends JsonResource
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
            'id' => $this->id,
            'pokemon' => $this->pokemon,
            'user' => $this->user,
        ];
    }
}
