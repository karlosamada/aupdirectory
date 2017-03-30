<?php
/* $_distArr = array where distance between two nodes were classified */
$_distArr = array();
$_distArr[1][2] = 7;
$_distArr[1][3] = 9;
$_distArr[1][6] = 14;
$_distArr[2][1] = 7;
$_distArr[2][3] = 10;
$_distArr[2][4] = 15;
$_distArr[3][1] = 9;
$_distArr[3][2] = 10;
$_distArr[3][4] = 11;
$_distArr[3][6] = 2;
$_distArr[4][2] = 15;
$_distArr[4][3] = 11;
$_distArr[4][5] = 6;
$_distArr[5][4] = 6;
$_distArr[5][6] = 9;
$_distArr[6][1] = 14;
$_distArr[6][3] = 2;
$_distArr[6][5] = 9;

//the start and the end
$a = $_POST['source'];
$b = $_POST['destination'];
//$a = 1; //starting node
//$b = 5; //end node

//initialize the array for storing
$S = array(); //the nearest path with its parent and weight
$Q = array(); //the left nodes without the nearest path
foreach(array_keys($_distArr) as $val) $Q[$val] = 99999;
$Q[$a] = 0;

//start calculating
while(!empty($Q)){
    $min = array_search(min($Q), $Q);//the most min weight
    if($min == $b) break;
    foreach($_distArr[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
        $Q[$key] = $Q[$min] + $val;
        $S[$key] = array($min, $Q[$key]);
    }
    unset($Q[$min]);
}

//list the path
$path = array();
$pos = $b;
while($pos != $a){
    $path[] = $pos;
    $pos = $S[$pos][0];
}
$path[] = $a;
$path = array_reverse($path);

//$destination = $b;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Adventist University of the Philippines</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <link href="materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
</head>
<body>
        
    <div id="mapid" style="width: 100%; height: 400px;"></div>
        
    <script type="text/javascript">

    var mymap = L.map('mapid').setView([14.2160, 121.0392], 15.5); //entering the center of the map

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    id: 'mapbox.streets'
    }).addTo(mymap);

    var path = <?php echo json_encode($path); ?>;
    var count;
    var num = path.length;

    document.write("Starting Loop" + "<br />");

    var marker = L.marker([14.2160, 121.0392]).addTo(mymap); //marker

    for(count = 0; count < num - 1; count++){

        var node = path[count] + '' + path[count + 1];

        switch(node){
            case "13":
            document.write("13");
            var polygon = L.polygon([[14.2160, 121.0392],[14.2160, 121.1000]]).addTo(mymap);
            break;

            case "36":
            document.write("36");
            var polygon = L.polygon([[14.2160, 121.1000]]).addTo(mymap);
            break;

            case "65":
            document.write("65");
            var polygon = L.polygon([[14.2160, 121.0385]]).addTo(mymap);
            break;
        }
        document.write("<br />");
    }

    document.write("Loop stopped!");
    </script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="materialize/js/materialize.js"></script>
  <script src="materialize/js/init.js"></script>
    
</body>
</html>
