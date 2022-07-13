<?php

namespace App\Http\Resources;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'comment_id' => $this->comment_id,
            'user' => new UserResource($this->user),
            'post' => new PostResource($this->post),
            'comment_content' => $this->comment_content,
            'comment_status' => $this->comment_status,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}