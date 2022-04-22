<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ImageThumbnails extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'					=> [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true,
				'auto_increment'    => TRUE
			],
			'product_id'			=> [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'			=> true
			],
			'image_file'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250,
			],
			'image_slug' 			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('image_thumbnails');
	}

	public function down()
	{
		$this->forge->dropTable('image_thumbnails');
	}
}
