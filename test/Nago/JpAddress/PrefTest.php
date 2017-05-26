<?php
include_once __DIR__ . '/../../test-common.php';

class PrefTest extends \PHPUnit\Framework\TestCase{
	public function setUp() {
		parent::setUp();
	}
	public function test_idToName(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame('東京都', $pref->idToName(13));
		$this->assertSame('北海道', $pref->idToName(1));
	}
	public function test_idToName_illegal(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame(false, $pref->idToName(99));
	}
	public function test_nameToId(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame(13, $pref->nameToId('東京都'));
		$this->assertSame(47, $pref->nameToId('沖縄県'));
	}
	public function test_nameToId_illegal(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame(false, $pref->nameToId('aaaaaaa'));
	}
	public function test_addressToId(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame(29, $pref->addressToId('奈良県奈良市雑司町４０６−１'));
		$this->assertSame(41, $pref->addressToId('佐賀県神埼郡 吉野ヶ里町田手1843'));
	}
	public function test_addressToId_illegal(){
		$pref = Nago\JpAddress\Pref::getInstance();
		$this->assertSame(false, $pref->addressToId('AAAAAAAAAAAAAAAAAAAA'));
	}
}