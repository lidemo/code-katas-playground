<?php
    
require_once 'Square.php';
require_once 'Player.php';

class Grid{
 
    protected array $squares = [];
    protected $player;
    protected $mine_likelihood;
    protected $used_squares = [];
    
    function __construct(Player $player, float $mine_likelihood) {
        $this->player = $player;
        $this->mine_likelihood = $mine_likelihood;    
        
        $this->createSquares();
        //$this->createMines();
    }
    
    public function createSquares() {
        for ($x = 8; $x > 0; $x--) {
            for ($y = 1; $y <= 8; $y++) {
                $this->squares[] = new Square($x, $y);  
            }
        }
    }
    
    public function createMines() {
        array_map(function($square) {
           $rand = (float)rand()/(float)getrandmax();
           if ($rand < $this->mine_likelihood) $square->addMine();
        }, $this->squares);
        
        //remove mine from player square
        $this->square($this->player->getX(), $this->player->getY())->removeMine();
    }
    
    public function draw() {
        if ($this->player->getX() >= 9) {
            echo 'Game Won!';
            return;
        }
        
        $this->updateUsedSquares();
        $this->updatePlayerSquare();
        
        foreach($this->squares as $square) {
            echo $square->display() . '|';
            if ($square->getY() >= 8) {
                echo PHP_EOL;
            }
        }
    }
    
    public function updateUsedSquares() {
        array_map(function($position) {
            $this->square($position->x, $position->y)->setDisplay('o');
        }, $this->player->historicPositions());
    }
    
    public function updatePlayerSquare() {
        $square = $this->square($this->player->getX(), $this->player->getY());
        
        //echo 'SQUARE '. $square->getX().'|'.$square->getY(). ' mine?: ';
        //echo $square->isMine() ? 'true' : 'false';
        
        if ($square->isMine()) {
            $this->player->setPosition(end($this->player->historicPositions())->x, end($this->player->historicPositions())->y);
            $this->player->setLives($this->player->lives() - 1);
            echo 'LIVES NOW:' . $this->player->lives();
            return $square->setDisplay('*');
       }
        
        $this->used_squares[] = $square;
        $square->setDisplay('O');
    }
    
    public function player() {
        return $this->player;   
    }
    
    public function square(int $x, int $y) { 
        return array_shift(array_filter($this->squares, fn($item) => $item->x == $x && $item->y == $y ?? $item));   
    }
    
    public function squares() {
        return $this->squares;   
    }
    
    public function mines() {
        return array_filter($this->squares, fn($item) => $item->isMine() == true ?? $item);   
    }
}
