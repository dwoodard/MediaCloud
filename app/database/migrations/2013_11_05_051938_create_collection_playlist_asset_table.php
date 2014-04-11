<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollectionPlaylistAssetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('collection_playlist_asset', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('collection_id');
			$table->integer('playlist_id');
			$table->integer('asset_id');
			$table->integer('asset_order')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('collection_playlist_asset');
	}

}