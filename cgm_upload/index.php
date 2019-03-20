<?php
if(isset($_FILES['file'])) {
   $errors = array();
   $file_name = $_FILES['file']['name'];
   $file_size = $_FILES['file']['size'];
   $file_tmp = $_FILES['file']['tmp_name'];
   $file_type = $_FILES['file']['type'];
   $tmp = explode('.', $_FILES['file']['name']);
   $file_ext = strtolower(end($tmp));
   $file_name = date("Y-m-d_H-i-s") . "_" . $file_name;
   $extensions = array("pdf", "txt", "pdf", "jpeg", "jpg", "png");

   if(in_array($file_ext, $extensions) === false) {
      $errors[] = "extension not allowed";
   }

   if($file_size > 2097152) {
      $errors[] = 'File size must be excately 2 MB';
   }

   if(empty($errors) == true) {
      move_uploaded_file($file_tmp, "cgm_files/" . $file_name);
      header("location:accueil.php?file=" . $file_name);
   } else {
      print_r($errors);
   }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uploader un fichier</title>
</head>
<body style="background-color: aliceblue">
<div align="center" style="margin-top: 10vh">
    <h1>Veuillez choisir un fichier</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file"/>
        <input type="submit" value="Uploader"/>
    </form>
</div>

</body>
</html>


