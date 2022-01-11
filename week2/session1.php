<?php

function clean($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}

echo date('d.m.y  h:i:s a');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clean($_POST['name']);
    $password = clean($_POST['password']);
    $address = clean($_POST['address']);
    $email = clean($_POST['email']);
    $linkedin = clean($_POST['linkedin']);

    //Image upload
    $imgName = strtolower($_FILES['image']['name']);
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];

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

    //gender validation
    if (!isset($gender)) {
        $gender = clean($_POST['gender']);
    } else {
        $errors['gender'] = 'please select your gender';
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

    if (!empty($_FILES['image']['name'])) {
        $imgExtension = explode('.', $imgName);
        $imgExtension = end($imgExtension);
        $allowedExtensions = ['png', 'jpg', 'gif'];

        if (in_array($imgExtension, $allowedExtensions)) {

            $finalImgName = rand() . time() . '.' . $imgExtension;
            $dis_path = './uploads/' . $finalImgName;
            if (!move_uploaded_file($imgTempPath, $dis_path)) {
                $errors['uploadError'] = 'failed to upload';
            }
        } else {
            $errors['noImage'] = 'Extension not allowed!';
        }
    } else {
        $errors['isImage'] = 'please enter a valid image';
    }

    //check errors array
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '> ' . $key . ' : ' . $value . '<br>';
        }
    } else {

//        $CookieName = "student";
//        $CookieValue = ["name" => $name, "email" => $email, "gender" => $gender, "password" => $password, "address" => $address, "linkedin" => $linkedin, "imageName" => $imgName];
//        $CookieValue = "name => ". $name. "<br>email => ".  $email. "<br>gender => " .$gender.
//            "<br>password => ".$password. "<br>address => ".$address. "<br>linkedin => ".$linkedin. "<br>imageName =>". $imgName;

//        $CookieValue = implode(',', $CookieValue);
//        setcookie($CookieName, $CookieValue, time() + 86400,'/');

        // save data to txt file
        $userData = ["name" => $name, "email" => $email, "gender" => $gender, "password" => $password, "address" => $address, "linkedin" => $linkedin, "imageName" => $imgName];
        $userData = implode(', ', $userData);
        $userData = $userData."\n";
        $file = fopen('text.txt',"a") or die('unable to open file');
        fwrite($file,$userData);
        echo 'Registered Successfully Data Saved, Welcome - ' . $name;
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
    <h2>Create Account</h2
            <!--        <?php echo $_SERVER['PHP_SELF']; ?>-->
    <form action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                   placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
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

        <label for="gender">Gender</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="male">
            <label class="form-check-label" for="male">
                Male
            </label>
        </div>
        <div>
            <input class="form-check-input" type="radio" name="gender" value="female">
            <label class="form-check-label" for="female">
                female
            </label>
        </div>

        <div class="form-group">
            <label for="linkedin">LinkedIn profile</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin"
                   placeholder="https://www.linkedin.com/in/xxxxxxxx">
        </div>

        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
