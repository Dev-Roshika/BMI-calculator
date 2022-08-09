<?php include 'header.php'; ?>

<?php
	$errh = $errw = "";
	$height = $weight = $heightUnit = "";
	$bmipass = "";

	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(empty($_POST['height'])){
			$errh = "<span style = 'color:#ed4337;
			font-size:14px;display:block'>
			Height is required</span>";
		} else{
			$height = validation($_POST['height']);
		}

		if(empty($_POST['weight'])){
			$errw = "<span style = 'color:#ed4337;
			font-size:14px;display:block'>
			Weight is required</span>";
		} else{
			$weight = validation($_POST['weight']);
		}

		if(!empty($_POST['heightUnit'])){
			$heightUnit = $_POST['heightUnit'];
		}

		if(empty($_POST['height'] && $_POST['weight'])){
			echo  "";
		} else{

			if($heightUnit == "cm"){
				$height = $height * 0.01;
			}
			if($heightUnit == "inch"){
				$height = $height * 0.0254;
			}

			$bmi = ($weight / ($height * $height));
			$bmipass = $bmi;
		}
	}

function validation($data)	{
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<form method="POST" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div class="leftbar">
            <div class="section01">
                <span>Weight: </span>    
                <input type="text" id = "WeightID" class = "input-group" name= "weight">Kg<?php echo $errw;?>
            </div>
            <div class="section02">
                <span>Height: </span>    
                <input type="text" id = "HeightID" class = "input-group" name = "height" >
                <select autofocus id = "units" name = "heightUnit">
                    <option value="cm">cm</option>
                    <option value="m" selected>m</option>
                    <option value="inch">inch</option>
                </select>
				<?php echo $errh;?>
            </div>
            <div class="section_submit">
                <input type="submit" value= "Calculate BMI" ID = "Bt" name = "submit">
            </div>        
        </form>
	

<?php
	error_reporting(0);
		if(isset($_POST['submit']))	{
			echo "<span class = 'text'>Your Body Mass Index is&nbsp;"."<span style = 'color:red;'>".number_format($bmipass,2)."</span>. " . "This is considered&nbsp;<span style = 'color:red;'>";
			if ($bmipass < 18.5) {
				 echo "under weight";
			} elseif ($bmipass < 24.9 && $bmipass >= 18.5) {
				echo "normal";
			} elseif ($bmipass < 29.9 && $bmipass >= 25) {
				echo "Overweight";
			} elseif($bmipass <34.9 && $bmipass >=30) {
				echo "Obese";
			} elseif($bmipass >35) {
				echo "Extremely Obese";
			}
		} else	{
			echo  "";
		}
		echo "</span>.</span>";
?>		

<?php include 'footer.php'; ?>
