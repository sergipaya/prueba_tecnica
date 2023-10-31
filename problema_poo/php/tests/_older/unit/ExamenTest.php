<?php

class ExamenTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        include_once('./src/functions.php');
    }

    public function test270a(){
        $this->assertFileExists('./src/270a.php');
    }
    // tests
    public function test272FecIng(){
        $this->assertEquals('2016/06/23',fecha_inglesa('23.06.2016'));
    }

    public function test272Vell()
    {
        $this->assertEquals(3,vell(['23.06.2016','22.07.2018','10.06.2021','16.06.2006']));
        $this->assertEquals(0,vell(['16.06.2006','23.06.2016','22.07.2018','10.06.2021']));
    }

    public function test272Laureado()
    {
       $this->assertEquals('alcoi', laureado(['barcelona','madrid','barcelona','alcoi','alcoi','alcoi']));
       $this->assertEquals('barcelona', laureado(['barcelona','madrid','barcelona','alcoi','alcoi','barcelona']));
    }

    public function test273Jove()
    {
        $this->assertEquals([1,18],jove(['1980','1975'],['01.01.1999','01.01.1993']));
        $this->assertEquals([2,16],jove(['1980','1975','2000'],['01.01.1999','01.01.1993','01.01.2016']));
    }

    public function test273Any(){
        $this->assertEquals('1999', any('01.12.1999'));
    }

}