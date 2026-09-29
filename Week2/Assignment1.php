<?php
echo "<div style='font-family: Arial; margin: 40px;'>";

                                  // Answer One
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer One</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

// Three integer numbers
$num1 = 25;
$num2 = 30;
$num3 = 35;


echo "<p style='font-size: 18px; color: black;'>
        The numbers are: $num1, $num2, and $num3\n
      </p>";

// Logic to find the Greatest number
if($num1 >= $num2 && $num1 >= $num3){
    $greatest = $num1;
} elseif ($num2 >= $num1 && $num2 >= $num3){
    $greatest = $num2;
}else{
    $greatest = $num3;
}

// Logic to find the Smallest number
if($num1 <= $num2 && $num1 <= $num3){
    $smallest = $num1;
} elseif ($num2 <= $num1 && $num2 <= $num3){
    $smallest = $num2;
}else{
    $smallest = $num3;
}

//Print Result
echo "<br>";
echo"The Greatest number is: $greatest";
echo "<br>";
echo"The Smallest number is: $smallest ";




                                    // Answer Two
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Two</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

// Define the Number to check!
$number = 15;

echo "<p style='font-size: 18px; color: black;'>
        The number is: $number\n
      </p>";


//Chech the condition
if($number % 3 == 0 && $number % 5 == 0){
    echo"The number is divisable by both 3 and 5";
}elseif($number % 3 == 0){
    echo"The number is divisable by 3 Only";
}elseif($number % 5 == 0){
    echo"The number is divisable by 5 Only";
}else{
    echo"The number is not divisable by both 3 and 5";
}




                              // Answer Three
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Three</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";


echo "<p style='font-size: 18px; color: black;'>
        Odd numbers from 2 to 20
      </p>";


// Odd numbers from 2 to 20
for ($i = 2; $i <= 20; $i++) {
    // A number is odd if dividing it by 2 leaves a remainder
    if($i % 2 != 0){
        echo "$i ";
    }
          
}

echo "<p style='font-size: 18px; color: black;'>
        Even numbers from 35 to 7
      </p>";

// Even numbers from 35 to 7
for ($i = 35; $i >= 7; $i--) {
    // A number is even if dividing it by 2 takes a remainder
    if($i % 2 == 0){
        echo "$i ";
    }
          
}




                              // Answer Four
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Four</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Numbers divisable by 2 and 5 from 50 to 2.
      </p>";


// Numbers divisable by 2 and 5 from 50 to 2.
for ($i = 50; $i >= 2; $i--) {
    // A number dividing it by 2 and 5 leaves a remainder
    if($i % 2 == 0 && $i % 5 == 0){
        echo "$i ";
    }
          
}



                              // Answer Five
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Five</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Reverse Number
      </p>";


// Define the number to reverse
$number = 12345; 
$originalNumber = $number; // Keep a backup for the final echo

$reverse = 0;

// Loop until the number becomes 0
while ($number > 0) {
    // 1. Get the last digit of the number
    $lastDigit = $number % 10;
    
    // 2. Append the digit to the reverse number
    $reverse = ($reverse * 10) + $lastDigit;
    
    // 3. Remove the last digit from the number (Integer Division)
    $number = (int)($number / 10);
}

// Print the results
echo "Original number: " . $originalNumber;
echo"<br>";
echo "Reversed number: " . $reverse;



                              // Answer Six
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Six</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Lowest Common Multiplier (LCM)
      </p>";


$num1 = 8;
$num2 = 12;

// 1. Find which number is larger to start our search there
if ($num1 > $num2) {
    $search = $num1;
} else {
    $search = $num2;
}

// 2. Loop until we find a number divisible by both $num1 and $num2
while (true) {
    
    // Check if the current search number leaves 0 remainder for both
    if ($search % $num1 == 0 && $search % $num2 == 0) {
        $lcm = $search;
        break; // We found it! Exit the loop immediately.
    }
    
    // Move up to the next number
    $search++;
}

echo "The LCM of $num1 and $num2 is: " . $lcm;


                              // Answer Seven
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Seven</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Highest Common Factor(HCF)
      </p>";

// Find the HCF
$num1 = 18;
$num2 = 24;

// 1. Find which number is smaller to start our search there
if ($num1 < $num2) {
    $search = $num1;
} else {
    $search = $num2;
}

$hcf = 1; // Default factor for all numbers

// 2. Loop backwards from the smaller number down to 1
for ($i = $search; $i >= 1; $i--) {
    
    // Check if $i divides both numbers perfectly
    if ($num1 % $i == 0 && $num2 % $i == 0) {
        $hcf = $i;
        break; // We found the highest one! Exit the loop immediately.
    }
}

echo "The HCF of $num1 and $num2 is: " . $hcf;


                              // Answer Eight
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Eight</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Multipilication Table
      </p>";

// Multibilicato up to(12 to 12)
echo "<table border='1' cellpadding='10' cellspacing='0'>";

for ($i = 1; $i <= 12; $i++) {
    echo "<tr>";

    for ($j = 1; $j <= 12; $j++) {
        echo "<td>" . ($i * $j) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";


                              // Answer Nine
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Nine</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Prime number
      </p>";

$num = 17;
$count = 0;

for ($i = 1; $i <= $num; $i++) {
    if ($num % $i == 0) {
        $count++;
    }
}

if ($count == 2) {
    echo "$num is a Prime number";
} else {
    echo "$num is a Non-Prime number";
}

                              // Answer Ten
echo "<h2 style = 'color: Blue; font-size: 20px; text-align: center;'> Answer Ten</H2>";
echo "<h2 style = 'color: Black; font-size: 15px; text-align: center;'>==============</H2>";

echo "<p style='font-size: 18px; color: black;'>
        Prime numbers from 10 to 50
      </p>";


for ($num = 10; $num <= 50; $num++) {
    $count = 0;

    for ($i = 1; $i <= $num; $i++) {
        if ($num % $i == 0) {
            $count++;
        }
    }

    if ($count == 2) {
        echo $num . " ";
    }
}

echo"<\div>"

?>