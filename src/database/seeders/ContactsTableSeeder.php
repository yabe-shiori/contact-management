<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory()->count(10)->create();

        $param = [
            'name' => '田中太郎',
            'gender' => 1,
            'email' => 'tanaka@example.com',
            'postcode' => '100-0001',
            'address' => '東京都千代田区丸の内1-1',
            'building_name' => '東京ハイツ',
            'opinion' => '製品の価格と在庫状況について教えてください。',
            'created_at' => Carbon::now(),
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'name' => '山田花子',
            'gender' => 2,
            'email' => 'yamada@example.com',
            'postcode' => '530-0002',
            'address' => '大阪府大阪市北区梅田2-2-22',
            'building_name' => 'グランフロント大阪',
            'opinion' => 'カスタマーサポートの連絡先を教えてください',
            'created_at' => Carbon::now()->subDays(2),
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'name' => '佐藤美佳',
            'gender' => 2,
            'email' => 'sato@example.com',
            'postcode' => '654-0017',
            'address' => '兵庫県 神戸市須磨区 大手',
            'building_name' => '神戸ハイツ',
            'opinion' => '製品の仕様について教えてください。',
            'created_at' => Carbon::now()->subDay(5),
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'name' => '伊藤健太',
            'gender' => 1,
            'email' => 'ito@example.com',
            'postcode' => '220-6009',
            'address' => '神奈川県横浜市西区みなとみらい3-4-5',
            'building_name' => 'ランドマークタワー',
            'opinion' => '製品の補償について教えてください。',
            'created_at' => Carbon::now()->subDay(8),
        ];
        DB::table('contacts')->insert($param);
        $param = [
            'name' => '高橋美奈子',
            'gender' => 2,
            'email' => 'takahasi@example.com',
            'postcode' => '330-0853',
            'address' => '埼玉県さいたま市大宮区吉敷町3-3-3',
            'building_name' => '大宮ビル',
            'opinion' => '商品の返品手続きについて教えてください。',
            'created_at' => Carbon::now()->subDay(10),
        ];
        DB::table('contacts')->insert($param);
    }
}
