<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $items = [
            // ==== Sản phẩm cũ ====
            [
                'name' => 'Blu T-Shirt',
                'description' => 'Áo thun chất liệu cotton 100%, thoáng mát, logo Blu tối giản.',
                'price' => 199000,
                'image' => 'blu_tshirt.jpg',
            ],
            [
                'name' => 'Blu Hoodie',
                'description' => 'Hoodie nỉ ấm, form rộng, đi học đi chơi đều xịn.',
                'price' => 399000,
                'image' => 'blu_hoodie.jpg',
            ],
            [
                'name' => 'Blu Cap',
                'description' => 'Nón lưỡi trai basic, phối đồ dễ, chống nắng ổn.',
                'price' => 149000,
                'image' => 'blu_cap.jpg',
            ],
            [
                'name' => 'Blu Mug',
                'description' => 'Ly sứ in logo Blu, giữ nhiệt tương đối, vibe học bài chill.',
                'price' => 99000,
                'image' => 'blu_mug.jpg',
            ],
            [
                'name' => 'Blu Tote Bag',
                'description' => 'Túi tote canvas bền, đựng laptop mỏng, sách vở thoải mái.',
                'price' => 159000,
                'image' => 'blu_totebag.jpg',
            ],
            [
                'name' => 'Blu Mouse Pad',
                'description' => 'Lót chuột bề mặt mịn, trơn, cỡ vừa cho góc học tập.',
                'price' => 89000,
                'image' => 'blu_mousepad.jpg',
            ],
            [
                'name' => 'Blu Sticker Pack',
                'description' => 'Bộ sticker vinyl chống nước, dán laptop, bình nước.',
                'price' => 49000,
                'image' => 'blu_stickerpack.jpg',
            ],
            [
                'name' => 'Blu Notebook',
                'description' => 'Sổ tay giấy dày, không lem mực, bìa tối giản.',
                'price' => 79000,
                'image' => 'blu_notebook.jpg',
            ],

            // ==== Sản phẩm mới ====
            [
                'name' => 'Blu Water Bottle',
                'description' => 'Bình nước Blu chất liệu inox 304 cao cấp...',
                'price' => 129000,
                'image' => 'blu_water_bottle.jpg',
            ],
            [
                'name' => 'Blu Phone Case',
                'description' => 'Ốp điện thoại Blu dẻo nhẹ...',
                'price' => 99000,
                'image' => 'blu_phone_case.jpg',
            ],
            [
                'name' => 'Blu Pencil Case',
                'description' => 'Hộp bút Blu vải canvas bền...',
                'price' => 69000,
                'image' => 'blu_pencil_case.jpg',
            ],
            [
                'name' => 'Blu Umbrella',
                'description' => 'Dù Blu gấp gọn, chống UV...',
                'price' => 179000,
                'image' => 'blu_umbrella.jpg',
            ],
            [
                'name' => 'Blu Blanket',
                'description' => 'Chăn Blu siêu mềm...',
                'price' => 299000,
                'image' => 'blu_blanket.jpg',
            ],
            [
                'name' => 'Blu Backpack',
                'description' => 'Balo Blu chống nước...',
                'price' => 349000,
                'image' => 'blu_backpack.jpg',
            ],
            [
                'name' => 'Blu Candle',
                'description' => 'Nến thơm Blu hương lavender...',
                'price' => 159000,
                'image' => 'blu_candle.jpg',
            ],
            [
                'name' => 'Blu Keychain',
                'description' => 'Móc khóa Blu mini dễ thương...',
                'price' => 39000,
                'image' => 'blu_keychain.jpg',
            ],
            [
                'name' => 'Blu Socks',
                'description' => 'Vớ Blu cotton thoáng khí...',
                'price' => 89000,
                'image' => 'blu_socks.jpg',
            ],
            [
                'name' => 'Blu Wireless Charger',
                'description' => 'Sạc không dây Blu tốc độ cao...',
                'price' => 259000,
                'image' => 'blu_wireless_charger.jpg',
            ],
        ];

        $categories = DB::table('categories')->pluck('id');

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])], // đảm bảo không duplicate
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],

                    // NEW FIELDS ↓↓↓
                    'slug' => Str::slug($item['name']),
                    'sale_price' => rand(0, 1) ? $item['price'] - rand(5000, 30000) : $item['price'],

                    // images: convert từ 1 image → array json
                    'images' => json_encode([$item['image']]),

                    'stock' => rand(20, 200),
                    'sold_count' => rand(0, 500),

                    'image' => $item['image'], // legacy
                    'category_id' => $categories->random(),
                    'is_new' => rand(0, 1),
                    'is_bestseller' => rand(0, 1),
                    'is_on_sale' => rand(0, 1),

                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
