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
    print("������ ������");
    exit(0);
}
if(strlen($input)!=81){
    print("������������ ����� ������".strlen($input));
    exit(0);
}
//print($input);
try{
    $sudoku=new SudokuSolver($input);
}
catch(\Exception $e){
    print('����������� ������');
    exit(0);
}
if ($sudoku->checkInput()){

    if(!$sudoku->solve())
        print('������ �� ��������');
    else $sudoku->display();

}	
else print('������ � ���������� ������');


?>