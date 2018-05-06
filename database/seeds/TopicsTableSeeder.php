<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // 所有用户 ID 数组，如：[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // 所有分类 ID 数组， 如：[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $fakers = app(Faker\Generator::class);

        $topics = factory(Topic::class)
            ->times(50)
            ->make()
            ->each(function ($topic, $index)
            use ($user_ids, $category_ids, $fakers) {
                $topic->user_id = $fakers->randomElement($user_ids);
                $topic->category_id = $fakers->randomElement($category_ids);
            });

        Topic::insert($topics->toArray());
    }

}

