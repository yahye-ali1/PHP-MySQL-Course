<?php

/*
========================================================
PHP & MySQL - Assignment 2
All 5 Questions in One File
========================================================
*/


/*
========================================================
QUESTION 1
One-Dimensional Array
========================================================
*/

echo "<h1>PHP Assignment 2</h1>";

echo "<hr>";
echo "<h2>Question 1</h2>";

$numbers = [5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9];


// Print all elements
echo "<h3>All Array Elements</h3>";

foreach ($numbers as $number) {
    echo $number . " ";
}

echo "<br><br>";


// Total of all elements
$total = array_sum($numbers);

echo "Total of all elements: " . $total . "<br>";


// Total of even elements
$evenTotal = 0;

foreach ($numbers as $number) {

    if ($number % 2 == 0) {
        $evenTotal += $number;
    }

}

echo "Total of even elements: " . $evenTotal . "<br>";


// Total of odd elements
$oddTotal = 0;

foreach ($numbers as $number) {

    if ($number % 2 != 0) {
        $oddTotal += $number;
    }

}

echo "Total of odd elements: " . $oddTotal . "<br>";


// Minimum element and positions
$min = min($numbers);
$minPositions = [];

foreach ($numbers as $index => $number) {

    if ($number == $min) {
        $minPositions[] = $index;
    }

}

echo "Minimum element: " . $min . "<br>";
echo "Minimum positions: " . implode(", ", $minPositions) . "<br>";


// Maximum element and positions
$max = max($numbers);
$maxPositions = [];

foreach ($numbers as $index => $number) {

    if ($number == $max) {
        $maxPositions[] = $index;
    }

}

echo "Maximum element: " . $max . "<br>";
echo "Maximum positions: " . implode(", ", $maxPositions) . "<br>";



/*
========================================================
QUESTION 2
Two-Dimensional Associative Array
========================================================
*/

echo "<hr>";
echo "<h2>Question 2</h2>";

$colors = [

    "Light" => [
        "Red" => "Light Red",
        "Green" => "Light Green",
        "Blue" => "Light Blue"
    ],

    "Normal" => [
        "Red" => "Normal Red",
        "Green" => "Normal Green",
        "Blue" => "Normal Blue"
    ],

    "Dark" => [
        "Red" => "Dark Red",
        "Green" => "Dark Green",
        "Blue" => "Dark Blue"
    ]

];


echo "<table border='1' cellpadding='10' cellspacing='0'>";

echo "<tr>";
echo "<th></th>";
echo "<th>Red</th>";
echo "<th>Green</th>";
echo "<th>Blue</th>";
echo "</tr>";


foreach ($colors as $rowName => $row) {

    echo "<tr>";

    echo "<th>" . $rowName . "</th>";

    foreach ($row as $value) {

        echo "<td>" . $value . "</td>";

    }

    echo "</tr>";

}

echo "</table>";



/*
========================================================
QUESTION 3
Square Two-Dimensional Array
========================================================
*/

echo "<hr>";
echo "<h2>Question 3</h2>";


$array = [

    [2, -6, 8],

    [-6, 1, 6],

    [7, 8, -6]

];


// Print all elements

echo "<h3>All Array Elements</h3>";

echo "<table border='1' cellpadding='10' cellspacing='0'>";

foreach ($array as $row) {

    echo "<tr>";

    foreach ($row as $value) {

        echo "<td>" . $value . "</td>";

    }

    echo "</tr>";

}

echo "</table>";


// Total of odd elements

$oddTotal = 0;

foreach ($array as $row) {

    foreach ($row as $value) {

        if ($value % 2 != 0) {

            $oddTotal += $value;

        }

    }

}

echo "<br>";
echo "Total of odd elements: " . $oddTotal . "<br>";


// Total of even elements

$evenTotal = 0;

foreach ($array as $row) {

    foreach ($row as $value) {

        if ($value % 2 == 0) {

            $evenTotal += $value;

        }

    }

}

echo "Total of even elements: " . $evenTotal . "<br>";


// Total of each row

echo "<h3>Total of Each Row</h3>";

foreach ($array as $index => $row) {

    $rowTotal = array_sum($row);

    echo "Row " . ($index + 1) . " Total: " . $rowTotal . "<br>";

}


// Total of each column

echo "<h3>Total of Each Column</h3>";

$columns = count($array[0]);

for ($column = 0; $column < $columns; $column++) {

    $columnTotal = 0;

    foreach ($array as $row) {

        $columnTotal += $row[$column];

    }

    echo "Column " . ($column + 1) . " Total: " . $columnTotal . "<br>";

}


// Total of each diagonal

$size = count($array);


// Main diagonal

$mainDiagonal = 0;

for ($i = 0; $i < $size; $i++) {

    $mainDiagonal += $array[$i][$i];

}


// Second diagonal

$secondDiagonal = 0;

for ($i = 0; $i < $size; $i++) {

    $secondDiagonal += $array[$i][$size - 1 - $i];

}


echo "<h3>Diagonal Totals</h3>";

echo "Main diagonal total: " . $mainDiagonal . "<br>";

echo "Second diagonal total: " . $secondDiagonal . "<br>";


// Total of all elements

$grandTotal = 0;

foreach ($array as $row) {

    foreach ($row as $value) {

        $grandTotal += $value;

    }

}

echo "<br>";
echo "Total of all elements: " . $grandTotal . "<br>";


// Minimum element and positions

$min = $array[0][0];

$minPositions = [];

foreach ($array as $rowIndex => $row) {

    foreach ($row as $columnIndex => $value) {

        if ($value < $min) {

            $min = $value;

            $minPositions = [
                [$rowIndex + 1, $columnIndex + 1]
            ];

        } elseif ($value == $min) {

            $minPositions[] = [
                $rowIndex + 1,
                $columnIndex + 1
            ];

        }

    }

}


echo "<br>";
echo "Minimum element: " . $min . "<br>";

echo "Minimum positions: ";

foreach ($minPositions as $position) {

    echo "(Row " . $position[0] .
         ", Column " . $position[1] . ") ";

}

echo "<br>";


// Maximum element and positions

$max = $array[0][0];

$maxPositions = [];

foreach ($array as $rowIndex => $row) {

    foreach ($row as $columnIndex => $value) {

        if ($value > $max) {

            $max = $value;

            $maxPositions = [
                [$rowIndex + 1, $columnIndex + 1]
            ];

        } elseif ($value == $max) {

            $maxPositions[] = [
                $rowIndex + 1,
                $columnIndex + 1
            ];

        }

    }

}


echo "Maximum element: " . $max . "<br>";

echo "Maximum positions: ";

foreach ($maxPositions as $position) {

    echo "(Row " . $position[0] .
         ", Column " . $position[1] . ") ";

}

echo "<br>";



/*
========================================================
QUESTION 4
Two-Dimensional Associative Array
Student Information
========================================================
*/

echo "<hr>";
echo "<h2>Question 4</h2>";


$students = [

    "CA221" => [
        "Name" => "Mohamed Ahmed Ali",
        "Phone" => "0648440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ],

    "CA223" => [
        "Name" => "Ahmed Abdi Jama",
        "Phone" => "0647223201",
        "Address" => "Taleex, Hodan"
    ],

    "CA221_2" => [
        "Name" => "Amina Nur Adan",
        "Phone" => "0646990276",
        "Address" => "Macmacaanka, Dharkeynley"
    ]

];


echo "<table border='1' cellpadding='10' cellspacing='0'>";


echo "<tr>";

echo "<th></th>";
echo "<th>Name</th>";
echo "<th>Phone</th>";
echo "<th>Address</th>";

echo "</tr>";


foreach ($students as $id => $student) {

    echo "<tr>";

    echo "<td>" . str_replace("_2", "", $id) . "</td>";

    echo "<td>" . $student["Name"] . "</td>";

    echo "<td>" . $student["Phone"] . "</td>";

    echo "<td>" . $student["Address"] . "</td>";

    echo "</tr>";

}

echo "</table>";



/*
========================================================
QUESTION 5
Student Transcript
========================================================
*/

echo "<hr>";
echo "<h2>Question 5 - Student Transcript</h2>";


$transcript = [

    "Semester 1" => [

        "subject1" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ],

        "subject2" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ],

        "subject3" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ]

    ],


    "Semester 2" => [

        "subject1" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 0,
            "Total" => 45,
            "Status" => "Fail"
        ],

        "subject2" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ],

        "subject3" => [
            "CW1" => 9,
            "MidTerm" => 26,
            "CW2" => 10,
            "Final" => 40,
            "Total" => 85,
            "Status" => "Pass"
        ]

    ]

];


echo "<table border='1' cellpadding='10' cellspacing='0'>";


echo "<tr>";

echo "<th>Semester</th>";
echo "<th>Course</th>";
echo "<th>CW1</th>";
echo "<th>MidTerm</th>";
echo "<th>CW2</th>";
echo "<th>Final</th>";
echo "<th>Total</th>";
echo "<th>Status</th>";

echo "</tr>";


foreach ($transcript as $semester => $courses) {

    foreach ($courses as $course => $data) {

        echo "<tr>";

        echo "<td>" . $semester . "</td>";

        echo "<td>" . $course . "</td>";

        echo "<td>" . $data["CW1"] . "</td>";

        echo "<td>" . $data["MidTerm"] . "</td>";

        echo "<td>" . $data["CW2"] . "</td>";

        echo "<td>" . $data["Final"] . "</td>";

        echo "<td>" . $data["Total"] . "</td>";

        echo "<td>" . $data["Status"] . "</td>";

        echo "</tr>";

    }

}


echo "</table>";


echo "<hr>";

echo "<h3>End of Assignment</h3>";

?>