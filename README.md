# jp-address

jp-addressとは
都道府県コードと都道府県の名称を変換するライブラリです。


## 使い方
```
$pref = Nago\JpAddress\Pref::getInstance()
$pref->idToName(13) -----> 東京都
$pref->nameToId("北海道") -----> 1
$pref->addressToId('奈良県奈良市雑司町４０６−１') ----->29
```
