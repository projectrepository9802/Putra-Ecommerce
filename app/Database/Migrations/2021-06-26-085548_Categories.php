<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
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
			'category_name'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250,
			],
			'category_slug'			=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250,
				'unique'			=> true
			],
			'icon' 					=> [
				'type'				=> 'VARCHAR',
				'constraint'		=> 250
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('categories');
		$this->db->table('categories')->insertBatch([
			[
				'category_name'		=> 'Merchants',
				'category_slug'		=> 'merchants',
				'icon'				=> 'fas fa-people-carry'
			], [
				'category_name'		=> 'Electronics',
				'category_slug'		=> 'electronics',
				'icon'				=> 'fas fa-tv'
			], [
				'category_name'		=> 'Otomotif',
				'category_slug'		=> 'otomotif',
				'icon'				=> 'fas fa-motorcycle'
			], [
				'category_name'		=> 'Souvenir & Pesta',
				'category_slug'		=> 'souvenir-&-pesta',
				'icon'				=> 'fas fa-gifts'
			], [
				'category_name'		=> 'Fotografi',
				'category_slug'		=> 'fotografi',
				'icon'				=> 'fas fa-camera-retro'
			], [
				'category_name'		=> 'Komputer & Aksesoris',
				'category_slug'		=> 'komputer-&-aksesoris',
				'icon'				=> 'fas fa-laptop'
			], [
				'category_name'		=> 'Perlengkapan Rumah',
				'category_slug'		=> 'perlengkapan-rumah',
				'icon'				=> 'fas fa-chair'
			], [
				'category_name'		=> 'Makanan & Minuman',
				'category_slug'		=> 'makanan-&-minuman',
				'icon'				=> 'fas fa-hamburger'
			], [
				'category_name'		=> 'Olahraga & Outdoor',
				'category_slug'		=> 'olahraga-&-outdoor',
				'icon'				=> 'fas fa-futbol'
			], [
				'category_name'		=> 'Buku & Alat Tulis',
				'category_slug'		=> 'buku-&-alat-tulis',
				'icon'				=> 'fas fa-book'
			], [
				'category_name'		=> 'Pakaian Pria',
				'category_slug'		=> 'pakaian-pria',
				'icon'				=> 'fas fa-male'
			], [
				'category_name'		=> 'Sepatu Pria',
				'category_slug'		=> 'sepatu-pria',
				'icon'				=> 'fas fa-shoe-prints'
			], [
				'category_name'		=> 'Tas Pria',
				'category_slug'		=> 'tas-pria',
				'icon'				=> 'fas fa-briefcase'
			], [
				'category_name'		=> 'Aksesoris Fashion',
				'category_slug'		=> 'aksesoris-fashion',
				'icon'				=> 'fas fa-vest-patches'
			], [
				'category_name'		=> 'Jam Tangan',
				'category_slug'		=> 'jam-tangan',
				'icon'				=> 'fas fa-clock'
			], [
				'category_name'		=> 'Perawatan & Kecantikan',
				'category_slug'		=> 'perawatan-&-kecantikan',
				'icon'				=> 'fas fa-paint-brush'
			], [
				'category_name'		=> 'Pakaian Wanita',
				'category_slug'		=> 'pakaian-wanita',
				'icon'				=> 'fas fa-female'
			], [
				'category_name'		=> 'Fashion Muslim',
				'category_slug'		=> 'fashion-muslim',
				'icon'				=> 'fas fa-star-and-crescent'
			], [
				'category_name'		=> 'Fashion Bayi & Anak',
				'category_slug'		=> 'fashion-bayi-&-anak',
				'icon'				=> 'fas fa-baby'
			], [
				'category_name'		=> 'Ibu & Bayi',
				'category_slug'		=> 'ibu-&-bayi',
				'icon'				=> 'fas fa-baby-carriage'
			], [
				'category_name'		=> 'Sepatu Wanita',
				'category_slug'		=> 'sepatu-wanita',
				'icon'				=> 'fas fa-socks'
			], [
				'category_name'		=> 'Tas Wanita',
				'category_slug'		=> 'tas-wanita',
				'icon'				=> 'fas fa-shopping-bag'
			],
		]);
	}

	public function down()
	{
		$this->forge->dropTable('categories');
	}
}
