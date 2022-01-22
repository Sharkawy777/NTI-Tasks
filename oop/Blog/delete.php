<?php
require './classes/blogClass.php';

# Fetch Id ....
$id = $_GET['id'];
$blog = new Blog();
$blog->delete($id);

?>