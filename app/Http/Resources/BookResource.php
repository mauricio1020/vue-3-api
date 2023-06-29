<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BookResource
 * @package App\Http\Resources
 * @mixin Book
 */

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id" => $this->id,
            "name" => $this->name,
            "isbn" => $this->id,
            "summary" => $this->id,
            "author" => $this->author,
            "user" => $this->user->name,
            "created_at" => $this->created_at->format("d/m/Y")
        ];
    }
}
