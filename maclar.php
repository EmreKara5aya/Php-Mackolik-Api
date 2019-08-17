<?php
header('Content-Type: application/json');
if ($_GET['kod'] == "") {
	 $uyari['hata'] = 'Lütfen İddia Kodunu Giriniz.';
 	die(json_encode($uyari));
 }
 if ($_GET['tarih'] == "") {
 	$uyari['hata'] = 'Lütfen Tarihi Giriniz.';
 	die(json_encode($uyari));
 }
$kod = $_GET['kod'];
$date=explode("/",$_GET['tarih']);
if(checkdate ($date[1] ,$date[0] ,$date[2]))
{
    $tarih = $_GET['tarih'];
}
else 
{
 	$uyari['hata'] = 'Lütfen Tarihi Giriniz.';
 	die(json_encode($uyari));
}
//Thanks Iván Rodríguez Torres Link : https://stackoverflow.com/a/34785508
function array_search_multidim($array, $column, $key){
    return (array_search($key, array_column($array, $column)));
}
function maclar($iddiakod, $tarih)
{
$veri = file_get_contents("http://goapi.mackolik.com/livedata?date=" .$tarih);
$dizi = json_decode($veri, true);
$emre = array_search_multidim($dizi['m'], 14, $iddiakod);
$json = json_encode($dizi['m'][$emre]);
print_r($json);
}
maclar($kod, $tarih);
?>
