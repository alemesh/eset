<?php
//****************************************
//edit here
$senderName = 'ESET';
$senderEmail = $_SERVER['SERVER_NAME'];
$targetEmail = [];
$targetEmail = ['Vered@eset.co.il','ravit@gofmans.co.il', 'leads@eset.co.il'];


$messageSubject = 'Message from web-site - '. $_SERVER['SERVER_NAME'];
$redirectToReferer = true;
$redirectURL = $_SERVER['SERVER_NAME'];
//****************************************

// mail content

//var_dump($_POST); die;
$ufname = $_POST['name'];
$companyname = $_POST['company-name'];
$uphone = $_POST['tel'];
$umail = $_POST['email'];




    // prepare message text
    $messageText =	'First Name: '.$ufname."\n".
        'company: '.$companyname."\n".
        'Phone: '.$uphone."\n".
        'Email: '.$umail."\n";


// send email
$senderName = "=?UTF-8?B?" . base64_encode($senderName) . "?=";
$messageSubject = "=?UTF-8?B?" . base64_encode($messageSubject) . "?=";
$messageHeaders = "From: " . $senderName . " <" . $senderEmail . ">\r\n"
    . "MIME-Version: 1.0" . "\r\n"
    . "Content-type: text/plain; charset=UTF-8" . "\r\n";

//if (preg_match('/^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/',$targetEmail,$matches))
foreach ($targetEmail as $val){
    mail($val, $messageSubject, $messageText, $messageHeaders);
}



$today = date("F j, Y, g:i a");

$file = 'sample.csv';
$tofile = "$ufname;$companyname;$uphone;$umail;$today\n";
$bom = "\xEF\xBB\xBF";
@file_put_contents($file, $bom . $tofile . file_get_contents($file));

$redirectToTnxPage = 'http://campaign.eset.co.il/thanks-page.html?Lead=true';
// redirect
if($redirectToReferer) {
    header("Location: ".$redirectToTnxPage);
} else {
    header("Location: ".$redirectURL);
}

