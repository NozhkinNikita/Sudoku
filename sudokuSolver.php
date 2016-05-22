<?php

class SudokuSolver
{

    private $field = array();
//input: String $input with sudoku ,length input=81, $input[i]=numeric or '.' if undefined\
//throw exception if incorect input 
    public function __construct($input)
    {
        for ($i = 0; $i < strlen($input); $i++) {
            if (!(($input[$i] >= "1" && $input[$i] <= "9") || ($input[$i] == "."))) {
                throw new \Exception();
            }
            if ($input[$i] == '.')
                $this->field[$i] = 0;
            else
                $this->field[$i] = (int)$input[$i];
        }
    }
// solve  this sudoku 
//output: return true if solved this or false if sudoku unsolvable

    public function solve()
    {

        try {
            return $this->solvePos(0);
        } catch (\Exception $e) {
            return true;
        }
    }

//check sudoku to correct form, not equals number in line,column or square 
//output: true if correct, false if incorect
    public function checkInput()
    {
        $check = array();
        for ($i = 0; $i++; $i <= 9)
            $check[$i] = 0;
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                if ($check[$this->field[$i * 9 + $j]] == 1) {
                    return false;
                } else if ($this->field[$i * 9 + $j] != 0) $check[$this->field[$i * 9 + $j]] = 1;
            }
            for ($j = 0; $j <= 9; $j++)
                $check[$j] = 0;
        }
        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 9; $j++) {
                if ($check[$this->field[$j * 9 + $i]] == 1) {
                    return false;
                } else if ($this->field[$j * 9 + $i] != 0) $check[$this->field[$j * 9 + $i]] = 1;
            }
            for ($j = 0; $j <= 9; $j++)
                $check[$j] = 0;
        }
        for ($i = 0; $i <= 6; $i = $i + 3) {
            for ($j = 0; $j < 9; $j++) {
                if ($j == 3 || $j == 6)
                    for ($q = 0; $q <= 9; $q++)
                        $check[$q] = 0;
                if ($check[$this->field[$i * 9 + $j]] == 1) {
                    return false;
                } else if ($this->field[$i * 9 + $j] != 0) $check[$this->field[$i * 9 + $j]] = 1;
                if ($check[$this->field[$i * 9 + $j + 9]] == 1) {
                    return false;
                } else if ($this->field[$i * 9 + $j + 9] != 0) $check[$this->field[$i * 9 + $j + 9]] = 1;
                if ($check[$this->field[$i * 9 + $j + 18]] == 1) {
                    return false;
                } else if ($this->field[$i * 9 + $j + 18] != 0) $check[$this->field[$i * 9 + $j + 18]] = 1;
            }
            for ($j = 0; $j <= 9; $j++)
                $check[$j] = 0;
        }
        return true;
    }

    private function solvePos($i)
    {
        if ($i == 81) {
            //$this->display(field);
            throw new \Exception();


        }
        if ($this->field[$i] > 0) {
            $this->solvePos($i + 1);
            return;
        }
        for ($j = 1; $j <= 9; $j++) {
            if ($this->check($j, $i % 9, floor($i / 9))) {
                $this->field[$i] = $j;
                $this->solvePos($i + 1);
                $this->field[$i] = 0;
            }
        }
    }

    private function check($number, $x, $y)
    {

        for ($i = 0; $i < 9; $i++) {
            if (($this->field[$y * 9 + $i] == $number) || ($this->field[$i * 9 + $x] == $number)) {
                return false;
            }
        }
        $startX = (int)((int)($x / 3) * 3);
        $startY = (int)((int)($y / 3) * 3);
        for ($i = $startY; $i < $startY + 3; $i++) {
            for ($j = $startX; $j < $startX + 3; $j++) {
                if ($this->field[$i * 9 + $j] == $number) {
                    return false;
                }
            }
        }
        return true;
    }

//print sudoku
    public function display()
    {
        $str = "<table border=1 width=300>";

        for ($i = 0; $i < 9; $i++) {
            $str .= '<tr>';
            for ($j = 0; $j < 9; $j++) {
                $str .= "<td>" . ($this->field[$i * 9 + $j]) . "</td>";
            }
            $str .= "</tr>";
        }
        $str .= '</table>';
        print($str);
    }
}

?>