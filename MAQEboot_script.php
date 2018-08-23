<?php

	function calDirection($rad)
	{
		$facing = "";

		if ($rad > 360|| $rad < -360) { $rad = $rad/5; }

		if ($rad == 0 ) { $facing = "N"; }
		elseif ($rad == 90) { $facing = "E"; }
		elseif ($rad == -90) { $facing = "W"; }
		elseif ($rad == 180 || $rad == -180) { $facing = "S"; }
		elseif ($rad == 270) { $facing = "W"; }
		elseif ($rad == -270) { $facing = "E"; }
		elseif ($rad == 360 || $rad == -360) { $facing = "N"; }

		return $facing;
	}

	function calRaduisAndDistance($line)
	{
		$rad = 0;
		$X = 0;
		$Y = 0;
		$direction = "N"; // initial direction facing

		for($i=0; $i<strlen($line); $i++)
		{
			/////// Find Raduis ////////
			if ($line[$i] == "R") 		{ 	$rad += 90; 	}
			elseif ($line[$i] == "L") 	{  	$rad -= 90; 	}

			$direction = calDirection($rad); // latest current direction

			/////// Find Position //////
			if ($line[$i] == "W") {
				$distanceStr = "";	// initial distance string
				$distanceNum = 0; 	// initial distance number
				$find_str_number = 0;

				for($j = $i+1; $j < strlen($line); $j++) {

					$find_str_number = strpos("0123456789",$line[$j]);

					if(gettype($find_str_number) == "integer") {
						$distanceStr .= $line[$j];
					}
					else {
						$i = $j-1;
						break;
					}
				}
				$distanceNum = intval($distanceStr);

				///////// Start Walking ///////////
				if($direction == "N") { $Y += $distanceNum; }
				elseif($direction == "E") { $X += $distanceNum; }
				elseif($direction == "S") { $Y -= $distanceNum; }
				elseif($direction == "W") { $X -= $distanceNum; }
			}
		}
		echo "X: ".$X." Y: ".$Y." Direction: ".$direction."\n";
	}
	
	calRaduisAndDistance($argv[1]);

?>
