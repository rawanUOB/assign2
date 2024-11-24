<?php

#Defining the API

$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100"; 

#Fetching the data 

$response = file_get_contents($URL);
$result = json_decode($response, true);

if (!$result || !isset($result["results"]) ) {
    die('an error occured while fetching the data from the API! ');
}

$data = $result["results"]; 

?>
