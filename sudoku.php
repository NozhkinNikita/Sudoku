<?php
include "sudokuSolver.php";

$key=$_POST['key'];
if ($key==1)
    $input=$_POST['input'];
else {
    for($j=0;$j<81;$j++)
        if ($_POST["f$j"]=='')
            $input.='.';
    else $input.=$_POST["f$j"];
}
if($input==""){
    print("Пустая строка");
    exit(0);
}
if(strlen($input)!=81){
    print("Неправильная длина строки - ".strlen($input).". Длина строки должна быть 81.");
    exit(0);
}
//print($input);
try{
    $sudoku=new SudokuSolver($input);
}
catch(\Exception $e){
    print('Некорректная строка, разрешено использовать только цифры(1-9) и точки.');
    exit(0);
}
if ($sudoku->checkInput()){

    if(!$sudoku->solve())
        print('Судоку не решается.');
    else $sudoku->display();

}	
else print('Судоку заполнено не по правилам игры.');


?>
