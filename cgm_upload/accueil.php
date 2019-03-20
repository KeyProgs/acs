<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form fichier</title>
</head>
<body style="background-color: aliceblue">
<a href="index.php">Uploader un fichier</a>
<div align="center" style="margin-top: 10vh">
    <h1>Nom de fichier</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <input style="min-width: 30%" type="text" name="file" value="<?php echo isset($_GET['file']) ? $_GET['file'] : "" ?>"/>
        <input type="submit" value="Valider"/>
    </form>
</div>

</body>
</html>


