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
		Schema::create('short_link_uploads', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('filename');
			$table->string('path');
			$table->string('type');
			$table->unsignedInteger('size');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('short_link_uploads');
	}
};
