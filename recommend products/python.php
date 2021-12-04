<?php
// echo "hello";
// $python = 'python decisionTree.py';
// echo $python;


$var1 = "hi";
$result = shell_exec("python decisionTree.py $var1");

echo "<pre>$result</pre>";


?>