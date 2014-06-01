<?php


$api_key = "6qvrmbehyspcu57hma2q222z";
$url = "http://api.rottentomatoes.com/api/public/v1.0/movies.json";

function searchMovies($query){
    if(isset($query) && $query != ''){

        global $url, $api_key;

        $curl_session = curl_init($url."?apikey=".$api_key."&q=".urlencode($query));
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl_session);
        curl_close($curl_session);      

        $search_results = json_decode($data);

        return $search_results->movies;  
    }
}

function printMovies($movies){
    $html = '';
    if(isset($movies) && count($movies)){
        foreach($movies as $movie){
            $html .= '<div class="row">'
                . '<div class="columns large-2 medium-2 small-12">'
                . '<img src="'.$movie->posters->detailed.'">'
                . '</div>'
                . '<div class="columns large-10 medium-10 small-12">'
                . '<h2>'.$movie->title.'</h2>'
                . $movie->year.'<br />'
                . $movie->runtime.' mins'
                . '</div>'
                . '</div>';
        }
        return $html;
    }

}

$red_movies = searchMovies("red");
$green_movies = searchMovies("green");
$yellow_movies = searchMovies("yellow");
$blue_movies = searchMovies("blue");

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <header class="row">
            <div class="columns large-12 small-12"><h1>Klyp Development Test</h1></div>
        </header>
        
        <?php
            echo printMovies($red_movies);
            echo printMovies($green_movies);
            echo printMovies($yellow_movies);
            echo printMovies($blue_movies);
        ?>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:200,300,400,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/main.js"></script>

    </body>
</html>
