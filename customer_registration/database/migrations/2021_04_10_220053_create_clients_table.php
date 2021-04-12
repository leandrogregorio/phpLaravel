<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('email',100)->unique();
            $table->string('phone',20);
            $table->string('address',50);
            $table->integer('number');
            $table->string('complement',20);
            $table->string('district',20);
            $table->string('county',20);
            $table->string('state',20);
            $table->string('country',30);
            $table->integer('zip_code');
            $table->string('rg',20)->unique();
            $table->string('cpf_cnpj', 20)->unique();
            $table->softDeletes();
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
        Schema::dropIfExists('clients');
    }
}
