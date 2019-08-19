<?php
if($_GET['tarih'] == "") {
    $uyari = 'Lütfen Tarihi Giriniz.';
    die($uyari);
}
$date=explode("/",$_GET['tarih']);
if(checkdate ($date[1] ,$date[0] ,$date[2]))
{
    $tarih = $_GET['tarih'];
}
else 
{
    $uyari = 'Lütfen Tarihi Giriniz.';
    die($uyari);
}
$veri = file_get_contents("http://goapi.mackolik.com/livedata?date=" .$tarih);
$dizi = json_decode($veri, true);
$maclar = $dizi['m'];
$v = "0";
$sayi = count($maclar);
    for ($i=0; $i<$sayi; $i++)
      {
        if (empty($maclar[$i][6]) || $maclar[$i][6] == "MS")
        {
            unset($maclar[$i]);
        }
        else
        {
            $mac[$v] = $maclar[$i];
            $v++;
        }

      }
$sayi1 = count($mac);
echo "<h2>Canlı Maç Sonuçları</h2>
<table style=\"width:100%\">
  <tr>
    <th>İddia Kodu</th>
    <th>Dakika</th> 
    <th>Ev Sahibi</th>
    <th>Deplasman</th>
    <th>Skor</th>
  </tr>";
       for ($i=0; $i<$sayi1; $i++)
      {
        echo "<tr>";
        echo "<td>" .$mac[$i][14]. "</td>";
        echo "<td>" .$mac[$i][6]. "</td>";
        echo "<td>" .$mac[$i][2]. "</td>";
        echo "<td>" .$mac[$i][4]. "</td>";
        echo "<td>" .$mac[$i][12]. " - " .$mac[$i][13]. "</td>";
        echo "</tr>";
      }
?>
