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
		Schema::create('short_link_visits', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->unsignedInteger('short_link_id')->nullable(false);
			$table->string('ip_address', 39)->nullable(false);
			$table->string('user_agent')->nullable();
			$table->string('browser')->nullable();
			$table->string('browser_version')->nullable();
			$table->boolean('is_mobile')->default(false)->nullable(false);
			$table->boolean('is_tablet')->default(false)->nullable(false);
			$table->string('device_type')->nullable();
			$table->string('device_maker')->nullable();
			$table->string('device_name')->nullable();
			$table->string('platform')->nullable();
			$table->string('platform_version')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('short_link_visits');
	}
};
