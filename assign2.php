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
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Bahrain -  Students details </title>
    <!-- Include Pico CSS for styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1.5.7/css/pico.min.css">

    </head>
    <body>
        <main class="container">
        <h1>University of Bahrain - IT Bachelor Students</h1>
        <p>This table displays enrollment statistics by nationality</p>

        <table class="striped">
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
                       // Loop through each record and display it in the table
                       foreach ($data as $record) {
                           // Safeguard against missing fields using the null coalescing operator (??)
                           $year = $record["record"]["year"] ?? "N/A";
                           $semester = $record["record"]["semester"] ?? "N/A";
                           $program = $record["record"]["the_programs"] ?? "N/A";
                           $nationality = $record["record"]["nationality"] ?? "N/A";
                           $college = $record["record"]["colleges"] ?? "N/A";
                           $num_students = $record["record"]["number_of_students"] ?? "N/A";
       
                           echo "<tr>";
                           echo "<td>" . htmlspecialchars($year) . "</td>";
                           echo "<td>" . htmlspecialchars($semester) . "</td>";
                           echo "<td>" . htmlspecialchars($program) . "</td>";
                           echo "<td>" . htmlspecialchars($nationality) . "</td>";
                           echo "<td>" . htmlspecialchars($college) . "</td>";
                           echo "<td>" . htmlspecialchars($num_students) . "</td>";
                           echo "</tr>";
                       }
                       
       
                ?>
            </tbody>
        </table>
                </main>
    </body>
</html>