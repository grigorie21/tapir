<?php

namespace App\Http\Resources\API\Ad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cost' => $this->cost,
            'image_link' => env('APP_URL')."/image/{$this->images()->first()->sha256}",
        ];
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
