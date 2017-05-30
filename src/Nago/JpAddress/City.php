<?php
namespace Nago\JpAddress;

class City{
	public static function getInstance(){
		static $instance = null;
		if($instance === null){
			$instance = new self();
		}
		return $instance;
	}
	public function addressToId($address){
		$prefId = Pref::getInstance()->addressToId($address);
		$cityId = $this->prefIdAndAddressToId($prefId, $address);
		return $cityId;
	}
	public function nameToId($prefId, $name){
		$cities = $this->cities($prefId);
		return array_search($name, $cities);
	}
	public function idToName($prefId, $cityId){
		$cities = $this->cities($prefId);
		return $cities[$cityId];
	}
	/**
	 * 都道府県と市区を取り除いた住所を取得する
	 * @param string $address 都道府県から始まる住所
	 * @return boolean | string
	 */
	public function removePrefAndCityName($address){
		$pref = Pref::getInstance();
		$prefId = $pref->addressToId($address);
		if($prefId === false)return false;
		$cityId = $this->addressToId($address);
		if($cityId === false)return false;
		$addressWithOutPref = $pref->removePrefName($address);
		$cityName = $this->idToName($prefId, $cityId);
		$withOutPrefCityName = str_replace($cityName, '', $addressWithOutPref);
		return $withOutPrefCityName;
	}
	public function cities($prefId){
		$cities = include __DIR__ . '/CityData/' . $prefId . '.php';
		return $cities;
	}
	public function prefIdAndAddressToId($prefId, $address){
		$cities = $this->cities($prefId);
		foreach($cities as $id => $value){
			if(mb_strpos($address, $value) !== false){
				return $id;
			}
		}
		return false;
	}
	
}
