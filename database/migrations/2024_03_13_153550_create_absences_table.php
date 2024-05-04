<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('absences', function (Blueprint $table) {
      $table->id();
      $table->String('matier');
      $table->boolean('justife')->default(false);
      $table->text('description');
      $table->date('date_Absences');
      $table->foreignId("user_id")->constrained();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('absences');
  }
};
