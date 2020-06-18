<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->icon = '<i class=\"fab fa-acquisitions-incorporated\"></i>';
        $category->name = "Développement Web";
        $category->save();

        $category = new Category();
        $category->icon = '<i class="fab fa-angellist"></i>';
        $category->name = "Développement Logiciel";
        $category->save();

        $category = new Category();
        $category->icon = '<i class=\"fab fa-app-store-ios\"></i>';
        $category->name = "Infrastructure";
        $category->save();
    }
}
