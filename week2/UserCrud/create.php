<?php

include 'dbConnection.php';
include 'functions.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = clean_data($_POST['title']);
    $content = clean_data($_POST['content']);
    $date = clean_data($_POST['date']);
    $imgName = clean_data($_FILES['image']['name']);
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];
    $errors = [];

    $errors = data_validate($title, $content, $date, $errors);

    //image validation and upload
    $errors = image_validate($imgName, $imgTempPath, $imgSize, $imgType, $errors);

    //check errors array
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '> ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        $finalImgName= $_SESSION['finalImgName'];
        $query = "insert into blog (`title`, `content`, `date`, `image`) values ('$title','$content','$date','$finalImgName')";
        $insert = mysqli_query($conn, $query);
        if ($insert)
//            echo "Record inserted";
            $Message = "Record inserted";
        else
//            echo mysqli_error($conn);
            $Message= mysqli_error($conn);

        $_SESSION['Message'] = $Message;
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Create blog</h2
    <p>Visit the following link to access full blog - <a href='index.php'>View Blog Articles</a></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" id="" name="title" aria-describedby=""
                   placeholder="Enter Title">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="Enter your content">
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>

        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>