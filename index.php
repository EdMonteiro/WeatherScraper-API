<?php
// include("main.php");

	$weather = "";
	$error = "";

	if ($_GET['city']) {
        
		$urlContents = file_get_contents("http://samples.openweathermap.org/data/2.5/weather?q=".$_GET['city'].",uk&appid=68a3bf2dab736a3631c4d3e9682d957b");
        
        $weatherArray = json_decode($urlContents, true);
        
        if ($weatherArray['cod'] == 200) {
        
            $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

            $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";
            
        } else {
            
            $error = "Could not find city - please try again.";
            
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