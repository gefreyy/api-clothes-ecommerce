<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     // Creacion de tablas con sus respectivos campos y relaciones.
    public function up(): void
    {
        Schema::create('genders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Masculino, Femenino, Unisex
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();;
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('desc');
            $table->integer('stock');
            $table->decimal('price', 8, 2);
            $table->string('imgProduct');
            $table->unsignedBigInteger('sex_id');         // relación: Un producto solo puede tener 1 sexo
            $table->unsignedBigInteger('category_id');    // relación: Un producto solo puede tener 1 categoria
            $table->unsignedBigInteger('brand_id');       // relacion: Un producto solo puede tener 1 marca
            $table->integer('discount')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        
            $table->foreign('sex_id')->references('id')->on('genders');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('product_tag', function (Blueprint $table) { // Un producto puede tener muchos tags, es por eso que se crea de esta forma.
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // S, M, L, XL, XXL, XXXL
            $table->timestamps();
        });

        Schema::create('product_size', function (Blueprint $table) { // Un producto puede tener muchas tallas
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Rojo, Azul, etc.
            $table->string('hex');
            $table->timestamps();
        });

        Schema::create('product_color', function (Blueprint $table) { // Un producto puede tener muchos colores
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('genders');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('product_tag');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('product_size');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('product_color');
    }
};
