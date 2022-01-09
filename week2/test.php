<?php

//delete stored data
file_put_contents("text.txt", "");
header("Location:profilePage.php");
