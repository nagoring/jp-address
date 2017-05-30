<?php
namespace Nago\JpAddress;

class Street{
	public static function getInstance(){
		static $instance = null;
		if($instance === null){
			$instance = new self();
		}
		return $instance;
	}
	public function addressToId($address){
		$prefId = Pref::getInstance()->addressToId($address);
		$cityId = City::getInstance()->addressToId($address);
		return $this->prefIdAndCityIdAndAddressToId($prefId, $cityId, $address);
	}
	public function addressToName($address){
		$pref = Pref::getInstance();
		$city = City::getInstance();
		$prefId = $pref->addressToId($address);
		if($prefId === false)return false;
		$cityId = $city->addressToId($address);
		if($cityId === false)return false;
		$streetId = $this->addressToId($address);
		$streetName = $this->idToName($prefId, $cityId, $streetId);
		return $streetName;
	}
	public function nameToId($prefId, $cityId, $name){
		$streets = $this->streets($prefId, $cityId);
		return array_search($name, $streets);
	}
	public function idToName($prefId, $cityId, $streetId){
		$streets = $this->streets($prefId, $cityId);
		return $streets[$streetId];
	}
	
	/**
	 * 都道府県と市区と町域を取り除いた住所を取得する
	 * @param string $address 都道府県から始まる住所
	 * @return boolean | string
	 */
	public function removePrefAndCityAndStreetName($address){
		$city = City::getInstance();
		$streetName = $this->addressToName($address);
		if($streetName === false)return false;
		$withOutPrefCityName = $city->removePrefAndCityName($address);
		$withOutPrefCityStreetName = str_replace($streetName, '', $withOutPrefCityName);
		return $withOutPrefCityStreetName;
	}
	public function streets($prefId, $cityId){
		$filepath = __DIR__ . '/StreetData/' . $prefId . '/' .$cityId . '.php';
		if(!file_exists($filepath)){
			return false;
		}
		$streets = include __DIR__ . '/StreetData/' . $prefId . '/' .$cityId . '.php';
		return $streets;
	}
	public function prefIdAndCityIdAndAddressToId($prefId, $cityId, $address){
		$streets = $this->streets($prefId, $cityId);
		foreach($streets as $streetId => $streetName){
			if(mb_strpos($address, $streetName) !== false){
				return $streetId;
			}
		}
		return false;
	}
	
}
