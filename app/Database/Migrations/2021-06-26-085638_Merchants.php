<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Merchants extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'              => 'INT',
				'constraint'        => 11,
				'unsigned'          => true,
				'auto_increment'    => true,
			],
			'user_id' => [
				'type'           	=> 'INT',
				'constraint'     	=> 11,
				'unsigned'          => true,
				'default'			=> 0,
			],
			'merchant_status' => [
				'type'				=> 'ENUM("active","banned","suspended")',
				'default' 			=> 'suspended',
				'null' 				=> false,
			],
			'merchant_fullname' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
			],
			'merchant_email' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
			],
			'merchant_gender' => [
				'type'				=> 'ENUM("male","female")',
				'null' 				=> false,
			],
			'merchant_phone' => [
				'type'              => 'VARCHAR',
				'constraint'        => 30,
			],
			'store_name' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
				'unique'            => true,
			],
			'store_slug' => [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250,
				'unique'            => true,
			],
			'store_address' => [
				'type'				=> 'TEXT',
			],
			'store_image' => [
				'type'				=> 'VARCHAR',
				'constraint'        => 250,
			],
			'ktp_image' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
			],
			'store_logo' => [
				'type'              => 'VARCHAR',
				'constraint'        => 250,
			],
			'verified'	=> [
				'type'				=> 'ENUM("true", "false")',
				'default'			=> 'false',
				'null'				=> false,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp'
		]);
		$this->forge->addKey('id', true);
		// $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->createTable('merchants');
	}

	public function down()
	{
		$this->forge->dropTable('merchants');
	}
}
