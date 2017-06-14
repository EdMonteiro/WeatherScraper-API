<?php
// include("main.php");

	$weather = "";
	$error = "";
	
	if (array_key_exists('city', $_GET)) {
		
		$city = str_replace(' ', '', $_GET['city']);
		
		$file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		
		
		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
	
			$error = "That city could not be found.";

		} else {
		
		$forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		
		$pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);
			
		if (sizeof($pageArray) > 1) {
		
			$secondPageArray = explode('</span></span></span>', $pageArray[1]);
			
			if (sizeof($secondPageArray) > 1) {

				$weather = $secondPageArray[0];
					
			} else {
			
				$error = "That city could not be found.";
					
			}
			
			} else {
			
				$error = "That city could not be found.";
			
			}
		
		}
		
	}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Weather Scrapper app</title>

	<!--Jquery-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="/css/style.css">

  </head>
  <body>
	<div class="container">
		<h1>What's the Weather?</h1>

		<form>
			<div class="form-group">
				<label for="location">Enter the name of a City.</label>
				<input type="text" class="form-control" id="location" placeholder="Location" name="city"> 
				<button type="submit" class="btn btn-default">Submit</button>

				
			</div>
			
			<!--get the line of PHP displaying the weather forecast here!-->
			<div id="weather">
				<?php
					if ($weather) {
					
						echo '<div class="alert alert-success" role="alert"> '.$weather.'</div>';
					
					}else if ($error) {
					
						echo '<div class="alert alert-danger" role="alert"> '.$error.' </div>';
					
					}
				?>
				</div>
			</div>
			
		</form>
	</div>
	

  </body>
</html>