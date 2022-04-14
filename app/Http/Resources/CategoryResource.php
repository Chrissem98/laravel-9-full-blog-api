<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->bindByRequest();

    }

    private function bindByRequest(): array
    {
        $array = [];

        if(request()->has('fields')){
            // dd(request());
            if(in_array('id', explode(',', request()->fields))){
                $array['id'] = $this->id;
            }
            if(in_array('name', explode(',', request()->fields))){
                $array['name'] = $this->name;
            }
            if(in_array('description', explode(',', request()->fields))){
                $array['description'] = $this->description;
            }
            if(in_array('created_at', explode(',', request()->fields))){
                $array['createdAt'] = $this->created_at;
            }
            if(in_array('updated_at', explode(',', request()->fields))){
                $array['updatedAt'] = $this->updated_at;
            }

        }
        else{
            $array = [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ];
        }

        return $array;
    }
}