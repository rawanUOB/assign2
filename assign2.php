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

<!DOCTYPE html>
<html lang="en">
<html>
    <body>
        <table>
            <!-- Table Header -->
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The programs</th>
                    <th>Nationality</th>
                    <th>Colleges</th> 
                    <th>No. of Students</th>
                </tr>
            </thead>
            <!-- Table Content -->
            <tbody>
                <?php
                    #a  loop to go through the JSON file and print the data
                    foreach ($data as $student) { 
                        echo "<tr>"; 
                        echo "<td>", htmlspecialchars($student["year"]), "</td>"; 
                        echo "<td>", htmlspecialchars($student["semester"]), "</td>" ;
                        echo "<td>", htmlspecialchars($student["the_programs"]), "</td>" ;
                        echo "<td>", htmlspecialchars($student["nationality"]), "</td>" ;
                        echo "<td>", htmlspecialchars($student["colleges"]), "</td>"; 
                        echo "<td>", htmlspecialchars($student["number_of_students"]), "</td>" ;
                        echo "</tr>"; 
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>