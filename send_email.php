<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = strip_tags(trim($_POST["message"]));

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Oops! Ada masalah dengan pengisian form. Silakan lengkapi form dan coba lagi.";
        exit;
    }

    $recipient = "chevahouse.official@gmail.com";
    $subject = "New contact form message from $name";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    // if (mail($recipient, $subject, $email_content, $email_headers)) {
    //     http_response_code(200);
    //     echo "Terima kasih! Pesan Anda telah terkirim.";
    // } else {
    //     http_response_code(500);
    //     echo "Oops! Terjadi kesalahan dan pesan Anda tidak dapat dikirim. Silakan coba lagi nanti.";
    // }

    try{
        mail($recipient, $subject, $email_content, $email_headers);
        http_response_code(200);
        echo "Terima kasih! Pesan Anda telah terkirim.";
    }catch(Exception $e){
        http_response_code(500);
        echo $e->getMessage();
    }

} else {
    http_response_code(403);
    echo "Terjadi kesalahan saat mengirim pesan Anda, silakan coba lagi.";
}
?>