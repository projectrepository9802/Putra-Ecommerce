<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'              => 'INT',
				'constraint'        => 11,
				'unsigned'          => TRUE,
				'auto_increment'    => TRUE
			],
			'product_name' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
			],
			'category_id' => [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'          => TRUE,
				'default'			=> 0
			],
			'merchant_id' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'          => TRUE,
				'default'			=> 0
			],
			'product_price' => [
				'type'				=> 'INT',
				'constraint'		=> 11,
				'unsigned'          => TRUE,
			],
			'product_status' => [
				'type'				=> 'ENUM("published","hidden","out-of-stock")',
				'default' 			=> 'hidden',
				'null' 				=> FALSE,
			],
			'product_thumbnail' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
				'default'			=> 'default.jpg'
			],
			'product_description' => [
				'type'				=> 'TEXT',
				'constraint'        => 250,
			],
			'stock' => [
				'type'				=> 'INT',
				'constraint'        => 11,
				'null' 				=> TRUE,
			],
			'slug' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250,
				'unique'            => TRUE
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('category_id', 'categories', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('merchant_id', 'merchants', 'id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('products');
	}

	public function down()
	{
		$this->forge->dropTable('products');
	}
}
