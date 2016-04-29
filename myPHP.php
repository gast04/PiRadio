<html>
<body>

<label for="Manufacturer"> Manufacturer : </label>
  <select id="cmbMake" name="Make" >
     <option value="0">Select Manufacturer</option>
     <option value="1">--Any--</option>
     <option value="2">Toyota</option>
     <option value="3">Nissan</option>
  </select>

<?php
/* Array contents */
$array2 = array('Radio Steiermark','Kronehit','Antenne'); 
 
echo '<select name="cities">'; 
 
/* For each key of the array assign variable name "cityid" */
/* For each value of the array assign variable name "city" */
 
foreach($array2 as $cityid=>$city) { 
 echo '<option value="' . $cityid . '">' . $city . '</option>'; 
} 
echo '</select>'; 
?>

</body>
</html>