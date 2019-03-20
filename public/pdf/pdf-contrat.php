<?php
if(!isset($_GET['d']) || $_GET['d'] == "" || !isset($_GET['f']) || $_GET['f'] == "") {
   echo "Server Error";
   exit();
}
$paramFicheId = $_GET['f'];
$paramDevisId = $_GET['d'];
//header('Content-Type: text/plain');
function url() {
   if(isset($_SERVER['HTTPS'])) {
      $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
   } else {
      $protocol = 'http';
   }
   return $protocol . "://" . $_SERVER['HTTP_HOST'] . '/';
}

function getJson($url) {
   $json = file_get_contents($url);
   $data = json_decode($json, false, 512, JSON_UNESCAPED_UNICODE);
   $data = (array)$data;
   foreach($data as $key => $value) {
      if(empty($value)) {
         $data[$key] = ' ';
      }
   }
   return $data;
}

$url = url();
//pdftk file.pdf to file_c.pdf
$data = getJson($url . 'api/get-pdf-data/f-' . $paramFicheId . '/d-' . $paramDevisId);
//var_dump($data);

require('fpdm.php');
//$fields = $INITIAL_PLUS;
//$pdf = new FPDM('compagnies/' . $compagnie["nom"] . '/' . $gamme["nom"] . '/' . $gamme["nom"] . '_C.pdf');
$pdf = new FPDM('compagnies/' . $data["compagnie_nom"] . '/' . $data["gamme_nom"] . '/' . $data["gamme_nom"] . '.pdf');
$fileName = time() . '_' . $data["prospect_nom"] . '_' . $data['prospect_prenom'] . '_' . $data["gamme_nom"] . '.pdf';
unset($data['compagnie_nom']);
unset($data['compagnie_id']);
unset($data['gamme_id']);
unset($data['gamme_nom']);
unset($data['formule_id']);
unset($data['formule_nom']);
//var_dump($data);
$pdf->Load($data, true); // second parameter: false if field values are in ISO-8859-1, true if UTF-8
$pdf->Merge();
$pdf->Output('D', $fileName);

?>
