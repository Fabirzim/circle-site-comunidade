<?php

$EmailTo = "fabir2001@hotmail.com";
$Subject = "Nova Mensagem Recebida";

$success = false;
$errorMSG = array();
$fname = $lname = $email = $phone = $message = null;
$fields = array(
    'fname' => "O primeiro nome é necessário ",
    'lname' => "O sobrenome é obrigatório ",
    'email' => "E-mail é obrigatório ",
    'phone' => "O telefone é obrigatório ",
    'message' => "Mensagem é obrigatória "
);

foreach($fields as $key => $e_message){
    if (empty($_POST[$key])) {
        $errorMSG[] = $e_message;
    } else {
        $$key = $_POST[$key];
    }
}

// prepare email body text
$Body = null;
$Body .= "<p><b>Primeiro nome:</b> {$fname}</p>";
$Body .= "<p><b>Sobrenome:</b> {$lname}</p>";
$Body .= "<p><b>Email:</b> {$email}</p>";
$Body .= "<p><b>Telefone:</b> {$phone}</p>";
$Body .= "<p><b>Menssagem:</b> </p><p>{$message}</p>";

// send email
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:  ' . $fname . ' <' . $email .'>' . " \r\n" .
            'Reply-To: '.  $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

if($fname && $lname && $email && $phone && $message){
    $success = mail($EmailTo, $Subject, $Body, $headers );
}

if(empty($errorMSG)){
    $errorMSG[] = "Algo deu errado :(";
}

echo json_encode(array(
    'sucesso' => $success,
    'mensagem' => $errorMSG
));

die();