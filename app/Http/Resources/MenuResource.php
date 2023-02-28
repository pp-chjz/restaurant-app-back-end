<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return ค่าเดิม
        // return parent::toArray($request);

        $ingredients = $this->ingredients;

        return[
            'id' => $this->id,
            'catagories' => $this->catagories,
            'sort_menu' => $this->sort_menu,
            'name_ENG' => $this->name_ENG,
            'name_TH' => $this->name_TH,
            'menu_status' => $this->menu_status,
            'price' => $this->price,
            'size' => $this->size,
            // 'comment' => $this->comment,
            'ingredient' => $ingredients,
            // 'QTY' => $this->QTY,
        ];
    }
}
