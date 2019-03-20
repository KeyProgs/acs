<?php

/***************************
  Sample using a PHP array
****************************/

require('fpdm.php');

$fields = array(
	'nom'    => 'M\'hamed',
	'prenom'    => 'Erraji',
   'check' => true,
);

$pdf = new FPDM('bulletin_c.pdf');
$pdf->Load($fields, false); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
$pdf->Merge();
$pdf->Output("D",'bulletin_export.pdf');

?>
