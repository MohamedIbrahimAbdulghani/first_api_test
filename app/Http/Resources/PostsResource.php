<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    // this is function to choose what you need to return from database columns
    public function toArray($request)
    {

        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'body'=>$this->body
        ];
    }
}