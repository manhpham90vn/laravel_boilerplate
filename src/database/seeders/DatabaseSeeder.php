<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Models\User();
            $user->email = $faker->email;
            $user->type = 'customer';
            $user->password = Hash::make('12345678');
            $user->save();

            $customer = new \App\Models\Customer();
            $customer->customer_name = $faker->name;
            $customer->contact_name = $faker->name;
            $customer->address = $faker->address;
            $customer->city = $faker->city;
            $customer->postal_code = $faker->postcode;
            $customer->country = $faker->country;
            $customer->user_id = $user->id;
            $customer->save();
        }

        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Models\User();
            $user->email = $faker->email;
            $user->type = 'employee';
            $user->password = Hash::make('12345678');
            $user->save();

            $employee = new \App\Models\Employee();
            $employee->first_name = $faker->firstName;
            $employee->last_name = $faker->lastName;
            $employee->birth_date = $faker->date;
            $employee->photo = $faker->imageUrl();
            $employee->notes = $faker->text;
            $employee->user_id = $user->id;
            $employee->save();
        }

        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Models\User();
            $user->email = $faker->email;
            $user->type = 'shipper';
            $user->password = Hash::make('12345678');
            $user->save();

            $shipper = new \App\Models\Shipper();
            $shipper->shipper_name = $faker->company;
            $shipper->phone = $faker->phoneNumber;
            $shipper->user_id = $user->id;
            $shipper->save();
        }

        for ($i = 0; $i < 30; $i++) {
            $user = new \App\Models\User();
            $user->email = $faker->email;
            $user->type = 'supplier';
            $user->password = Hash::make('12345678');
            $user->save();

            $supplier = new \App\Models\Supplier();
            $supplier->supplier_name = $faker->company;
            $supplier->contact_name = $faker->name;
            $supplier->address = $faker->address;
            $supplier->city = $faker->city;
            $supplier->postal_code = $faker->postcode;
            $supplier->country = $faker->country;
            $supplier->phone = $faker->phoneNumber;
            $supplier->user_id = $user->id;
            $supplier->save();
        }

        for ($i = 0; $i < 20; $i++) {
            $category = new \App\Models\Category();
            $category->name = $faker->word;
            $category->description = $faker->text;
            $category->save();
        }

        for ($i = 0; $i < 100; $i++) {
            $product = new \App\Models\Product();
            $product->name = $faker->word;
            $product->description = $faker->text;
            $product->supplier_id = $faker->numberBetween(1, 30);
            $product->category_id = $faker->numberBetween(1, 20);
            $product->unit = $faker->word;
            $product->price = $faker->randomFloat(2, 1, 1000);
            $product->save();
        }

        for ($i = 0; $i < 100; $i++) {
            $order = new \App\Models\Order();
            $order->customer_id = $faker->numberBetween(1, 30);
            $order->employee_id = $faker->numberBetween(1, 30);
            $order->order_date = $faker->date;
            $order->shipper_id = $faker->numberBetween(1, 30);
            $order->save();
        }

        for ($i = 0; $i < 100; $i++) {
            $orderDetail = new \App\Models\OrderDetail();
            $orderDetail->order_id = $faker->numberBetween(1, 100);
            $orderDetail->product_id = $faker->numberBetween(1, 100);
            $orderDetail->quantity = $faker->numberBetween(1, 100);
            $orderDetail->save();
        }
    }
}
