<?php
require '../vendor/autoload.php';
require_once '../PHPMailer/PHPMailer/PHPMailerAutoload.php';
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
if(isset($_POST['teamsub'])){
    $uname = $_SESSION['username'];
    $pword = $_SESSION['password'];
    $nuteam = $_SESSION['numteam'];
    $webname = $_SESSION['webname'];
    $webpass = $_SESSION['webpass'];
    $webcat = $_SESSION['webOptions'];
    $devs = array($uname);
    $webnew = new ParseObject("Website");
    $webnew->set('name',$webname);
    $webnew->set('password',$webpass);
    $webnew->set('category',$webcat);
    if ($webcat === "Bag Store") {
        $newbag = new ParseObject('bag');
        $newbag->set('category','hand bag');
        $newbag->set('name','Gaine multi-outils en cuir véritable EDC ceinture boucle taille');
        $newbag->set('price','22.99');
        $newbag->set('likes','174');
        $newbag->set('brand','Portefeuilles');
        $newbag->set('color','café');
        $newbag->set('image','https://imgaz1.chiccdn.com/thumb/view/oaupload/newchic/images/90/D7/f0c21c5f-22de-4443-8576-9be533a9532c.jpg');
        $newbag->save();
        $newbag->set('category','purse');
        $newbag->set('name','Sac ceinture EDC Retro en cuir véritable 7');
        $newbag->set('price','23.42');
        $newbag->set('likes','44');
        $newbag->set('brand','Portefeuilles');
        $newbag->set('color','Brown');
        $newbag->set('image','https://imgaz1.chiccdn.com/thumb/list_grid/oaupload/newchic/images/A1/C9/b3f0bcfd-5289-48df-9fdb-c15441e1e6de.jpg');
        $newbag->save();
        $newbag->set('category','accessories');
        $newbag->set('name','Sac de taille de téléphone en cuir véritable de 6');
        $newbag->set('price','21.99');
        $newbag->set('likes','45');
        $newbag->set('brand','Portefeuilles');
        $newbag->set('color','Black');
        $newbag->set('image','https://imgaz1.chiccdn.com/thumb/list_grid/oaupload/newchic/images/D6/B1/b0863245-7f33-4118-b37a-8d2b772a625e.jpg');
        $newbag->save();
        $newbag->set('category','fanny packs');
        $newbag->set('name','EDC en cuir véritable rétro 6');
        $newbag->set('price','19.99');
        $newbag->set('likes','70');
        $newbag->set('brand','Portefeuilles');
        $newbag->set('color','Noir');
        $newbag->set('image','https://imgaz1.chiccdn.com/thumb/list_grid/oaupload/newchic/images/4E/50/8cf6d597-e70c-4ef8-af2b-14219d72368c.jpg');
        $newbag->save();
    }
    if ($nuteam === 1) {
        $webnew->set('manager',$webname);
        $webnew->setArray('developers',$devs);
        $webnew->save();
        header("Location:web.php");
    }
    else {
        $webman = $_POST['man'];
        $check = 0;
        for ($z = 0; $z < intval($nuteam) - 1; $z++) {
            $name = 'team' . strval($z);
            $devname = $_POST[$name];
            $finddev = new ParseQuery("Users");
            $finddev->equalTo('username',$devname);
            $results = $finddev->find();
            if (count($results) == 0) {
                $check = 1;
                echo "No such username";
            }
            else {
                $devs[] = $devname;
                $message = "Shop Name: ".$webname."/r/n";
                $message = $message."Shop Password: ".$webpass."/r/n";
                $message = $message."Shop Category: ".$webcat."/r/n";
                $message = $message."Shop Manager: ".$webman;
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->isHTML();
                $mail->Username = 'eshopdotio@gmail.com';
                $mail->Password = 'Mikowski1';
                $mail->SetFrom('eshopdotio@gmail.com');
                $mail->Subject = 'Make Your Shop';
                $mail->Body = $message;
                $mail->AddAddress($results[0]->get('email'));
                $mail->Send();
                mail($results[0]->get('email'), 'Make Your Shop', $message);
            }
        }
        if ($check === 0) {
            $webnew->set('manager',$webman);
            $webnew->setArray('developers',$devs);
            $webnew->save();
            header("Location:web.php");
        }
    }
}
