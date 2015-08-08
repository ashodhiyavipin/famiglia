<?php
$filename = rand(). $_FILES["file"]["name"];
move_uploaded_file($_FILES["file"]["tmp_name"],"video/" . $filename );

?>
