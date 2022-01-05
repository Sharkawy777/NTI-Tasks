<?php

/*
Create a form with the following inputs (name, email, password, address,, linkedin url) Validate inputs then return message to user .
validation rules ...
name  = [required , string] -> Done
email = [required,email] ->
password = [required,min = 6] -> Done
address = [required,length = 10 chars] -> Done
linkedin url = [required | url] -> Done
Don't use Filters or regular expressions .
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    //name validation
    if (empty($_POST['name'])) {
        $errors['nameEmpty'] = 'please enter your name';
    } elseif (!is_string($_POST['name'])) {
        $errors['nameType'] = 'please enter a valid name (strings)';
    }

    //password validation
    if (empty($_POST['password'])) {
        $errors['passwordEmpty'] = 'please enter your password';
    } elseif (strlen($_POST['password']) < 6) {
        $errors['passwordLength'] = 'password must at least 6 characters';
    }

    //address validation
    if (empty($_POST['address'])) {
        $errors['addressEmpty'] = 'please enter your address';
    } elseif (strlen($_POST['address']) <= 10) {
        $errors['addressLength'] = 'address must at least 10 characters';
    }

    //linkedin validation
    if (empty($_POST['linkedin'])) {
        $errors['linkedinEmpty'] = 'please enter your linkedin url';
    } elseif (!is_link($_POST['linkedin']) && substr_compare($_POST['linkedin'], 'https://www.linkedin.com/in/', 0, 27)) {
        $errors['isLinkedin'] = 'please enter a valid linkedin url';
    }

    //email validation
    if (empty($_POST['email'])) {
        $errors['emailEmpty'] = 'please enter your email';
    }
//    elseif ($_POST['email'] == 0) {
//        $errors['isEmail'] = 'please enter a valid email';
//    }


    //check errors array
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '> ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        echo 'Registered Successfully, Welcome - ' . $_POST['name'];
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

        <div class="form-group">
            <label for="linkedin">LinkedIn url</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin"
                   placeholder="https://www.linkedin.com/in/xxxxxxxx">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>