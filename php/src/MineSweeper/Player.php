<?php

class Player{
    
    protected $x, $y;
    protected $historic_positions = [];
    
    function __construct(int $x, int $y) {
        
        if ((1 > $x || 8 < $x) || (1 > $y || 8 < $y) ) {
            throw new InvalidArgumentException('Position values must be between grid boundaries 1-8');   
        }
        
        $this->x = $x;
        $this->y = $y;
        $this->recordPositions($x, $y);
        $this->lives = 5;
    }
    
    public function moveUp() {
        $this->x++;   
        $this->recordPositions($this->x, $this->y);
    }
    
    public function moveDown() {
        $this->x--; 
        if ($this->isOutOfBounds()) $this->x++;
        $this->recordPositions($this->x, $this->y);
    }
    
    public function moveRight() {
        $this->y++;
        if ($this->isOutOfBounds()) $this->y--;
        $this->recordPositions($this->x, $this->y);
    }
    
    public function moveLeft() {
        $this->y--;   
        if ($this->isOutOfBounds()) $this->y++;
        $this->recordPositions($this->x, $this->y);
    }
    
    public function isOutOfBounds() {
        return (1 > $this->x || (1 > $this->y || 8 < $this->y));
    }
    
    public function recordPositions($x, $y) {
        $positionObj = new stdClass();
        $positionObj->x = $x;
        $positionObj->y = $y;
        $this->historic_positions[] = $positionObj;
    }
    
    public function historicPositions() {
        return $this->historic_positions;   
    }
    
    public function getX() {
        return $this->x; 
    }
    
    public function getY() {
        return $this->y; 
    }
    
    public function setPosition(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
        if ($this->isOutOfBounds()) throw new InvalidArgumentException('Position values must be between grid boundaries 1-8');
    }
    
    public function lives() {
        return $this->lives; 
    }
    
    public function setLives(int $lives) {
        $this->lives = $lives;   
    }
   
    
}