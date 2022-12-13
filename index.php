<?php
session_start();
$start = microtime(true);
?>

<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8" />
	<title>HTML5</title>
    <link rel="stylesheet" href="style.css">
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
</head>
<body class="page text">
    <table class="main-table">
        <tr class="header">
            <th colspan=2>Скворцов Михаил P33222 и Максим Иоган P33222 Вариант 21106</th>
        </tr>
        <tr>
            <td class="coordinates-table">
                <form action="" method="post" class="validation-js-form" novalidate>

                    <p id="red">X: <label for="X">
                            <input name="X" class="input input-val input-x" type="text" required>
                        </label></p>

                    <p>Y: <label for="Y">
                            <input name="Y" class="input input-val input-y" type="text" required>
                        </label></p>

                    <p>R: <label for="R">
                            <input name="R" class="input input-val input-r" type="text" required>
                        </label></p>

                    <p><input type='submit' value='Отправить'></p>
                </form>
            </td>
            <td class="results-table">
                <table class="result">
                    <tr>
                        <th>X</th>
                        <th>Y</th>
                        <th>R</th>
                        <th>is_in_area</th>
                        <th class="text">cur_time</th>
                        <th class="text">script_time</th>
                    </tr>
                    <script src="validation.js"></script>
                    <?php
                    if (empty($_SESSION['counter'])) {
                        $_SESSION['X']=array();
                        $_SESSION['Y']=array();
                        $_SESSION['R']=array();
                        $_SESSION['is_in_area']=array();
                        $_SESSION['cur_time']=array();
                        $_SESSION['script_time']=array();
                        $_SESSION['counter'] = 1;
                    }

                    function check($X,$Y,$R){
                        if($X >= 0 and $Y >= 0 and ($X*$X+$Y*$Y)<=$R*$R){
                            return True;
                        }
                        else {
                            return False;
                        }
                        if($X >= 0 and $Y < 0 and $X <= $R/2 and $Y <= $R){
                            return True;
                        }
                        else {
                            return False;
                        }
                        if($X < 0 and $Y < 0 and $Y + 2*$X >= $R){
                            return True;
                        }
                        else {
                            return False;
                        }
                        if($X < 0 and $Y >= 0){
                            return False;
                        }
                    }
                    if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $X = $_POST['X'];
                        $Y = $_POST['Y'];
                        $R = $_POST['R'];
                    }
                    else {
                        die();
                    }
                    array_push($_SESSION['X'],$X);
                    array_push($_SESSION['Y'],$Y);
                    array_push($_SESSION['R'],$R);

                    $yes = 'Да';
                    $no = 'Нет';
                    if (check($X,$Y,$R)) {
                        $cur_time = date("H:i:s");
                        $script_time = round(microtime(true) - $start, 4);
                        array_push($_SESSION['is_in_area'],$yes);
                        array_push($_SESSION['cur_time'],$cur_time);
                        array_push($_SESSION['script_time'],$script_time);
                    }
                    else {
                        $cur_time = date("H:i:s");
                        $script_time = round(microtime(true) - $start, 4);
                        array_push($_SESSION['is_in_area'],$no);
                        array_push($_SESSION['cur_time'],$cur_time);
                        array_push($_SESSION['script_time'],$script_time);
                    }

                    for ($i = 0; $i < count($_SESSION['X']); $i+=1) {
                        echo '<tr>' . '<td>' . $_SESSION['X'][$i] . '</td>' . '<td>' . $_SESSION['Y'][$i] . '</td>' . '<td>' . $_SESSION['R'][$i] . '</td>' . '<td>' . $_SESSION['is_in_area'][$i] . '</td>' . '<td>' . $_SESSION['cur_time'][$i] . '</td>' . '<td>' . $_SESSION['script_time'][$i] . '</td>' . '</tr>';
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
