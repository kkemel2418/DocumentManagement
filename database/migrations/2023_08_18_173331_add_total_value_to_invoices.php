<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalValueToInvoices extends Migration
{
    public function up()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->decimal('total_value', 10, 2)->after('service_description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            $table->dropColumn('total_value');
        });
    }
}
