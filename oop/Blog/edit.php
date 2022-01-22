<?php
require './classes/blogClass.php';

$id = $_GET['id'];
$blog = new Blog();
$data = $blog->getBlog($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $imgName = $_FILES['image']['name'];
    $imgTempPath = $_FILES['image']['tmp_name'];

//    $blog = new Blog();

    $blog->edit_noImg($id,$title, $content, $imgName, $imgTempPath);
//    $blog->edit($id,$title, $content, $imgName, $imgTempPath);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">

    <h2>Edit</h2>
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

    <form action="" method="post" enctype="multipart/form-data">
<!--    <form action="--><?php //echo htmlspecialchars($_SERVER['PHP_SELF']); ?><!--" method="post" enctype="multipart/form-data">-->

        <div class="form-group">
            <br>
            <label for="exampleInputName">Title</label>
            <input type="text" class="form-control" id="exampleInputName" name="title" aria-describedby=""
                   placeholder="Enter Title" value="<?php echo $data['title']; ?>">
        </div>


        <div class="form-group">
            <label for="content">Content</label>
            <input type="text-area" class="form-control" id="content" name="content" placeholder="Enter content"
                   value="<?php echo $data['content']; ?>">
        </div>

        <div class="form-group">
            <label for="exampleInputName">Image</label>
            <input type="file" name="image">
        </div>
        <img src="./uploads/<?php echo $data['image']; ?>" alt="" height="50px" width="50px"> <br>
        <?php
        $_SESSION['data']=$data;
        $_SESSION['id']=$id;
        ?>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>
</html>
