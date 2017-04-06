<html>
<head>
  <meta charset="utf-8"/>
  <titre> Regularite mensuelle TER </titre>
</head>
<body>
<table>
<?php
if (array_key_exists("seuil",$_GET)){
	$seuil=floatval($_GET["seuil"]);
} else {
	$seuil=85.0;
}
if (array_key_exists("region",$_GET)){
	$region=$_GET["region"];
} else{
	$region= NULL;
}


$f = fopen("regularite-mensuelle-ter.csv", "r");
$entete = fgetcsv($f, 0, ";");
$cols=array(0,1,2,7,3,4,5);
echo "<tr>";
for ($i =0; $i< count($cols); $i++){
	echo "<th>", $entete[$cols[$i]], "</th>";
}
echo "</tr>\n";

while($ligne=fgetcsv($f,0,";")){
	$taux_de_regularite=floatval($ligne[7]);
	$reg =$ligne[2];
	$trains_programmes = $ligne[3];

	if ($taux_de_regularite >= $seuil){
		continue;
}
	
	if ($region && $reg !=$region){
		continue;
}

	if ($trains && $trains_programmes < $trains){
		continue;
    }
    if (! $taux_de_regularite) {
        continue;
    }
		
	echo "<tr>";
	for ($i =0; $i< count($cols); $i++){
		echo "<td>", $ligne[$cols[$i]], "</td>";
	}

	echo "</tr>\n";
}
?>
</table>
</body>
</html>
