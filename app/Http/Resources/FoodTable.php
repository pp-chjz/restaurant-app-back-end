<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodTable extends JsonResource
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
        $orders = $this->orders;

        return[
            'id' => $this->id,
            'tablenum_status' => $this->tablenum_status,
            'tablenumber' => $this->tablenumber,
            'orders' => $this->orders,
        ];
    }
}
