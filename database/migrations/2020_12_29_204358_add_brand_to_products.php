<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrandToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Alterando a tabela produto, adicionando a coluna e referênciando ela na outra tabela
        Schema::table('products', function (Blueprint $table) {
            // Ao criar uma FK, seguir o padrão, nomeTabelaSingular_nomeColunaReferenciada
            $table->unsignedBigInteger('brand_id');
            // Referenciando 'brand_id' com 'id' da tabela 'brands'
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn(['brand_id']);
        });
    }
}
