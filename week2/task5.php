<?php
/*
 * # TASK 5.
 * Build a Blog Module  with following data
 * Title   =  [required , string]
 * Content =  [required,length >50 ch]
 * Image   =  [required, file]
 * Then Store data into text file , display blog data ,  stored data can be deleted.
 */

function clean($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    return $data;
}

function upload_image($imgName, $imgTempPath, $imgSize, $imgType, $errors)
{
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
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $clean($_POST['title']);
    $content = $clean($_POST['content']);
    $imgName = strtolower($_FILES['image']['name']);
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];
    $errors = [];

    //name validation
    if (empty($title)) {
        $errors['titleEmpty'] = 'please enter your name';
    } elseif (!is_string($title)) {
        $errors['titleType'] = 'please enter a valid title (string)';
    }

    //content validation
    if (empty($content)) {
        $errors['contentEmpty'] = 'please enter your content';
    } elseif (strlen($content) < 50) {
        $errors['passwordLength'] = 'content must be more than 50 characters';
    }

    //image validation and upload
    if (!empty($_FILES['image']['name'])) {
        upload_image($imgName, $imgTempPath, $imgSize, $imgType, $errors);
    } else {
        $errors['isImage'] = 'please enter a valid image';
    }

    //check errors array
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo '> ' . $key . ' : ' . $value . '<br>';
        }
    } else {
        // save data to txt file
        $userData = ["title" => $title, "content" => $content, "imageName" => $imgName];
        $userData = implode(' | ', $userData);
        $userData = $userData . "\n";
        $file = fopen('text.txt', "a") or die('unable to open file');
        fwrite($file, $userData);
        echo 'Registered Successfully Data Saved, Welcome - ' . $title;
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
    <h2>Blog</h2>
    <p>Visit the following link to access full blog - <a href='profilePage.php'>View Blog Articles</a></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby=""
                   placeholder="Enter Title">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword">Content</label>
            <input type="text" class="form-control" id="content" name="content"
                   placeholder="content">
        </div>

        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
