<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void 
{ 
    Schema::table('employees', function (Blueprint $table) { 
        $table->unsignedBigInteger('department_id')->after('tanggal_masuk'); 
        $table->unsignedBigInteger('position_id')->after('department_id'); 

        $table->foreign('department_id')
              ->references('id')
              ->on('departments')
              ->onDelete('cascade');

        $table->foreign('position_id')
              ->references('id')
              ->on('positions')
              ->onDelete('cascade');  
    }); 
}


    
public function down(): void 
{ 
    Schema::table('employees', function (Blueprint $table) { 
        $table->dropForeign(['departement_id']); 
        $table->dropForeign(['jabatan_id']); 
        $table->dropColumn(['departement_id', 'jabatan_id']); 
    }); 
} 
};