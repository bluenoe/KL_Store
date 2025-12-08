<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Nếu chưa có cột slug thì thêm (unique)
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }

            // sale_price
            if (!Schema::hasColumn('products', 'sale_price')) {
                $table->decimal('sale_price', 10, 2)->nullable()->after('price');
            }

            // images json
            if (!Schema::hasColumn('products', 'images')) {
                $table->json('images')->nullable()->after('image');
            }

            // stock
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0)->after('images');
            }

            // sold_count
            if (!Schema::hasColumn('products', 'sold_count')) {
                $table->integer('sold_count')->default(0)->after('stock');
            }

            // ensure flags exist with correct defaults
            if (!Schema::hasColumn('products', 'is_new')) {
                $table->boolean('is_new')->default(false)->after('category_id');
            }
            if (!Schema::hasColumn('products', 'is_bestseller')) {
                $table->boolean('is_bestseller')->default(false)->after('is_new');
            }
            if (!Schema::hasColumn('products', 'is_on_sale')) {
                $table->boolean('is_on_sale')->default(false)->after('is_bestseller');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // chú ý: down sẽ drop các cột nếu có
            if (Schema::hasColumn('products', 'sold_count')) {
                $table->dropColumn('sold_count');
            }
            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }
            if (Schema::hasColumn('products', 'images')) {
                $table->dropColumn('images');
            }
            if (Schema::hasColumn('products', 'sale_price')) {
                $table->dropColumn('sale_price');
            }
            if (Schema::hasColumn('products', 'slug')) {
                $table->dropUnique(['slug']); // drop unique index first (MySQL)
                $table->dropColumn('slug');
            }
            // flags
            if (Schema::hasColumn('products', 'is_on_sale')) {
                $table->dropColumn('is_on_sale');
            }
            if (Schema::hasColumn('products', 'is_bestseller')) {
                $table->dropColumn('is_bestseller');
            }
            if (Schema::hasColumn('products', 'is_new')) {
                $table->dropColumn('is_new');
            }
        });
    }
};
