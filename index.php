<html>
<head>
</head>

<body>
<h1>Sudoku</h1>
<br>
<br>
<form action="sudoku.php" method=post>
    <input size=82 type="text" name="input"></input>
    <input type=submit></input>
    <input type=hidden name=key value=1>
</form>
<?php
$str = "";
$str .= "<center><form action='sudoku.php' method=post>";
for ($i = 0; $i < 9; $i++) {
    for ($j = 0; $j < 9; $j++) {
        $str .= "<input min=1 max=9 maxlength=1 style='width:30;'  type='number' name='f" . ($i * 9 + $j) . "'></input>";
    }
    $str .= "<br>";
}
$str .= '<input type=submit></input><input type=hidden name =key value=2></form></center>';
print $str;

?>


</body>
</html>