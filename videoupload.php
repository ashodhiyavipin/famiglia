<?php
/*
_max_size setting, but you have to change also upload_max_filesize setting in php.ini:

post_max_size = 32M
upload_max_filesize = 32M
*/
?>
<form action="videoupload_file.php" method="post" enctype="multipart/form-data">
  <input type="file" name="file" />
  <br />
<input type="submit" name="submit" value="Submit" />
</form>

