<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleUserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
       return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'role_id' => Role::inRandomOrder()->first()->id ?? Role::factory(),
        ];
    }
}