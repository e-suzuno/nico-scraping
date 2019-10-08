<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NicoScrapingTest extends TestCase
{


    public function testGetNicoComicTargetPage()
    {

        $no = 1;
        $data = \NicoScraping::getNicoComicTargetPage($no);
        if ($data === false) {
            $this->assertFalse($data);
            return;
        }
        $this->assertEquals($data["title"], "戦勇。");
        $this->assertEquals($data["author"], "春原ロビンソン");

        $this->assertEquals($data["category"], "少年マンガ");
        $this->assertEquals($data["official_title"], "ニコニコ漫画（公式）");
        $this->assertEquals($data["nico_no"], 1);
        $this->assertTrue($data["is_complete"]);
        $this->assertFalse($data["is_adult"]);
        return;
    }


    public function testGetNicoComicTargetPage2()
    {

        //性的タグの確認
        $no = 38174;
        $data = \NicoScraping::getNicoComicTargetPage($no);
        if ($data === false) {
            $this->assertFalse($data);
            return;
        }
        $this->assertEquals($data["title"], "社畜サキュバスの話");
        $this->assertEquals($data["author"], "ゲンツキ");
        $this->assertEquals($data["nico_no"], $no);
        $this->assertTrue($data["is_adult"]);

    }
}
