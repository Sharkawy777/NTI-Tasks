<?php
require './classes/blogClass.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imgName = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $imgType = $_FILES['image']['type'];

    $blog = new Blog();
    $blog->Create($title, $content, $imgName, $imgTempPath);

    echo '<br>';
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

    <h2>Create</h2>

        <?php
        $v2 = new Validator;
        if (isset($_SESSION['Message'])) {
            echo '<ol class="breadcrumb mb-4">';
            $v2->Messages($_SESSION['Message']);
            # Unset Session ...
            unset($_SESSION['Message']);
            echo '</ol>';
        }
        ?>

    <a class="btn btn-danger" href="index.php">Home</a>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <br>
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" id="exampleInputName" name="title" aria-describedby=""
                   placeholder="Enter Title">
        </div>


        <div class="form-group">
            <label for="content">Content</label>
            <input type="text-area" class="form-control" id="content" name="content" placeholder="Enter content">
        </div>

        <div class="form-group">
            <label for="exampleInputName">Image</label>
            <input type="file" name="image">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
