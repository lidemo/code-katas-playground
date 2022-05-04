<?php
require_once 'Grid.php';
require_once 'Square.php';

use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    
    public function testCreatesGridSquares()
    {
        
        $expected_squares = [
            new Square(8,1), new Square(8,2), new Square(8,3), new Square(8,4), new Square(8,5), new Square(8,6), new Square(8,7), new Square(8,8),
            new Square(7,1), new Square(7,2), new Square(7,3), new Square(7,4), new Square(7,5), new Square(7,6), new Square(7,7), new Square(7,8),
            new Square(6,1), new Square(6,2), new Square(6,3), new Square(6,4), new Square(6,5), new Square(6,6), new Square(6,7), new Square(6,8),
            new Square(5,1), new Square(5,2), new Square(5,3), new Square(5,4), new Square(5,5), new Square(5,6), new Square(5,7), new Square(5,8),
            new Square(4,1), new Square(4,2), new Square(4,3), new Square(4,4), new Square(4,5), new Square(4,6), new Square(4,7), new Square(4,8),
            new Square(3,1), new Square(3,2), new Square(3,3), new Square(3,4), new Square(3,5), new Square(3,6), new Square(3,7), new Square(3,8),
            new Square(2,1), new Square(2,2), new Square(2,3), new Square(2,4), new Square(2,5), new Square(2,6), new Square(2,7), new Square(2,8),
            new Square(1,1), new Square(1,2), new Square(1,3), new Square(1,4), new Square(1,5), new Square(1,6), new Square(1,7), new Square(1,8)
        ];
        
        $player = new Player(1,1);
        $grid_squares = (new Grid($player, 0))->squares();
        
        $this->assertIsArray($grid_squares);
        $this->assertEquals(64, count($grid_squares));
        $this->assertEquals(new Square(2, 8), $grid_squares[55]);
        $this->assertEquals($expected_squares, $grid_squares);
       
    }
    
    public function testDrawsGrid() {
        $expected = "".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|O|.|.|.|.|.|.|\n";
        
        $player = new Player(1,2);
        $grid = (new Grid($player, 0));
        
        $this->expectOutputString($expected, $grid->draw());
    }
    
    public function testUpdatePlayerPositionSquare() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 0); 
        
        $player->moveUp();
        $player->moveRight();
        $player->moveUp();
        
        $this->assertEquals(3, $grid->player()->getX());
        $this->assertEquals(6, $grid->player()->getY());
        
        $expected = "".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|O|.|.|\n".
                    ".|.|.|.|o|o|.|.|\n".
                    ".|.|.|.|o|.|.|.|\n";
        
        $this->expectOutputString($expected, $grid->draw());
    }
    
    public function testWinsGame() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 0); 
        
        $player->moveUp(); //2,5
        $player->moveUp(); //3,5
        $player->moveUp(); //4,5
        $player->moveUp(); //5,5
        $player->moveUp(); //6,5
        $player->moveUp(); //7,5
        $player->moveUp(); //8,5
        $player->moveUp(); //9,5
        
        $this->assertEquals(9, $player->getX());
        $this->assertEquals(5, $player->getY());
        
        $expected = "Game Won!";
        
        $this->expectOutputString($expected, $grid->draw());
    }
    
    public function testDrawsPlayerOnGrid() {
        $expected = "".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|.|.|.|.|\n".
                    ".|.|.|.|O|.|.|.|\n";
        
        $player = new Player(1, 5);
        $grid = new Grid($player, 0);
        
        $this->expectOutputString($expected, $grid->draw());
    }
    
    public function testGridHasNoMines() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 0);
        $grid->createMines();
        
        $mines = $grid->mines();
        
        $this->assertEquals(0, count($mines));
    }
    
    public function testGridHasAllMines() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 1);
        $grid->createMines();
        
        $mines = $grid->mines();
        
        $this->assertEquals(63, count($mines));
    }
    
    public function testGridHasSomeMines() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 0.4);
        $grid->createMines();
        
        $mines = $grid->mines();
        
        echo count($mines);
        $this->assertGreaterThan(0, count($mines));
    }
    
    public function testMineNotOnPlayerSquare() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 1);
        $grid->createMines();
        
        $player_square = $grid->square(1, 5);
        
        $this->assertFalse($player_square->isMine());
    }
    
    public function testPlayerStepsOnMine() {
        $player = new Player(1, 5);
        $grid = new Grid($player, 1);
        $grid->square(2,5)->addMine();
        
        $player->moveUp();
        
        $grid->draw();
        
        $this->assertTrue($grid->square(2,5)->isMine(), 'Asserts that the square is a mine.');
        $this->assertEquals(4, $player->lives(), 'Asserts that a life was lost on mine');
        $this->assertEquals(1, $player->getX(), 'Asserts X position didn\'t change when stepping on mine');
        $this->assertEquals(5, $player->getY(), 'Asserts Y position didn\'t change when stepping on mine');
    }

    
 
}

?>
