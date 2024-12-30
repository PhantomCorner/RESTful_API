<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // edit here to update the response
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'type' => $this->type,
            'postalCode'=> $this->postal_code,
            // check if invoices is loaded
            'inoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
            // or display all invoices
            // 'invoices' => InvoiceResource::collection($this->invoices),
            // or display invoice count
            // 'invoiceCount' => $this->invoices->count(),
        ];
    }
}
