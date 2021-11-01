<html>

<head>
<title>
Hello World
</title>
</head>
<body>

Hello, World!

<?php


    $myvar = "This is my variable";
    echo "Hello, World!";
    $number = 5;
    $number2 = 3;
    $sum = $number * $number2

    echo $sum;
    echo "Hello, " . $name;

    echo $number == $number2

    if ($number2 == 5) {
        echo "You are logged in";
    } else {
        echo "Please log in";
    }

    $name = $_POST["name"];#Post is an array
    echo "Hello " . $name;

    $people = array("Alice", "Bob", "Catherine");

    echo $people[2]

    foreach ($people as $person) {
        echo $person . ' ';
    }






?>

</body>

</html>