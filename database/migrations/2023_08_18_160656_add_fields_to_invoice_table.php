<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInvoiceTable extends Migration
{
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->string('client_name', 255)->nullable()->after('total_amount');
            $table->text('service_description')->nullable()->after('client_name');
        });
    }

    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'service_description']);
        });
    }
}
