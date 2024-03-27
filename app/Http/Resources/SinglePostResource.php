<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglePostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $images = $this->getMedia('post')->map(function ($image) {
            return [
                'id' => $image->id,
                'url' => $image->getUrl(),
            ];
        });
        return [
            'content'=>$this->content,
            'visitable_type'=>explode("\\Models\\",$this->visitable_type)[1],
            'visitable_id'=>$this->visitable_id,
            'user'=>$this->user->username,
            'images'=> $images,

        ];
    }
}
