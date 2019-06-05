<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * @author Rodrigo Chaves <chavesfop@gmail.com>
 * Criação da tabela cep_cache
 */
class CreateCepCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cep_cache', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->string('cep', 8);
	    $table->string('logradouro', 200)->nullable();
	    $table->string('localidade', 100);
	    $table->string('uf', 2);
	    $table->string('origem', '100')->nullable();

	    //indices para melhorar pesquisa
	    $table->index('cep');
	    $table->index('localidade');
	    $table->index('uf');

	    //timestamps
	    $table->timestamp('created_at')->useCurrent();
	    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cep_cache');
    }
}
