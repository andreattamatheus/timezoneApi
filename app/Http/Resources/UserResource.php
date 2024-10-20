<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'email' => $this->email,
        ];

        if ($this->name !== $this->old_name) {
            $data['firstname'] = $this->name;
        }

        if ($this->lastname !== $this->old_lastname) {
            $data['lastname'] = $this->lastname;
        }

        if ($this->timezone->id !== $this->old_timezone) {
            $data['time_zone'] = $this->timezone->description;
        }

        return $data;
    }
}
