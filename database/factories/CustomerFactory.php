<?php

namespace Database\Factories;
use App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    public function definition()
    {
        $type=$this->faker->randomElement(['individual','company']);
        $name=$type=='Individual'?$this->faker->name:$this->faker->company; 
        return [
            'name'=>$name,
            'type'=>$type,
            'email'=>$this->faker->unique()->safeEmail,
            'address'=>$this->faker->address,
            'city'=>$this->faker->city,
            'state'=>$this->faker->state,
            'postal_code'=>$this->faker->postcode,
        
        ];
    }
    public function hasInvoices($count)
    {
        return $this->has(Invoice::factory()->count($count), 'invoices');
    }
}
