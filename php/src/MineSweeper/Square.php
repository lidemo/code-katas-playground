<?php
    
class Square{
    
    protected String $display_char = '.';
    protected bool $mine = false;
    
    function __construct(int $x, int $y) {
        
        if ((1 > $x || 8 < $x) || (1 > $y || 8 < $y) ) {
            throw new InvalidArgumentException('Position values must be between grid boundaries 1-8');   
        }
        
        $this->x = $x;
        $this->y = $y;
    }
    
    public function display() {
        return $this->display_char;  
    }
    
    public function setDisplay(String $character) {
        $this->display_char = $character;  
    }
    
    public function position() {
        return [$this->x, $this->y];   
    }
    
    public function getX() {
        return $this->x; 
    }
    
    public function getY() {
        return $this->y; 
    }
    
    public function isMine() {
        return $this->mine;   
    }
    
    public function addMine() {
        $this->mine = true;   
    }
    
    public function removeMine() {
        $this->mine = false;   
    }
    
}