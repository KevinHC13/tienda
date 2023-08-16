<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('product_id');
            $table->integer('cantidad');
            $table->float('iva');
            $table->float('subtotal');
            $table->float('total');
            $table->string('referencia');
            $table->string('descripcion');
            $table->float('price');
            $table->string('picture');
            $table->string('estado');
            
      
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizacions');
    }
};
