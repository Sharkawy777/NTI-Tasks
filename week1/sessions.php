<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    if (!empty($_POST['title'])) {
//        if (!empty($_POST['content'])){
//            if (strlen($_POST['content']) > 10){
//                echo 'title: ' . $_POST['title'] . '<br>Content:' . $_POST['content'];
//            }else{
//                echo 'content must be more than 10 characters!';
//            }
//        }
//        else{
//            echo 'please enter your content!';
//        }
//    }else{
//        echo 'please enter your title!<br>';
//    }

//Session 4
    /*
    function clean_data($data)
    {
        $data = trim($data);
        $data = strip_tags($data);
        return $data;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = clean_data($_POST['name']);
        $password = clean_data($_POST['password']);
        $address = clean_data($_POST['address']);
        $email = clean_data($_POST['email']);
        $linkedin = clean_data($_POST['linkedin']);

        $errors = [];

        //name validation
        if (empty($name)) {
            $errors['nameEmpty'] = 'please enter your name';
        } elseif (!is_string($name)) {
            $errors['nameType'] = 'please enter a valid name (strings)';
        }

        //password validation
        if (empty($password)) {
            $errors['passwordEmpty'] = 'please enter your password';
        } elseif (strlen($password) < 6) {
            $errors['passwordLength'] = 'password must at least 6 characters';
        }

        //address validation
        if (empty($address)) {
            $errors['addressEmpty'] = 'please enter your address';
        } elseif (strlen($address) < 10) {
            $errors['addressLength'] = 'address must at least 10 characters';
        }

        //email validation
        if (empty($email)) {
            $errors['emailEmpty'] = 'please enter your email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['isEmail'] = 'please enter a valid email';
        }

        //linkedin validation
        if (empty($linkedin)) {
            $errors['linkedinEmpty'] = 'please enter your linkedin url';
        } elseif (!filter_var($linkedin, FILTER_VALIDATE_URL) && substr_compare($linkedin, 'https://www.linkedin.com/in/', 0, 27)) {
            $errors['isLinkedin'] = 'please enter a valid linkedin url';
        }

        //check errors array
        if (count($errors) > 0) {
            foreach ($errors as $key => $value) {
                echo '> ' . $key . ' : ' . $value . '<br>';
            }
        } else {
            echo 'Registered Successfully, Welcome - ' . $name;
        }

    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

    <div class="container">
        <h2>Register</h2
                <!--        <?php echo $_SERVER['PHP_SELF']; ?>-->
        <form action="" method="post">

            <div class="form-group">
                <label for="exampleInputName">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                       placeholder="Enter Name">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Email address</label>
                <!--            type ="email"      aria-describedby="emailHelp" -->
                <input type="text" class="form-control" id="exampleInputEmail1" name="email"
                       placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                       placeholder="Password">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
            </div>

            <div class="form-group">
                <label for="linkedin">LinkedIn url</label>
                <!--            url-->
                <input type="text" class="form-control" id="linkedin" name="linkedin"
                       placeholder="https://www.linkedin.com/in/xxxxxxxx">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </body>
    </html>*/
    $imgName = strtolower($_FILES['image']['name']);
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];

    if (!empty($_FILES['image']['name'])) {


        $imgExtension = explode('.', $imgName);
        $imgExtension = end($imgExtension);
        $allowedExtensions = ['png', 'jpg', 'gif'];

        if (in_array($imgExtension, $allowedExtensions)) {

            $finalImgName = rand() . time() . '.' . $imgExtension;
            $dis_path = './uploads/' . $finalImgName;
            if (move_uploaded_file($imgTempPath, $dis_path)) {
                echo 'Image uploaded';
            } else {
                echo 'failed to upload';
            }
        } else {
            echo "Extension not allowed";
        }
    } else {
        echo "please upload image";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Upload Image</h2
            <!--        <?php echo $_SERVER['PHP_SELF']; ?>-->
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                   placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
