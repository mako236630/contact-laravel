<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{

    protected $model = Contact::class;

    public function definition()
    {
        return [
            "first_name" => $this->faker->firstName,
            "last_name" => $this->faker->lastName,
            "gender" => $this->faker->numberBetween(1,3),
            "email" => $this->faker->safeEmail,
            "tel" => $this->faker->phoneNumber,
            "address" => $this->faker->address,
            "building" => $this->faker->secondaryAddress,
            "detail" => $this->faker->realText(20),
            "category_id" => $this->faker->numberBetween(1,5),
        ];
    }
}
