<html>
<head>
<title>PHP Get Value of Select Option and Radio Button</title> <!-- Include CSS File Here-->
</head>
<body>
<div class="container">
<div class="main">
<h2>PHP Multiple Select Options and Radio Buttons</h2>
<form action="testbuttom.php" method="post">
<!----- Select Option Fields Starts Here --- -->
<label class="heading">To Select Multiple Options Press ctrl+left click :</label>
<select multiple name="Color[]">
<option value="Red">Red</option>
<option value="Green">Green</option>
<option value="Blue">Blue</option>
<option value="Pink">Pink</option>
<option value="Yellow">Yellow</option>
<option value="White">White</option>
<option value="Black">Black</option>
<option value="Violet">Violet</option>
<option value="Limegreen">Limegreen</option>
<option value="Brown">Brown</option>
<option value="Orange">Orange</option>
</select>


<!---- Radio Button Starts Here --- -->
<label class="heading">Radio Buttons :</label>
<input name="radio" type="radio" value="Radio 1">Radio 1
<input name="radio" type="radio" value="Radio 2">Radio 2
<input name="radio" type="radio" value="Radio 3">Radio 3
<input name="radio" type="radio" value="Radio 4">Radio 4



<input name="submit" type="submit" value="Get Selected Values">
</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
if(!empty($_POST['Color'])) {
echo "<span>You have selected :</span><br/>";
// As output of $_POST['Color'] is an array we have to use Foreach Loop to display individual value
foreach ($_POST['Color'] as $select)
{
echo "<span><b>".$select."</b></span><br/>";
}
}
else { echo "<span>Please Select Atleast One Color.</span><br/>";}
}
?>
<?php
if (isset($_POST['submit'])) {
if(isset($_POST['radio']))
{
echo "<span>You have selected :<b> ".$_POST['radio']."</b></span>";
}
else{ echo "<span>Please choose any radio button.</span>";}
}
?>
