<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('no_transaksi')->nullable()->after('id'); // Buat kolom nullable
        });
    }
    

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('no_transaksi');
        });
    }
};
