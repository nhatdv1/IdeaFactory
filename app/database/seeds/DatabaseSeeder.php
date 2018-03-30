<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
//		Eloquent::unguard();

		 $this->call('DeviceTableSeeder');
	}
}

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categorys')->insert([
			array('category'=>'technology & science'),
			array('category'=>'life'),
			array('category'=>'art'),
			array('category'=>'invention')
		]);
	}
}
class DeviceTableSeeder extends Seeder {

	public function run()
	{
		DB::table('devices')->insert([
				array('deviceType'=>'ios','deviceName'=>'iphone 5','screenWidth'=>100,'screenHeight'=>150),
				array('deviceType'=>'android','deviceName'=>'zenfone 5','screenWidth'=>150,'screenHeight'=>250),
				array('deviceType'=>'ios','deviceName'=>'iphone 5s','screenWidth'=>130,'screenHeight'=>200),
				array('deviceType'=>'android','deviceName'=>'Galaxy Y','screenWidth'=>120,'screenHeight'=>150)
		]);
	}
}

