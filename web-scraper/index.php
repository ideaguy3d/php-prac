<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/5/2017
 * Time: 8:12 PM
 */

// echo file_get_contents('https://www.ecowebhosting.co.uk');

$weather = ''; $error = ''; $city = ''; $exists = '';


if (array_key_exists('city', $_GET)) {
    $city = str_replace(" ", "", $_GET['city']);
    $urlWeather = 'http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest';
    $file_headers = @get_headers($urlWeather);

    if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $exists = false;
        $error = 'City not found';
    } else {
        $forecastPage = file_get_contents($urlWeather);

        $page1Array = explode(
            '3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',
            $forecastPage
        );

        if(sizeof($page1Array) > 1) {
            $page2Array = explode('</span></span></span>', $page1Array[1]);

            if(sizeof($page2Array) > 1) {
                $weather = $page2Array[0];
            } else {
                $error = 'There was a scraping error. Please contact the developer.';
            }

        } else {
            $error = 'There was a scraping error. Please contact the developer.';
        }
    }

}

?> <!-- END OF: php block -->


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>www.julius3d.com</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- quick styling -->
    <style>
        div.j-contain {
            width: 100%;
            background: url(./mountain.jpg) no-repeat;
            background-position: top;
            background-size: cover;
            min-height: 640px;
        }

        footer {
            background-color: #ececec;
            padding-top: 16px;
        }

        @media screen and (max-height: 500px ) {
            div.j-contain {
                height: 320px;
            }
        }

        .j-center {
            text-align: center;
            padding-top: 10%;
        }

        .j-center-block {
            text-align: center;
        }

        .j-light-font {
            color: whitesmoke;
        }

        body {
            background: none;
        }

        .btn {
            cursor: pointer;
        }

        .j-w550 {
            width: 650px;
            margin:auto;
        }
    </style>
</head>


<body>

<div class="j-contain j-light-font">
    <div class="container j-center-block">
        <div class="j-w550 ">
            <h1 class="j-center">What's the Weather in your city?</h1>
            <br>
            <div class="j-center-block">
                <form>
                    <fieldset class="form-group">
                        <label for="city"></label>
                        <input type="text" class="form-control" id="city" name="city"
                               placeholder="e.g. San Jose, San Francisco, Palo Alto..."
                                value="<?php if(array_key_exists('city', $_GET)) { echo $_GET['city']; } ?>">
                    </fieldset>

                    <button type="submit" class="btn btn-lg btn-info">Check it!</button>
                </form>
            </div>

            <br>

            <!-- weather output -->
            <div id="weather">
                <?php
                if ($weather) {
                    echo '<h4><strong>'.$city.
                        '</strong> </h4><div class="alert alert-success" role="alert">
                        ' . $weather .
                        '</div>';
                } else if ($error) {
                    echo $error;
                }
                ?>
            </div>
        </div>

    </div>
</div>


<!-- contact us section -->
<?php
include('../form-p1.php');
?>

<br>

<footer class="footer j-center-block">
    <div class="container">
        <h1>Coded w/<3 by:<a href="http://julius3d.com"> Julius Alvarado</a></h1>
        <h2>
            My <a href="https://linkedin.com/in/juliusalvarado">LinkedIn</a>
            & <a href="https://github.com/ideaguy3d">Github</a>
        </h2>
        <span class="text-muted"> &copy; 2017 Julius Alvarado </span>
    </div>
</footer>

<!-- jQuery first, then Tether, then Bootstrap JS. -->
<!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>


<script type="text/javascript">

    (function ($) {
        // javascript code
    }(jQuery));

</script>

</body>
</html>


