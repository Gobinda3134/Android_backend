 <form action="<?php print $PHP_SELF?>" enctype="multipart/form-data" method="post">
Last name:<br /> <input type="text" name="name" value="" /><br />
class notes:<br /> <input type="file" name="classnotes" value="" /><br />
  <input type="submit" name="submit" value="Submit Notes" />
</form>

<?php
 define ("filesplace","./");

 if (is_uploaded_file($_FILES['assignment_names']['tmp_name'])) {

 if ($_FILES['classnotes']['type'] != "application/pdf") {
 echo "<p>Class notes must be uploaded in PDF format.</p>";
 } else {
 $name = $_POST['name'];
 $result = move_uploaded_file($_FILES['classnotes']['tmp_name'], filesplace."/$name.pdf");
 if ($result == 1) echo "<p>Upload done .</p>";
 else echo "<p>Sorry, Error happened while uploading . </p>";
} #endIF
 } #endIF
?>