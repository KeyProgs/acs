<?php
//$directory = __FILE__ . '/8005/';
echo __FILE__ ;
$directory= '/8005';
//$directory= 'C:\8005';
if($handle = opendir($directory)) {
   while(false !== ($fileName = readdir($handle))) {
      if($fileName != "." && $fileName != "..") {
         $newName = str_replace(array('<', '>'), array('', ''), $fileName);
         rename($directory . $fileName, $directory . $newName);
      }

   }
   closedir($handle);
}


$files = array_diff(scandir($directory), array('.', '..'));
?>
<!doctype html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Uploader un fichier</title>
   <style>
      table {
         border: 2px gray solid;
         width: 80%;
      }

      td {
         border: 1px gray solid;
         padding: 3px;
      }
      th {
         border: 1px gray solid;
         padding: 13px;
      }
      tr:nth-child(even) {
         background: #e9e9e9
      }
      tr:nth-child(odd) {
         background: #FFF
      }
   </style>
</head>
<body style="background-color: aliceblue">
<div align="center" style="margin-top: 10vh">
   <h1>Liste des enregistrements</h1>
   <table>
      <tr>
         <th>Fichier</th>
         <th colspan="2">Actions</th>
      </tr>
      <?php foreach($files as $file) { ?>
         <tr>
            <td>
               <?php echo $file; ?>
            </td>
            <td>
               <a href="<?php echo $directory."/".$file ?>" download>telecharger</a>
            </td>
            <td>
               <audio controls>
                  <source src="<?php echo $directory."/".$file ?>" type="audio/mp3">
                  <source src="<?php echo $directory."/".$file ?>" type="audio/ogg">
                  <p>Votre navigateur ne prend pas en charge l'audio HTML. Voici un
                     un <a href="<?php echo $directory."/".$file ?>">lien vers le fichier audio</a> pour le
                     télécharger.</p>
               </audio>
            </td>
         </tr>
      <?php } ?>
   </table>
</div>

</body>
</html>


