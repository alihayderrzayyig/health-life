<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => (string)$this->slug,
            'attributes' => [
                'role_id' => $this->role_id,
                'name' => $this->name,
                'email' => $this->email,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'profile' => [
                'id' => (string)$this->profile->id,
                'bio' => $this->profile->bio,
                'facebook_link' => $this->profile->facebook_link,
                'phone_num1' => $this->profile->phone_num1,
                'phone_num2' => $this->profile->phone_num2,
            ]
        ];
    }
}
