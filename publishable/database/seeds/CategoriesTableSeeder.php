<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrNew([
            'slug' => '分类-1',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => '分类 1',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug' => '分类-2',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => '分类 2',
            ])->save();
        }
    }
}
