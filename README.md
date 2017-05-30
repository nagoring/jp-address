
[![Latest Stable Version](https://poser.pugx.org/nagoring/jp-address/v/stable)](https://packagist.org/packages/nagoring/jp-address)
[![Total Downloads](https://poser.pugx.org/nagoring/jp-address/downloads)](https://packagist.org/packages/nagoring/jp-address)
[![Latest Unstable Version](https://poser.pugx.org/nagoring/jp-address/v/unstable)](https://packagist.org/packages/nagoring/jp-address)
[![License](https://poser.pugx.org/nagoring/jp-address/license)](https://packagist.org/packages/nagoring/jp-address)
[![Monthly Downloads](https://poser.pugx.org/nagoring/jp-address/d/monthly)](https://packagist.org/packages/nagoring/jp-address)
[![Daily Downloads](https://poser.pugx.org/nagoring/jp-address/d/daily)](https://packagist.org/packages/nagoring/jp-address)
[![composer.lock](https://poser.pugx.org/nagoring/jp-address/composerlock)](https://packagist.org/packages/nagoring/jp-address)
# jp-address

jp-addressとは

都道府県コードと都道府県名を相互に変換するライブラリです。

また住所名からコードを取得することもできます

コードはJIS X 0402 で定義されています。

## 使い方
```
$pref = Nago\JpAddress\Pref::getInstance();
$pref->idToName(13); // -----> 東京都
$pref->nameToId("北海道"); // -----> 1
$pref->addressToId('奈良県奈良市雑司町４０６−１'); // ----->29

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

```





