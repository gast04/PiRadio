
<html>
<body>

<p> Sie hoeren:</p>
<?php
	print_radio();
?>
<p> Online Radio by Kurt Nistelberger</p>

<?php
$post_start = $_POST["start"];
$post_stop = $_POST["stop"];
$post_laut = $_POST["laut"];
$post_sender = $_POST["radio_sender"];
$post_change = $_POST["sender"];

$post_alarm = $_POST["alarm"];
$post_hour = $_POST["hour"];
$post_min = $_POST["min"];

echo "start: " . $post_start . " </br> stop: " . $post_stop . " </br> volume: " . $post_laut . " </br> sender: " . $post_sender . " </br> senderbtn: " . $post_change;
echo "alarm: " . $post_alarm . " </br> hour: " . $post_hour . " </br> min: " . $post_min . " </br> ";

echo "</br>";

if(strcmp($post_stop, "stop") == 0){
	stop_radio();
	echo "Radio stop";
}

if(strcmp($post_start, "start") == 0){
	start_radio();
    echo "Radio start";
}

if($post_laut != 0)
{

	if($post_laut > 100){
		$post_laut = 100;
	}

	if($post_laut < 0){
		$post_laut = 0;
	}

    set_volume($post_laut);

	echo "Lautstaerke auf " . $post_laut . " geaendert.";
}

if($post_sender != 0 && strcmp($post_change,"sender aendern") == 0 )
{
	change_sender($post_sender);
	echo "Sender wurde geaendert";
}

if(strcmp($post_alarm,"alarm") == 0){

  echo "Stunde: " . $post_hour;
  echo "Minute: " . $post_min;  


  $send_string = "./mybash.sh {$post_hour}  {$post_min} 1";
  echo "</br>";
  echo "$send_string";

  shell_exec($send_string);
  
}

?>

<form action = "radioMain.php" method = "post">
	<p>
	<input name="start" type ="submit" value = "start"  style="height:60px; width:60px;"/>
	<input name="stop" type ="submit" value = "stop" left= "10px;" style="height:60px; width:60px;"/>
	</p>
	<p>
    <input name ="laut" value = "0" /> 
	<input type ="submit" value="Lautstaerke aendern"/> (0-100%)
	</p>
<form/>

</body>
</html>

<?php
$output = shell_exec('mpc playlist');

$your_array = explode("\n", $output);
echo "</br>";
$array_count = sizeof($your_array);

echo '<form action = "radioMain.php" method = "post">';
echo '<select name="radio_sender" >'; 

for($i = 0; $i < $array_count-1;$i++)
{
	$id = $i+1;
	 echo '<option value="' . $id . '">' . $your_array[$i] . '</option>'; 
}
/*
foreach($your_array as $cityid=>$city) { 
 echo '<option value="' . $cityid . '">' . $city . '</option>'; 
}*/

echo '</select>'; 
echo '<input type="submit" name="sender" value="sender aendern"';
echo '<form/>';

?>

<p>

Wecker setzen:

<form action = "radioMain.php" method = "post">
	<p>
	
    <input name ="hour" value = "6" /> Stunde
    <input name ="min" value = "10" /> Minute

	<input name="alarm" type ="submit" value = "alarm"  style="height:60px; width:60px;"/>
	</p>
<form/>

</p>
	
<?php
function start_radio(){
   shell_exec('mpc play 1');
}

function stop_radio(){
   shell_exec('mpc stop');	
}

function set_volume($volume){
	$send_string = "mpc volume {$volume}";
	$output = shell_exec($send_string);
}

function change_sender($post_sender){
	$send_string = "mpc play {$post_sender}";
	shell_exec($send_string);
}

function print_information(){
	$output = shell_exec('mpc');
	echo "<pre>$output</pre>";
}

function print_radio(){
	$output = shell_exec('mpc current');
	echo "<pre>$output</pre>";
}

?>
