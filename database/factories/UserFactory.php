<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => 'Filepool',
            'email'    => 'admin@filepool.com',
            'password' => Hash::make('admin1234'),
            'is_admin' => true,
            'is_premium'    => true,
            'storage_limit' => '107374182400'
        ];
    }
}
