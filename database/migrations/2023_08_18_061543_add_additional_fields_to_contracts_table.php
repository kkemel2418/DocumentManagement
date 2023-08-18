<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToContractsTable extends Migration
{
    public function up()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->string('client_name')->nullable();
            $table->string('service_description')->nullable();
            $table->decimal('total_value', 10, 2)->nullable();
            // Adicione outras colunas aqui
        });
    }

    public function down()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'service_description', 'total_value']);
            // Drop outras colunas aqui
        });
    }
}
