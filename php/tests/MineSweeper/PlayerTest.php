<?php
require_once 'Player.php';

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testCreatesPlayer() {
        
        $player = new Player(5, 1);
        
        $this->assertEquals(1, $player->getY());  
        $this->assertEquals(5, $player->getX()); 
        $this->assertEquals(5, $player->lives());
    }
    
    public function testMoveUp() {
        $player = new Player(1,1);
        $player->moveUp(); //2,1
        $player->moveUp(); //3,1
        
        $this->assertEquals('3', $player->getX());
        $this->assertEquals('1', $player->getY());
    }
    
      public function testMoveDown() {
        $player = new Player(5,1);
        $player->moveDown(); //4,1
        $player->moveDown(); //3,1
        
        $this->assertEquals('3', $player->getX());
        $this->assertEquals('1', $player->getY());
    }
    
      public function testMoveRight() {
        $player = new Player(1,1);
        $player->moveRight(); //1,2
        $player->moveRight(); //1,3
        
        $this->assertEquals('1', $player->getX());
        $this->assertEquals('3', $player->getY());
    }
    
      public function testMoveLeft() {
        $player = new Player(1,5);
        $player->moveLeft(); //1,4
        $player->moveLeft(); //1,3
        
        $this->assertEquals('1', $player->getX());
        $this->assertEquals('3', $player->getY());
    }
    
    public function testOutOfBoundsMove() {
        $player = new Player(1,1);
        $player->moveDown(); //1,1
        $player->moveLeft(); //1,1
        
        $this->assertEquals('1', $player->getX());
        $this->assertEquals('1', $player->getY());
    }

    
    public function testMove() {
        $player = new Player(1,1);
        $player->moveUp(); //2,1
        $player->moveRight(); //2,2
        $player->moveRight(); //2,3
        $player->moveDown(); //1,3
        $player->moveRight(); //1,4
        $player->moveRight(); //1,5
        $player->moveLeft(); //1,4
        $player->moveLeft(); //1,3
        
        $this->assertEquals('1', $player->getX());
        $this->assertEquals('3', $player->getY());
    }
}

?>
