<?php
session_start();
require 'dbClass.php';
require 'ValidatorClass.php';

class Blog
{
    private $title;
    private $content;
    private $imgName;
    private $imgTempPath;

    public function Create($title, $content, $imgName, $imgTempPath)
    {
        $validator = new Validator();

        $this->title = $validator->Clean($title);
        $this->content = $validator->Clean($content);
        $this->imgName = $validator->Clean($imgName);

        $errors = [];

        if (!$validator->Validate($this->title, 1)) {
            $errors['title'] = 'Field Required';
        }

        if (!$validator->Validate($this->content, 1)) {
            $errors['content'] = 'Field Required';
        } elseif (!$validator->Validate($this->content, 2)) {
            $errors['contentLength'] = 'Field must be at least 50 char';
        }

        if (!$validator->Validate($this->imgName, 1)) {
            $errors['Image'] = 'Field Required';
        } else {
            $this->imgTempPath = $imgTempPath;
            $extArray = explode('.', $this->imgName);
            $ImageExtension = strtolower(end($extArray));

            if (!$validator->Validate($ImageExtension, 4)) {
                $errors['Image'] = 'Invalid Extension';
            } else {
                $FinalName = time() . rand() . '.' . $ImageExtension;
            }
        }

        # CHECK ERRORS ...
        if (count($errors) > 0) {
            $Message = $errors;
        } else {
            $disPath = './uploads/' . $FinalName;

            if (move_uploaded_file($this->imgTempPath, $disPath)) {

                $db = new DB();
                $sql = "insert into blog (title,content,image) values ('$this->title','$this->content','$FinalName')";
                $op = $db->doQuery($sql);

                if ($op) {
                    $Message = ['Raw Inserted'];
                    header("location: index.php");
                } else {
                    $Message = ['Error Try Again !!!!!'];
                }
            } else {
                $Message = ['Message' => 'Error  in uploading Image  Try Again '];
            }
        }
        $_SESSION['Message'] = $Message;
    }

    public function getBlog($id)
    {
        $db = new DB();
        $sql = "select * from blog where id = $id";
        $op = $db->doQuery($sql);

        if (mysqli_num_rows($op) == 1) {
            $data = mysqli_fetch_assoc($op);
            return $data;
        } else {
            $Message = ["Message" => "Invalid Id "];
        }
        $_SESSION['Message'] = $Message;
    }

    public function edit($id, $title, $content,$imgName, $imgTempPath)
    {
        $validator = new Validator();

        $this->title = $validator->Clean($title);
        $this->content = $validator->Clean($content);
        $this->imgName = $validator->Clean($imgName);
        $errors = [];

        if (!$validator->Validate($this->title, 1)) {
            $errors['title'] = 'Field Required';
        }elseif (!$validator->Validate($this->title, 3)){
            $errors['title'] = 'Field must be string';
        }

        if (!$validator->Validate($this->content, 1)) {
            $errors['content'] = 'Field Required';
        } elseif (!$validator->Validate($this->content, 2)) {
            $errors['contentLength'] = 'Field must be at least 50 char';
        }

        if (!$validator->Validate($this->imgName, 1)) {
            $errors['Image'] = 'Field Required';
        } else {
            $this->imgTempPath = $imgTempPath;
            $extArray = explode('.', $this->imgName);
            $ImageExtension = strtolower(end($extArray));

            if (!$validator->Validate($ImageExtension, 4)) {
                $errors['Image'] = 'Invalid Extension';
            } else {
                $FinalName = time() . rand() . '.' . $ImageExtension;
            }
        }

        # CHECK ERRORS ...
        if (count($errors) > 0) {
            $Message = $errors;
        } else {
            $disPath = './uploads/' . $FinalName;

            if (move_uploaded_file($this->imgTempPath, $disPath)) {

                $db = new DB();
                $sql = "update blog set title='$this->title',content='$this->content', image ='$FinalName' where id = '$id'";

                $op = $db->doQuery($sql);

                if ($op) {
                    $Message = ['Message' => 'Raw Updated'];
                    header("location: index.php");
                } else {
                    $Message = ['Error Try Again !!!!!'];
                }
            } else {
                $Message = ['Message' => 'Error  in uploading Image  Try Again '];
            }
        }
        $_SESSION['Message'] = $Message;
    }

    public function edit_noImg($id, $title, $content,$imgName, $imgTempPath)
    {
        $validator = new Validator();

        $this->title = $validator->Clean($title);
        $this->content = $validator->Clean($content);
        $this->imgName = $validator->Clean($imgName);
        $errors = [];
        $data = $this->getBlog($id);

        if (!$validator->Validate($this->title, 1)) {
            $errors['title'] = 'Field Required';
        }

        if (!$validator->Validate($this->content, 1)) {
            $errors['content'] = 'Field Required';
        } elseif (!$validator->Validate($this->content, 2)) {
            $errors['contentLength'] = 'Field must be at least 50 char';
        }

        if ($validator->Validate($_FILES['image']['name'], 1)) {
            $this->imgTempPath = $_FILES['image']['tmp_name'];
            $this->imgName = $_FILES['image']['name'];

            $extArray = explode('.', $this->imgName);
            $ImageExtension = strtolower(end($extArray));

            if (!$validator->Validate($ImageExtension, 4)) {
                $errors['Image'] = 'Invalid Extension';
            } else {
                $FinalName = time() . rand() . '.' . $ImageExtension;
            }
        }

        if (count($errors) > 0) {
            $Message = $errors;
        } else {
            if ($validator->Validate($_FILES['image']['name'], 1)) {
                $disPath = './uploads/' . $FinalName;

                if (!move_uploaded_file($imgTempPath, $disPath)) {
                    $Message = ['Message' => 'Error  in uploading Image  Try Again '];
                } else {
                    unlink('./uploads/' . $data['image']);
                }
            } else {
                $FinalName = $data['image'];
            }


            if (count($Message) == 0) {
                $db = new DB();
                $sql = "update blog set title='$this->title',content='$this->content', image ='$FinalName' where id = '$id'";
                $op = $db->doQuery($sql);
                if ($op) {
                    $Message = ['Message' => 'Raw Updated'];
                    header("location: index.php");
                } else {
                    $Message = ['Message' => 'Error Try Again '];
                }
            }
            # Set Session ......
            $_SESSION['Message'] = $Message;
            header('Location: index.php');
            exit();
        }
        $_SESSION['Message'] = $Message;
        header("location: index.php");
    }

    public function delete($id)
    {
        $db = new DB();
        $sql = "select * from blog where id = $id";
        $op = $db->doQuery($sql);


        if (mysqli_num_rows($op) == 1) {
            $data = mysqli_fetch_assoc($op);
            $sql = "delete from blog where id = $id";
            $op = $db->doQuery($sql);
            if ($op) {
                unlink('../uploads/' . $data['image']);
                $Message = ["Message" => "Raw Removed"];
            } else {
                $Message = ["Message" => "Error try Again"];
            }
        } else {
            $Message = ["Message" => "Invalid Id "];
        }

        $_SESSION['Message'] = $Message;
        header("location: index.php");
    }

}

?>
