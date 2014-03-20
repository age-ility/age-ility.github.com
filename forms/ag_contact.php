<?php

require_once 'Mail.php';

function asize($carry, $item) {
  $carry += strlen($item);
  return $carry;
}

// Don't do anything if our 'canary' field is filled in.
if (strlen($_POST["email"]) === 0) {
  // Check to make sure that the submitted fields are of reasonable size
  $field_len = array_reduce(array_values($_POST), "asize");
  if ($field_len <= 5000) {
    $mail_params = array();
    $mail_params["host"] = "mail.newcastle.edu.au";
    $recipients = 'age-ility@newcastle.edu.au';
    $headers['From'] = 'Age-ility Contact Form <noreply@psych.newcastle.edu.au>';
    $headers['To'] = 'age-ility@newcastle.edu.au';
    $headers['Subject'] = 'age-ility.org.au Contact Form Message';
    $body = "Name: {$_POST["cname"]}\nEmail: {$_POST["cemail"]}\nPhone: {$_POST["cphone"]}\nAge: {$_POST["cage"]}\nGender: {$_POST["cgender"]}\nMessage:\n\n{$_POST["cmessage"]}\n";
    $smtp =& Mail::factory('smtp', $mail_params);
    $smtp->send($recipients, $headers, $body);
  }
}
header('Location: http://www.age-ility.org.au/thanks.html');

?>
