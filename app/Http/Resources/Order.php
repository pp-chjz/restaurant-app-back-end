<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
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
        $menus = $this->menus;

        return[
            'id' => $this->id,
            'cancel_status' => $this->cancel_status,
            'order_status' => $this->order_status,
            'total_price' => $this->total_price,
            'table_number' => $this->table_number,
            'order_time' => $this->order_time,
            'menus' => $menus,
        ];
    }
}
