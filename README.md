[![License](https://poser.pugx.org/nagoring/jp-address/license)](https://packagist.org/packages/nagoring/jp-address)
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
```
