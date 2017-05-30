<?php
include_once __DIR__ . '/../../test-common.php';

class CityTest extends \PHPUnit\Framework\TestCase{
	public function setUp() {
		parent::setUp();
	}
	public function test_addressToId(){
		$city = Nago\JpAddress\City::getInstance();
		$this->assertSame(12227, (int)$city->addressToId('千葉県浦安市舞浜１−１３'));
	}
	public function test_nameToId(){
		$city = Nago\JpAddress\City::getInstance();
		$this->assertSame(10202, (int)$city->nameToId(10, '高崎市'));
	}
	public function test_idToName(){
		$city = Nago\JpAddress\City::getInstance();
		$this->assertSame('高崎市', $city->idToName(10, 10202));
	}
	public function test_removePrefAndCityName(){
		$city = Nago\JpAddress\City::getInstance();
		$this->assertSame('舞浜１−１３', $city->removePrefAndCityName('千葉県浦安市舞浜１−１３'));
	}
	public function test_prefIdAndAddressToId(){
		$city = Nago\JpAddress\City::getInstance();
		$address = '徳島県徳島市一番町３-26';
		$this->assertSame(36201, (int)$city->prefIdAndAddressToId(36, $address));
	}

	public function test_practical(){
		$pref= Nago\JpAddress\Pref::getInstance();
		$city = Nago\JpAddress\City::getInstance();
		$address = "鳥取県鳥取市江津730";
		//pref_idがほしい
		$prefId = $pref->addressToId($address);
		$this->assertSame(31, $prefId);
		//city_idがほしい
		$cityId = $city->prefIdAndAddressToId($prefId, $address);
		$this->assertSame(31201, $cityId);
		//都道府県市区を取り除いたものがほしい
		$this->assertSame('江津730', $city->removePrefAndCityName($address));
	}
}
