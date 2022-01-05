<?php

//Session 2
//$age = 20;
//
//function getAge(){
////    global $age;
////    echo $ago;
//    echo $GLOBALS['age'];
//}
//getAge();

//function getNum(){
//    $x = 0;
//    echo $x .'<br>';
//    $x++;
//}
//
//getNum();
//getNum();
//getNum();

//str_word_count();

//$students = [
//    "std1" => ["name" => "ahmed", "age" => 22, "gpa" => 3.4],
//    "std2" => ["name" => "mahmoud", "age" => 23, "gpa" => 3.2],
//    "std3" => ["name" => "ziad", "age" => 24, "gpa" => 3.1],
//];
//foreach ($students as $student => $value) {
//    echo $student . " : " . "<br>";
//    foreach ($value as $student => $val) {
//        echo $student . " - " . $val . "<br>";
//    }
//    echo "<br>";
//}

//Session 3

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//if (!isset($_POST['title'])) {
//    echo 'please enter your title!<br>';
//}
//if (!isset($_POST['content'])) {
//    echo 'please enter your content!';
//} elseif (!strlen($_POST['content']) > 10) {
//    echo 'content must be more than 10 characters!';
//}
//
//if (isset($_POST['title'], $_POST['content']) && strlen($_POST['content']) > 10) {
//    echo 'title: ' . $_POST['title'] . '<br>Content:' . $_POST['content'];
//}
//}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['title'])) {
        if (!empty($_POST['content'])){
            if (strlen($_POST['content']) > 10){
                echo 'title: ' . $_POST['title'] . '<br>Content:' . $_POST['content'];
            }else{
                echo 'content must be more than 10 characters!';
            }
        }
        else{
            echo 'please enter your content!';
        }
    }else{
        echo 'please enter your title!<br>';
    }
}
?>
<html>
<body>
<form method="POST" action="">
    <label for="name">Title</label>
    <input type="text" name="title" id="name">

    <br>
    <label for="content">content</label>
    <input type="text" name="content" id="content">
    <br>
    <input type="submit" name="submit" value="Submit">

</form>
</body>

</html>
