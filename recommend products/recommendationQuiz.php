<html>

<head>
</head>
<body>

<?php 
//include ("parse_connect.php");
# require 'autoload.php';


// autoload.php @generated by Composer

require_once __DIR__ . '/Users/saatvikanumalasetty/Downloads/phpCRUDappCS307/Recommed stores/composer/autoload_real.php';

return ComposerAutoloaderInit6b7251cc17ac16050838f2e16310e500::getLoader();
//$app_id=“KSDJFKASJFI3S8DSJFDH”;
//$master_key = “LASDK823JKHR87SDFJSDHF8DFHASFDF”;
//$rest_key = “abcdefghiklmnopqrstuvwxyz”;

session_start();

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;

ParseClient::initialize( "KSDJFKASJFI3S8DSJFDH",null, "LASDK823JKHR87SDFJSDHF8DFHASFDF");
ParseClient::setServerURL("http://localhost:1337/parse", '/');
$currentUser = ParseUser::getCurrentUser();
if ($currentUser) {
    header("Location:home.php"); 
 // Do stuff with the user
} else {
  // Show the signup or login page
}

if(isset($_POST['submit'])){
        $username = $_POST['user']; 
        $password = $_POST['password'];

    try{
      $user = ParseUser::logIn($username, $password);

      header("Location:home.php");
    } catch (ParseException $error) {
        echo "incorrect password";
      // The login failed. Check error to see why.
    }
}


echo "

        <form method='POST' action='login.php'>
                <input type='text' name='user' placeholder='Username'/><br/>
                <input type='password' name='password' placeholder='Email Address '/><br/>
                <input type='submit' value='submit' name='submit'/>
        </form>

";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://www.example.com/tester.phtml");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "postvar1=value1&postvar2=value2&postvar3=value3");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

?>
</body>

</html>