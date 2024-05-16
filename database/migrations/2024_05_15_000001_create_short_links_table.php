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
		Schema::create('short_links', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->unsignedBigInteger('deleted_ts')->virtualAs('IFNULL(UNIX_TIMESTAMP(deleted_at), 0)');
			$table->unsignedInteger('short_link_upload_id')->nullable();
			$table->char('code', 11)->nullable(false);
			$table->string('url')->nullable(false);

			$table->unique(['code', 'deleted_ts'], 'un_sd_code');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('short_links');
	}
};
