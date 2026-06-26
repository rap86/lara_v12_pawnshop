<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'first_name' => substr($this->faker->firstName, 0, 20),
            'middle_name' => substr($this->faker->lastName, 0, 20), // Faker doesn't have middle names natively, so we use a second last name
            'last_name' => substr($this->faker->lastName, 0, 20),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'birthdate' => $this->faker->date('Y-m-d', '-18 years'), // Customers at least 18 years old
            'marital_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
            'email' => substr($this->faker->unique()->safeEmail, 0, 40),
            'cellphone_number' => substr($this->faker->phoneNumber, 0, 20),
            'occupation' => substr($this->faker->jobTitle, 0, 100),
            'address' => substr($this->faker->address, 0, 200),
            'details' => substr($this->faker->sentence, 0, 100),
            'image_name' => 'customer_placeholder.jpg',
            'image_location' => 'uploads/customers/',
            'image_size' => '45 KB',
            'user_id' => 1, // Assumes you have a default system user with ID 1, or leave null if preferred
        ];
    }
}
