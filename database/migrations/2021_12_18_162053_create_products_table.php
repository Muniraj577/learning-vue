<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->onDelete('set null')->constrained('categories')->nullable();
            $table->foreignId('subcategory_id')->onDelete('set null')->constrained('sub_categories')->nullable();
            $table->string("title")->unique();
            $table->string("slug");
            $table->string("image")->default("default.png")->nullable();
            $table->decimal("price", 10, 2)->default(0);
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
