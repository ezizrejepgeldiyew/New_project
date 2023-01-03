<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 200) as $item) {
            Product::create([
                'photo' => "PhonePhoto/2022-12-24/RWKnPR7Lzwbbxn1L9JG8CXZMYqkyGB1nyM3MPFUc.png",
                'photos' => "['PhonePhoto\/Multiple\/2022-12-02\/FeogItahcgbvfNOaqziprSBNmyOOJ8g796zmQ1IL.png','PhonePhoto\/Multiple\/2022-12-02\/TxSKrN6NgL1pfsLahl7WcLl4NMZ0XEpmyRr4qf3T.png','PhonePhoto\/Multiple\/2022-12-02\/bC6RihZ4C6E6K5lNve14YFU3FIKjCJpcZ62bklOu.png','PhonePhoto\/Multiple\/2022-12-02\/GIEyfH6LJsFlHIZLDuWWTSRxelibjvRQd3TvqARX.png']",
                'category_id' => rand(1, 3),
                'ourbrand_id' => rand(1, 2),
                'name' => "Product$item",
                'price' => rand(200, 20000),
                'description' => rand(1, 2)
            ]);
        }
    }
}
