<?php
include_once __DIR__ . '/../../test-common.php';

class StreetTest extends \PHPUnit\Framework\TestCase{
	public function setUp() {
		parent::setUp();
	}
	public function test_addressToId(){
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame(122270017, (int)$street->addressToId('千葉県浦安市舞浜１−１３'));
	}
	public function test_addressToName(){
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame('舞浜', $street->addressToName('千葉県浦安市舞浜１−１３'));
	}
	
	public function test_nameToId(){
//		埼玉県さいたま市浦和区常盤4-3-15
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame(111010023, (int)$street->nameToId(11, 11101, '二ツ宮'));
		$this->assertSame(111010010, (int)$street->nameToId(11, 11101, '三条町'));
	}
	public function test_idToName(){
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame('二ツ宮', $street->idToName(11, 11101, 111010023));
	}
	public function test_removePrefAndCityAndStreetName(){
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame('4-3-15', $street->removePrefAndCityAndStreetName('埼玉県さいたま市浦和区常盤4-3-15'));
	}
	public function test_prefIdAndCityIdAndAddressToId(){
		$street = Nago\JpAddress\Street::getInstance();
		$this->assertSame(111070012, (int)$street->prefIdAndCityIdAndAddressToId(11, 11107, '埼玉県さいたま市浦和区常盤4-3-15'));
	}
	public function test_streets(){
		$street = Nago\JpAddress\Street::getInstance();
		$array = $street->streets(13, 13101);
		$this->assertTrue(is_array($array));
	}
	public function test_streets_illegal(){
		$street = Nago\JpAddress\Street::getInstance();
		$array = $street->streets(13, 999999);
		$this->assertFalse($array);
	}
}
