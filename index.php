<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform1')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'PEM Заявка на расчет стоимости услуг';
   $message = 'Заявка на расчет стоимости услуг';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform2')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в квартире';
   $message = 'Заявка на монтаж электрики в квартире';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform3')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в доме или коттедже';
   $message = 'Заявка на монтаж электрики в доме или коттедже';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform4')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в офисе';
   $message = 'Заявка на монтаж электрики в офисе';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform5')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в логических центрах';
   $message = 'Заявка на монтаж электрики в логических центрах';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform6')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в бизнес центрах';
   $message = 'Заявка на монтаж электрики в бизнес центрах';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform7')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на монтаж электрики в кофе и ресторанах';
   $message = 'Заявка на монтаж электрики в кофе и ресторанах';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform8')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости электромонтажных работ';
   $message = 'Заявка на расчет стоимости электромонтажных работ';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform9')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости и монтаж';
   $message = 'Заявка на расчет стоимости и монтаж';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform10')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости и монтаж';
   $message = 'Заявка на расчет стоимости и монтаж';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform11')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости и монтаж';
   $message = 'Заявка на расчет стоимости и монтаж';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform12')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости и монтаж';
   $message = 'Заявка на расчет стоимости и монтаж';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform13')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Заявка на расчет стоимости монтажа ';
   $message = 'Заявка на расчет стоимости монтажа ';
   $success_url = './zayavka-otpravlena.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $max_filesize = isset($_POST['filesize']) ? $_POST['filesize'] * 1024 : 1024000;
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0 && $_FILES[$key]['size'] <= $max_filesize)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=5">
<meta charset="utf-8">
<title>Профессиональные Электромонтажные работы в Кыргызстане</title>
<meta name="description" content="Профессиональные Электромонтажные работы в Кыргызстане">
<meta name="keywords" content="Профессиональные Электромонтажные работы в Кыргызстане">
<meta name="author" content="alladinstroi@gmail.com">
<meta name="robots" content="INDEX, FOLLOW">
<meta name="revisit-after" content="1 Day">
<meta name="expires" content="Tue, 07 Jul 2020 18:30:36 GMT">
<link href="favicon.png" rel="shortcut icon" type="image/x-icon">
<style>
div#container
{
   width: 1200px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
</style>
<link href="cupertino/jquery.ui.all.css" rel="stylesheet">
<link href="wb.validation.css" rel="stylesheet">
<link href="electro.css" rel="stylesheet">
<style>
#indexLayer4
{
   background-color: transparent;
   background-image: url(images/fon2.jpg);
   background-repeat: repeat-x;
   background-position: center top;
}
#indexLayer8
{
   background-color: transparent;
}
#indexLayer2
{
   background-color: transparent;
   background-image: url(images/fon1.png);
   background-repeat: repeat-x;
   background-position: center top;
}
#indexShape16
{
   border-width: 0;
}
#indexShape17
{
   border-width: 0;
}
#indexShape1
{
   border-width: 0;
}
#wb_indexText126 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_indexText126 div
{
   text-align: right;
}
#wb_indexCssMenu2
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
}
#wb_indexCssMenu2 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   position: relative;
   display: inline-block;
}
#wb_indexCssMenu2 li
{
   float: left;
   margin: 0;
   padding: 0px 4px 0px 0px;
   width: 253px;
}
#wb_indexCssMenu2 a
{
   display: block;
   float: left;
   color: #FFFFFF;
   border: 0px #FFD700 solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: repeat;
   background-position: center top;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 16px;
   font-style: normal;
   text-decoration: none;
   width: 249px;
   height: 49px;
   padding: 0px 2px 0px 2px;
   vertical-align: middle;
   line-height: 49px;
   text-align: center;
}
#wb_indexCssMenu2 li:hover a, #wb_indexCssMenu2 a:hover
{
   color: #FFD700;
   background-color: transparent;
   background-image: url(images/button2dark.png);
   background-repeat: repeat;
   background-position: center bottom;
   border: 0px #FFD700 solid;
}
#wb_indexCssMenu2 li.firstmain
{
   padding-left: 0px;
}
#wb_indexCssMenu2 li.lastmain
{
   padding-right: 0px;
}
#wb_indexCssMenu2 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#indexImage20
{
   border: 0px #000000 solid;
   -webkit-animation: transform-pulse 1000ms linear 0ms infinite normal;
   -moz-animation: transform-pulse 1000ms linear 0ms infinite normal;
   -ms-animation: transform-pulse 1000ms linear 0ms infinite normal;
   animation: transform-pulse 1000ms linear 0ms infinite normal;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexText44 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText44 div
{
   text-align: left;
}
#wb_indexForm1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#indexButton1
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button1.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 20px;
}
#wb_indexText119 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText119 div
{
   text-align: center;
}
#wb_indexText11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText11 div
{
   text-align: center;
}
#wb_indexText12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText12 div
{
   text-align: left;
}
#wb_indexText19 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText19 div
{
   text-align: left;
}
#indexLayer20
{
   background-color: transparent;
   background-image: url(images/fon2.png);
   background-repeat: repeat-x;
   background-position: center top;
}
#indexLayer3
{
   background-color: transparent;
   background-image: url(images/fon7.jpg);
   background-repeat: repeat-x;
   background-position: center top;
}
#indexShape10
{
   border-width: 0;
}
#indexLayer6
{
   background-color: transparent;
   background-image: url(images/fon3.jpg);
   background-repeat: repeat-x;
   background-position: center top;
}
#indexEditbox1
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexImage1
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexText1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText1 div
{
   text-align: left;
}
#wb_indexText3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_indexText3 div
{
   text-align: right;
}
#wb_indexText4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText4 div
{
   text-align: center;
}
#wb_indexText10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText10 div
{
   text-align: left;
}
#wb_indexText13 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText13 div
{
   text-align: center;
}
#wb_indexText14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText14 div
{
   text-align: center;
}
#wb_indexText15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText15 div
{
   text-align: center;
}
#wb_indexText16 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText16 div
{
   text-align: center;
}
#wb_indexText17 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText17 div
{
   text-align: center;
}
#indexShape2
{
   border-width: 0;
}
#wb_indexText5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText5 div
{
   text-align: center;
}
#wb_indexForm2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText7 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText7 div
{
   text-align: left;
}
#indexEditbox2
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton2
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox3
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText8 div
{
   text-align: left;
}
#indexImage2
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexForm3
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText9 div
{
   text-align: left;
}
#indexEditbox4
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton3
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox5
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText18 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText18 div
{
   text-align: left;
}
#indexImage5
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexForm4
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText21 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText21 div
{
   text-align: left;
}
#indexEditbox6
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton4
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox7
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText22 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText22 div
{
   text-align: left;
}
#indexImage6
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexForm5
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText40 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText40 div
{
   text-align: left;
}
#indexEditbox8
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton5
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox9
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText41 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText41 div
{
   text-align: left;
}
#indexImage7
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexForm6
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText43 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText43 div
{
   text-align: left;
}
#indexEditbox10
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton6
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox11
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText45 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText45 div
{
   text-align: left;
}
#indexImage8
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexForm7
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText47 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText47 div
{
   text-align: left;
}
#indexEditbox12
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton7
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox13
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText48 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText48 div
{
   text-align: left;
}
#indexImage9
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#indexLayer7
{
   background-color: #363636;
}
#indexLayer9
{
   background-color: transparent;
   background-image: url(images/fon22222.jpg);
   background-repeat: repeat-x;
   background-position: center top;
}
#wb_indexForm8
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText32 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText32 div
{
   text-align: left;
}
#indexEditbox14
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton8
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 16px;
}
#wb_indexText50 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText50 div
{
   text-align: left;
}
#indexShape3
{
   border-width: 0;
}
#wb_indexText6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText6 div
{
   text-align: center;
}
#indexShape4
{
   border-width: 0;
}
#wb_indexText20 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText20 div
{
   text-align: center;
}
#indexShape6
{
   border-width: 0;
}
#wb_indexText23 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText23 div
{
   text-align: center;
}
#indexShape7
{
   border-width: 0;
}
#wb_indexText42 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText42 div
{
   text-align: center;
}
#indexShape9
{
   border-width: 0;
}
#wb_indexText46 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText46 div
{
   text-align: center;
}
#indexShape13
{
   border-width: 0;
}
#wb_indexText49 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText49 div
{
   text-align: center;
}
#wb_indexText51 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText51 div
{
   text-align: center;
}
#indexTextArea1
{
   border: 0px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 7px 15px 10px 12px;
   text-align: left;
   resize: none;
}
#wb_indexText2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText2 div
{
   text-align: center;
}
#wb_indexText24 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText24 div
{
   text-align: left;
}
#indexEditbox15
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton9
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#indexEditbox16
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText25 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText25 div
{
   text-align: left;
}
#wb_indexText26 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText26 div
{
   text-align: left;
}
#indexLayer1
{
   background-color: transparent;
   background-image: url(images/fon4.jpg);
   background-repeat: repeat;
   background-position: left top;
}
#wb_indexText27 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText27 div
{
   text-align: left;
}
#wb_indexForm9
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexForm10
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#indexEditbox17
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexEditbox18
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText29 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText29 div
{
   text-align: left;
}
#wb_indexText30 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText30 div
{
   text-align: left;
}
#indexButton10
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#wb_indexText31 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText31 div
{
   text-align: center;
}
#wb_indexText36 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText36 div
{
   text-align: left;
}
#wb_indexForm11
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#indexEditbox19
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexEditbox20
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText37 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText37 div
{
   text-align: left;
}
#wb_indexText38 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText38 div
{
   text-align: left;
}
#indexButton11
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#wb_indexText39 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText39 div
{
   text-align: center;
}
#wb_indexText52 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText52 div
{
   text-align: left;
}
#wb_indexForm12
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#indexEditbox21
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexEditbox22
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: normal;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_indexText53 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText53 div
{
   text-align: left;
}
#wb_indexText54 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText54 div
{
   text-align: left;
}
#indexButton12
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: no-repeat;
   background-position: left top;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 15px;
}
#wb_indexText55 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText55 div
{
   text-align: center;
}
#wb_indexText56 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText56 div
{
   text-align: left;
}
#indexLayer5
{
   background-color: #FECD04;
}
#wb_indexCssMenu1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_indexCssMenu1 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   position: relative;
   display: inline-block;
}
#wb_indexCssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 14px 0px 0px;
}
#wb_indexCssMenu1 a
{
   display: block;
   float: left;
   color: #2F4F4F;
   border: 0px #C0C0C0 solid;
   background-color: transparent;
   background-image: none;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 20px;
   font-style: normal;
   text-decoration: none;
   height: 28px;
   line-height: 28px;
   padding: 0px 5px 0px 5px;
   vertical-align: middle;
   text-align: center;
}
#wb_indexCssMenu1 li:hover a, #wb_indexCssMenu1 a:hover, #wb_indexCssMenu1 .active
{
   color: #696969;
   background-color: transparent;
   background-image: none;
   border: 0px #C0C0C0 solid;
}
#wb_indexCssMenu1 li.firstmain
{
   padding-left: 0px;
}
#wb_indexCssMenu1 li.lastmain
{
   padding-right: 0px;
}
#wb_indexCssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#indexLayer10
{
   background-color: transparent;
   background-image: url(images/fon5.png);
   background-repeat: repeat-x;
   background-position: center top;
}
#wb_indexText57 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText57 div
{
   text-align: center;
}
.ui-tooltip
{
   padding: 10px 10px 15px 10px;
}
#wb_indexCssMenu4
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
}
#wb_indexCssMenu4 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   position: relative;
   display: inline-block;
}
#wb_indexCssMenu4 li
{
   float: left;
   margin: 0;
   padding: 0px 4px 0px 0px;
   width: 185px;
}
#wb_indexCssMenu4 a
{
   display: block;
   float: left;
   color: #00D600;
   border: 0px #FFD700 solid;
   background-color: transparent;
   background-image: url(images/zayvka.png);
   background-repeat: repeat;
   background-position: center top;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 8px;
   font-style: normal;
   text-decoration: none;
   width: 181px;
   height: 48px;
   padding: 0px 2px 0px 2px;
   vertical-align: middle;
   line-height: 48px;
   text-align: center;
}
#wb_indexCssMenu4 li:hover a, #wb_indexCssMenu4 a:hover
{
   color: #008C00;
   background-color: transparent;
   background-image: url(images/zayvkadark.png);
   background-repeat: repeat;
   background-position: center bottom;
   border: 0px #FFD700 solid;
}
#wb_indexCssMenu4 li.firstmain
{
   padding-left: 0px;
}
#wb_indexCssMenu4 li.lastmain
{
   padding-right: 0px;
}
#wb_indexCssMenu4 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#wb_indexText59 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText59 div
{
   text-align: center;
}
#wb_indexText60 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText60 div
{
   text-align: center;
}
#wb_indexText61 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText61 div
{
   text-align: center;
}
#wb_indexText62 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText62 div
{
   text-align: center;
}
#wb_indexText63 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText63 div
{
   text-align: center;
}
#indexLayer12
{
   background-color: transparent;
   background-image: url(images/fon6.jpg);
   background-repeat: repeat-x;
   background-position: center top;
}
#wb_indexText28 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_indexText28 div
{
   text-align: right;
}
#wb_indexCssMenu5
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
}
#wb_indexCssMenu5 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   position: relative;
   display: inline-block;
}
#wb_indexCssMenu5 li
{
   float: left;
   margin: 0;
   padding: 0px 4px 0px 0px;
   width: 253px;
}
#wb_indexCssMenu5 a
{
   display: block;
   float: left;
   color: #FFFFFF;
   border: 0px #FFD700 solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: repeat;
   background-position: center top;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 16px;
   font-style: normal;
   text-decoration: none;
   width: 249px;
   height: 49px;
   padding: 0px 2px 0px 2px;
   vertical-align: middle;
   line-height: 49px;
   text-align: center;
}
#wb_indexCssMenu5 li:hover a, #wb_indexCssMenu5 a:hover
{
   color: #FFD700;
   background-color: transparent;
   background-image: url(images/button2dark.png);
   background-repeat: repeat;
   background-position: center bottom;
   border: 0px #FFD700 solid;
}
#wb_indexCssMenu5 li.firstmain
{
   padding-left: 0px;
}
#wb_indexCssMenu5 li.lastmain
{
   padding-right: 0px;
}
#wb_indexCssMenu5 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#wb_indexForm13
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#wb_indexText33 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText33 div
{
   text-align: left;
}
#wb_indexText34 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText34 div
{
   text-align: left;
}
#indexEditbox23
{
   border: 0px #0096DB solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 16px;
   padding: 0px 15px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#indexButton13
{
   border: 0px #FFFFFF solid;
   background-color: transparent;
   background-image: url(images/button2.png);
   background-repeat: repeat-x;
   background-position: left top;
   background-size: 100% 100%;
   color: #FFFFFF;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 19px;
}
#wb_indexText65 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText65 div
{
   text-align: center;
}
#indexImage4
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#indexShape11
{
   border-width: 0;
}
#wb_indexText64 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText64 div
{
   text-align: left;
}
#indexShape12
{
   border-width: 0;
}
#indexShape14
{
   border-width: 0;
}
#indexShape15
{
   border-width: 0;
}
#indexImage3
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_indexText35 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_indexText35 div
{
   text-align: right;
}
#wb_indexText58 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: right;
}
#wb_indexText58 div
{
   text-align: right;
}
</style>
<script src="jquery-1.11.1.min.js"></script>
<script src="wb.validation.min.js"></script>
<script src="jquery.ui.core.min.js"></script>
<script src="jquery.ui.widget.min.js"></script>
<script src="jquery.ui.position.min.js"></script>
<script src="jquery.ui.tooltip.min.js"></script>
<script src="fancybox/jquery.easing-1.3.pack.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.0.css">
<script src="fancybox/jquery.fancybox-1.3.0.pack.js"></script>
<script src="fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script src="wwb10.min.js"></script>
<script>
$(document).ready(function()
{
   $("#indexForm1").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox1").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm2").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox2").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox3").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm3").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox4").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox5").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm4").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox6").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox7").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm5").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox8").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox9").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm6").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox10").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox11").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm7").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox12").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox13").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm8").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox14").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexTextArea1").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '1000',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'none',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox15").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox16").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm9").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexForm10").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox17").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox18").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm11").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox19").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox20").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexForm12").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox21").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   $("#indexEditbox22").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
   var indexjQueryToolTip1Opts =
   {
      hide: true,
      show: true,
      content: '<span style="color:#2F4F4F;font-family:Tahoma;font-size:16px;"><strong>Компания «ПроЭлектроМонтаж»<br><br></strong></span><span style="color:#2F4F4F;font-family:Tahoma;font-size:15px;">Мы работаем с 1995 года. За это время накоплен бесценный опыт и сформирован коллектив профессионалов умеющих приносить пользу клиенту. Мы ценим своих клиентов! Мы гордимся тем, что большинство наших клиентов становятся постоянными.<br>Мы постоянно стремимся к улучшению созданных для Вас проектов!<br></span>',
      items: '#wb_indexImage20',
      position: { my: "right+320 bottom+370", at: "left top", collision: "flipfit" }
   };
   $("#wb_indexImage20").tooltip(indexjQueryToolTip1Opts);
   $("#indexForm13").submit(function(event)
   {
      var isValid = $.validate.form(this);
      return isValid;
   });
   $("#indexEditbox23").validate(
   {
      required: true,
      type: 'text',
      length_min: '2',
      length_max: '100',
      color_text: '#FFFFFF',
      color_hint: '#FF0000',
      color_error: '#FF0000',
      color_border: '#FF0000',
      nohint: true,
      font_family: 'Arial',
      font_size: '11px',
      font_weight: 'bold',
      position: 'topleft',
      offsetx: 180,
      offsety: 6,
      effect: 'fade',
      error_text: 'Заполните правильно!'
   });
});
</script>
<script>
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();
	    var target = this.hash,
	    $target = $(target);
	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});
</script>
</head>
<body>
   <div id="indexLayer4" style="position:absolute;text-align:center;left:0%;top:1929px;width:100%;height:754px;z-index:251;min-width:1200px;">
      <div id="indexLayer4_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexForm5" style="position:absolute;left:20px;top:125px;width:360px;height:622px;z-index:24;">
            <form name="Form5" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm5">
               <input type="hidden" name="formid" value="indexform5">
               <div id="wb_indexText40" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:0;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox8" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:1;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton5" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:2;">
               <input type="text" id="indexEditbox9" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:3;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText41" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:4;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage7" style="position:absolute;left:12px;top:96px;width:332px;height:248px;z-index:5;">
                  <img src="images/logistik.jpg" id="indexImage7" alt=""></div>
               <div id="wb_indexShape7" style="position:absolute;left:12px;top:9px;width:333px;height:81px;z-index:6;">
                  <img src="images/img0003.png" id="indexShape7" alt="" style="width:333px;height:81px;"></div>
               <div id="wb_indexText42" style="position:absolute;left:29px;top:14px;width:302px;height:64px;text-align:center;z-index:7;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Логистические<br>центры</span></div>
            </form>
         </div>
         <div id="wb_indexForm6" style="position:absolute;left:419px;top:125px;width:360px;height:622px;z-index:25;">
            <form name="Form6" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm6">
               <input type="hidden" name="formid" value="indexform6">
               <div id="wb_indexText43" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:8;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox10" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:9;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton6" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:10;">
               <input type="text" id="indexEditbox11" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:11;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText45" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:12;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage8" style="position:absolute;left:12px;top:96px;width:334px;height:248px;z-index:13;">
                  <img src="images/2.png" id="indexImage8" alt=""></div>
               <div id="wb_indexShape9" style="position:absolute;left:11px;top:9px;width:336px;height:81px;z-index:14;">
                  <img src="images/img0004.png" id="indexShape9" alt="" style="width:336px;height:81px;"></div>
               <div id="wb_indexText46" style="position:absolute;left:27px;top:15px;width:302px;height:64px;text-align:center;z-index:15;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Торговых и<br>бизнес центров</span></div>
            </form>
         </div>
         <div id="wb_indexForm7" style="position:absolute;left:816px;top:125px;width:360px;height:622px;z-index:26;">
            <form name="Form7" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm7">
               <input type="hidden" name="formid" value="indexform7">
               <div id="wb_indexText47" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:16;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox12" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:17;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton7" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:18;">
               <input type="text" id="indexEditbox13" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:19;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText48" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:20;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage9" style="position:absolute;left:12px;top:96px;width:335px;height:248px;z-index:21;">
                  <img src="images/3.png" id="indexImage9" alt=""></div>
               <div id="wb_indexShape13" style="position:absolute;left:11px;top:9px;width:336px;height:81px;z-index:22;">
                  <img src="images/img0007.png" id="indexShape13" alt="" style="width:336px;height:81px;"></div>
               <div id="wb_indexText49" style="position:absolute;left:29px;top:15px;width:302px;height:64px;text-align:center;z-index:23;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Кафе и <br>ресторанов</span></div>
            </form>
         </div>
      </div>
   </div>
   <div id="indexLayer8" style="position:absolute;text-align:left;left:0%;top:5108px;width:101%;height:479px;z-index:252;">
<!-- Карта -->
      <div id="indexHtml1" style="position:absolute;left:0px;top:1px;width:1207px;height:475px;z-index:27">
<script charset="utf-8" async="" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A86bc8e86187db9f03257fd5c9e76085703a39d085ed6239324e22ffc3b9f73dd&amp;width=100%25&amp;height=475&amp;lang=ru_RU&amp;scroll=true"></script>
<style>
#indexHtml1{Width:100% !important;}
</style></div>
   </div>
   <div id="indexLayer2" style="position:absolute;text-align:center;left:0%;top:48px;width:100%;height:1329px;z-index:253;min-width:1200px;">
      <div id="indexLayer2_Container" style="width:1208px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexText126" style="position:absolute;left:890px;top:10px;width:286px;height:35px;text-align:right;z-index:33;">
            <span style="color:#000000;font-family:Tahoma;font-size:29px;"><strong>0 312 58 63 88</strong></span></div>
         <div id="wb_indexImage20" style="position:absolute;left:49px;top:248px;width:69px;height:67px;z-index:34;">
            <a href="javascript:displaylightbox('./zvonok.php',{width:1000,height:600,scrolling:'no'})" target="_self"><img src="images/img0023.png" id="indexImage20" alt=""></a></div>
         <div id="wb_indexText44" style="position:absolute;left:827px;top:106px;width:349px;height:2px;z-index:35;text-align:left;">
&nbsp;</div>
         <div id="wb_indexText19" style="position:absolute;left:50px;top:155px;width:365px;height:70px;z-index:36;text-align:left;">
            <span style="color:#363636;font-family:Tahoma;font-size:29px;"><strong>Профессиональное <br>выполнение</strong></span><span style="color:#000000;font-family:Tahoma;font-size:24px;"><strong> </strong></span></div>
         <div id="wb_indexCssMenu2" style="position:absolute;left:915px;top:91px;width:257px;height:50px;text-align:center;z-index:37;">
            <ul>
               <li class="firstmain"><a href="javascript:displaylightbox('./zvonok.php',{width:980,height:520,scrolling:'no'})" target="_self">&#1047;&#1072;&#1082;&#1072;&#1078;&#1080;&#1090;&#1077;&nbsp;&#1082;&#1086;&#1085;&#1089;&#1091;&#1083;&#1100;&#1090;&#1072;&#1094;&#1080;&#1102;</a>
               </li>
            </ul>
            <br>
         </div>
         <div id="wb_indexForm1" style="position:absolute;left:722px;top:272px;width:380px;height:469px;z-index:38;">
            <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm1">
               <input type="hidden" name="formid" value="indexform1">
               <div id="wb_indexText11" style="position:absolute;left:4px;top:24px;width:371px;height:50px;text-align:center;z-index:28;">
                  <span style="color:#FFD700;font-family:Verdana;font-size:21px;"><strong>Закажите расчет стоимости <br>услуг сейчас и получите</strong></span></div>
               <div id="wb_indexText12" style="position:absolute;left:49px;top:210px;width:300px;height:28px;z-index:29;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:12px;"><strong>&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон, он будет являться идентификатором для получения скидки*</strong></span></div>
               <div id="wb_indexText119" style="position:absolute;left:19px;top:419px;width:269px;height:28px;text-align:center;z-index:30;">
                  <span style="color:#FFD700;font-family:Arial;font-size:11px;">* Ваши данные будут в безопасности и не будут переданы третьим лицам</span></div>
               <input type="tel" id="indexEditbox1" style="position:absolute;left:29px;top:255px;width:276px;height:47px;line-height:47px;z-index:31;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton1" name="" value="ОСТАВЬТЕ ЗАЯВКУ" style="position:absolute;left:22px;top:340px;width:314px;height:75px;z-index:32;">
            </form>
         </div>
         <div id="wb_indexImage1" style="position:absolute;left:987px;top:379px;width:154px;height:336px;z-index:39;">
            <img src="images/voltmetr.png" id="indexImage1" alt=""></div>
         <div id="wb_indexText1" style="position:absolute;left:48px;top:102px;width:723px;height:51px;z-index:40;text-align:left;">
            <span style="color:#FF7A01;font-family:Sochi2014;font-size:43px;"><strong>ЭЛЕКТРОМОНТАЖНЫЕ РАБОТЫ</strong></span></div>
         <div id="wb_indexText3" style="position:absolute;left:451px;top:155px;width:262px;height:70px;text-align:right;z-index:41;">
            <span style="color:#363636;font-family:Tahoma;font-size:29px;"><strong>в короткие<br>сроки</strong></span></div>
         <div id="wb_indexText4" style="position:absolute;left:39px;top:1157px;width:206px;height:72px;text-align:center;z-index:42;">
            <span style="color:#000000;font-family:Verdana;font-size:16px;">Только квалифицированные работники с опытом работы более 5 лет</span></div>
         <div id="wb_indexText10" style="position:absolute;left:151px;top:259px;width:235px;height:54px;z-index:43;text-align:left;">
            <span style="color:#000000;font-family:Verdana;font-size:15px;">скачайте книжку <br>о нашей компании<br>и о наших услугах</span></div>
         <div id="wb_indexText13" style="position:absolute;left:268px;top:1158px;width:206px;height:72px;text-align:center;z-index:44;">
            <span style="color:#000000;font-family:Verdana;font-size:16px;">Выполнение <br>работ точно<br>в оговоренный <br>срок</span></div>
         <div id="wb_indexText14" style="position:absolute;left:500px;top:1158px;width:206px;height:54px;text-align:center;z-index:45;">
            <span style="color:#000000;font-family:Verdana;font-size:16px;">Просчитываем точную <br>стоимость до <br>начала работ</span></div>
         <div id="wb_indexText15" style="position:absolute;left:736px;top:1158px;width:206px;height:36px;text-align:center;z-index:46;">
            <span style="color:#000000;font-family:Verdana;font-size:16px;">Приедем в день <br>обращения</span></div>
         <div id="wb_indexText16" style="position:absolute;left:970px;top:1158px;width:206px;height:36px;text-align:center;z-index:47;">
            <span style="color:#000000;font-family:Verdana;font-size:16px;">Все работы производим строго по ПУЭ</span></div>
         <div id="wb_indexText17" style="position:absolute;left:402px;top:860px;width:405px;height:56px;text-align:center;z-index:48;">
            <span style="color:#363636;font-family:Sochi2014;font-size:48px;"><strong>ПОЧЕМУ МЫ</strong></span></div>
         <div id="wb_indexShape1" style="position:absolute;left:0px;top:796px;width:66px;height:147px;z-index:49;">
            <div id="link2"><a href="#link1"><img src="images/img0013.png" id="indexShape1" alt="" style="width:66px;height:147px;"></a></div></div>
         <div id="wb_indexShape2" style="position:absolute;left:129px;top:264px;width:15px;height:46px;z-index:50;">
            <img src="images/img0002.png" id="indexShape2" alt="" style="width:15px;height:46px;"></div>
         <div id="wb_indexText35" style="position:absolute;left:890px;top:48px;width:286px;height:35px;text-align:right;z-index:52;">
            <span style="color:#000000;font-family:Tahoma;font-size:29px;"><strong>0 557 17 38 38</strong></span></div>
         <div id="wb_indexImage3" style="position:absolute;left:50px;top:10px;width:208px;height:55px;z-index:53;">
            <img src="images/logo23.png" id="indexImage3" alt=""></div>
      </div>
   </div>
   <div id="indexLayer20" style="position:absolute;text-align:center;left:0%;top:1322px;width:100%;height:739px;z-index:254;min-width:1200px;">
      <div id="indexLayer20_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexText5" style="position:absolute;left:212px;top:20px;width:707px;height:86px;text-align:center;z-index:83;">
            <span style="color:#363636;font-family:Sochi2014;font-size:32px;"><strong>ВЫПОЛНЯЕМ <br>ЭЛЕКТРОМОНТАЖНЫЕ РАБОТЫ ДЛЯ:</strong></span></div>
         <div id="wb_indexForm2" style="position:absolute;left:20px;top:125px;width:360px;height:589px;z-index:84;">
            <form name="Form2" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm2">
               <input type="hidden" name="formid" value="indexform2">
               <div id="wb_indexText7" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:59;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox2" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:60;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton2" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:61;">
               <input type="text" id="indexEditbox3" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:62;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText8" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:63;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage2" style="position:absolute;left:12px;top:96px;width:334px;height:249px;z-index:64;">
                  <img src="images/6.png" id="indexImage2" alt=""></div>
               <div id="wb_indexShape3" style="position:absolute;left:11px;top:10px;width:336px;height:81px;z-index:65;">
                  <img src="images/img0009.png" id="indexShape3" alt="" style="width:336px;height:81px;"></div>
               <div id="wb_indexText6" style="position:absolute;left:29px;top:33px;width:302px;height:32px;text-align:center;z-index:66;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Квартир</span></div>
            </form>
         </div>
         <div id="wb_indexForm3" style="position:absolute;left:419px;top:125px;width:360px;height:586px;z-index:85;">
            <form name="Form3" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm3">
               <input type="hidden" name="formid" value="indexform3">
               <div id="wb_indexText9" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:67;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox4" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:68;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton3" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:69;">
               <input type="text" id="indexEditbox5" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:70;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText18" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:71;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage5" style="position:absolute;left:12px;top:96px;width:332px;height:249px;z-index:72;">
                  <img src="images/5.png" id="indexImage5" alt=""></div>
               <div id="wb_indexShape4" style="position:absolute;left:12px;top:9px;width:332px;height:81px;z-index:73;">
                  <img src="images/img0014.png" id="indexShape4" alt="" style="width:332px;height:81px;"></div>
               <div id="wb_indexText20" style="position:absolute;left:26px;top:14px;width:302px;height:64px;text-align:center;z-index:74;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Домов и <br>коттеджей</span></div>
            </form>
         </div>
         <div id="wb_indexForm4" style="position:absolute;left:816px;top:125px;width:360px;height:586px;z-index:86;">
            <form name="Form4" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm4">
               <input type="hidden" name="formid" value="indexform4">
               <div id="wb_indexText21" style="position:absolute;left:51px;top:433px;width:185px;height:16px;z-index:75;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox6" style="position:absolute;left:51px;top:453px;width:226px;height:32px;line-height:32px;z-index:76;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton4" name="" value="Расчитать стоимость услуг" style="position:absolute;left:51px;top:503px;width:255px;height:49px;z-index:77;">
               <input type="text" id="indexEditbox7" style="position:absolute;left:51px;top:381px;width:226px;height:32px;line-height:32px;z-index:78;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <div id="wb_indexText22" style="position:absolute;left:51px;top:360px;width:236px;height:16px;z-index:79;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexImage6" style="position:absolute;left:12px;top:96px;width:332px;height:249px;z-index:80;">
                  <img src="images/1.png" id="indexImage6" alt=""></div>
               <div id="wb_indexShape6" style="position:absolute;left:11px;top:8px;width:333px;height:81px;z-index:81;">
                  <img src="images/img0015.png" id="indexShape6" alt="" style="width:333px;height:81px;"></div>
               <div id="wb_indexText23" style="position:absolute;left:29px;top:30px;width:302px;height:32px;text-align:center;z-index:82;">
                  <span style="color:#000000;font-family:Verdana;font-size:27px;">Офисов</span></div>
            </form>
         </div>
      </div>
   </div>
   <div id="indexLayer3" style="position:absolute;text-align:center;left:0%;top:5580px;width:100%;height:158px;z-index:255;min-width:1200px;">
      <div id="indexLayer3_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexShape10" style="position:absolute;left:0px;top:4px;width:66px;height:147px;z-index:87;">
            <div id="link6"><a href="#link1"><img src="images/img0005.png" id="indexShape10" alt="" style="width:66px;height:147px;"></a></div></div>
         <div id="wb_indexText28" style="position:absolute;left:845px;top:7px;width:286px;height:35px;text-align:right;z-index:88;">
            <span style="color:#000000;font-family:Tahoma;font-size:29px;"><strong> 0 (557) 17 38 38</strong></span></div>
         <div id="wb_indexCssMenu5" style="position:absolute;left:884px;top:93px;width:257px;height:50px;text-align:center;z-index:89;">
            <ul>
               <li class="firstmain"><a href="javascript:displaylightbox('./zvonok.php',{width:980,height:520,scrolling:'no'})" target="_self">&#1047;&#1072;&#1082;&#1072;&#1078;&#1080;&#1090;&#1077;&nbsp;&#1082;&#1086;&#1085;&#1089;&#1091;&#1083;&#1100;&#1090;&#1072;&#1094;&#1080;&#1102;</a>
               </li>
            </ul>
            <br>
         </div>
         <div id="wb_indexShape11" style="position:absolute;left:366px;top:24px;width:424px;height:123px;filter:alpha(opacity=65);opacity:0.65;z-index:90;">
            <img src="images/img0022.png" id="indexShape11" alt="" style="width:424px;height:123px;"></div>
         <div id="wb_indexText64" style="position:absolute;left:399px;top:44px;width:369px;height:72px;z-index:91;text-align:left;">
            <span style="color:#FFFFFF;font-family:Tahoma;font-size:20px;"><strong>Электромонтажные работы по Бишкеку и Чуйской области<br></strong>Время работы: пн-вс 9:00 - 18:00</span></div>
         <div id="wb_indexText58" style="position:absolute;left:844px;top:44px;width:286px;height:35px;text-align:right;z-index:92;">
            <span style="color:#000000;font-family:Tahoma;font-size:29px;"><strong> 0 (312) 58 63 88</strong></span></div>
      </div>
   </div>
   <div id="indexLayer6" style="position:absolute;text-align:center;left:0%;top:2764px;width:100%;height:436px;z-index:256;min-width:1200px;">
      <div id="indexLayer6_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexForm8" style="position:absolute;left:441px;top:137px;width:610px;height:222px;z-index:98;">
            <form name="Form7" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm8">
               <input type="hidden" name="formid" value="indexform8">
               <div id="wb_indexText32" style="position:absolute;left:316px;top:5px;width:185px;height:16px;z-index:93;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="tel" id="indexEditbox14" style="position:absolute;left:322px;top:31px;width:215px;height:36px;line-height:36px;z-index:94;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton8" name="" value="Расчитать стоимость" style="position:absolute;left:317px;top:87px;width:255px;height:49px;z-index:95;">
               <div id="wb_indexText50" style="position:absolute;left:25px;top:3px;width:236px;height:16px;z-index:96;text-align:left;">
                  <span style="color:#000000;font-family:Tahoma;font-size:13px;">Напишите описание проблемы:*</span></div>
               <textarea name="Текст" id="indexTextArea1" style="position:absolute;left:31px;top:30px;width:238px;height:159px;z-index:97;" rows="7" cols="31" placeholder="&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1090;&#1077;&#1082;&#1089;&#1090;"></textarea>
            </form>
         </div>
         <div id="wb_indexText51" style="position:absolute;left:268px;top:28px;width:813px;height:64px;text-align:center;z-index:99;">
            <span style="color:#000000;font-family:Sochi2014;font-size:27px;"><strong>ЗАКАЖИТЕ БЕСПЛАТНЫЙ РАСЧЕТ СТОИМОСТИ <br>НА ЛЮБЫЕ ДРУГИЕ ЭЛЕКТРОМОНТАЖНЫЕ РАБОТЫ</strong></span></div>
      </div>
   </div>
   <div id="indexLayer7" style="position:absolute;text-align:center;left:0%;top:3193px;width:100%;height:900px;z-index:257;min-width:1200px;">
      <div id="indexLayer7_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="indexLayer1" style="position:absolute;text-align:left;left:14px;top:63px;width:1190px;height:670px;z-index:178;">
            <div id="wb_indexForm9" style="position:absolute;left:10px;top:18px;width:576px;height:316px;z-index:162;">
               <form name="Form8" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm9">
                  <input type="hidden" name="formid" value="indexform9">
                  <input type="text" id="indexEditbox16" style="position:absolute;left:317px;top:109px;width:206px;height:35px;line-height:35px;z-index:148;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
                  <input type="tel" id="indexEditbox15" style="position:absolute;left:316px;top:187px;width:206px;height:35px;line-height:35px;z-index:149;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
                  <div id="wb_indexText24" style="position:absolute;left:312px;top:161px;width:185px;height:16px;z-index:150;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
                  <div id="wb_indexText25" style="position:absolute;left:312px;top:83px;width:236px;height:16px;z-index:151;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
                  <input type="submit" id="indexButton9" name="" value="Расчитать стоимость услуг" style="position:absolute;left:313px;top:247px;width:255px;height:49px;z-index:152;">
                  <div id="wb_indexText26" style="position:absolute;left:21px;top:20px;width:550px;height:25px;z-index:153;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Verdana;font-size:21px;">Замена проводки в квартире, офисе, коттедже</span></div>
                  <div id="wb_indexText27" style="position:absolute;left:10px;top:87px;width:136px;height:21px;z-index:154;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:17px;"><strong>от 5000 сом</strong></span></div>
               </form>
            </div>
            <div id="wb_indexForm10" style="position:absolute;left:608px;top:19px;width:576px;height:316px;z-index:163;">
               <form name="Form9" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm10">
                  <input type="hidden" name="formid" value="indexform10">
                  <input type="text" id="indexEditbox17" style="position:absolute;left:328px;top:108px;width:206px;height:35px;line-height:35px;z-index:155;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
                  <input type="tel" id="indexEditbox18" style="position:absolute;left:328px;top:186px;width:206px;height:35px;line-height:35px;z-index:156;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
                  <div id="wb_indexText29" style="position:absolute;left:323px;top:158px;width:185px;height:16px;z-index:157;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
                  <div id="wb_indexText30" style="position:absolute;left:323px;top:79px;width:236px;height:16px;z-index:158;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
                  <input type="submit" id="indexButton10" name="" value="Расчитать стоимость услуг" style="position:absolute;left:320px;top:247px;width:255px;height:49px;z-index:159;">
                  <div id="wb_indexText31" style="position:absolute;left:16px;top:8px;width:544px;height:50px;text-align:center;z-index:160;">
                     <span style="color:#FFFFFF;font-family:Verdana;font-size:21px;">Перенос розеток и выключателей в спальне, <br>детской, коридоре, под ключ</span></div>
                  <div id="wb_indexText36" style="position:absolute;left:22px;top:87px;width:136px;height:21px;z-index:161;text-align:left;">
                     <span style="color:#FFFFFF;font-family:Tahoma;font-size:17px;"><strong>от 1500 сом</strong></span></div>
               </form>
            </div>
         </div>
         <div id="wb_indexForm11" style="position:absolute;left:24px;top:419px;width:576px;height:316px;z-index:179;">
            <form name="Form10" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm11">
               <input type="hidden" name="formid" value="indexform11">
               <input type="text" id="indexEditbox19" style="position:absolute;left:317px;top:109px;width:206px;height:35px;line-height:35px;z-index:164;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <input type="tel" id="indexEditbox20" style="position:absolute;left:316px;top:187px;width:206px;height:35px;line-height:35px;z-index:165;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <div id="wb_indexText37" style="position:absolute;left:312px;top:161px;width:185px;height:16px;z-index:166;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <div id="wb_indexText38" style="position:absolute;left:312px;top:83px;width:236px;height:16px;z-index:167;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <input type="submit" id="indexButton11" name="" value="Расчитать стоимость услуг" style="position:absolute;left:313px;top:247px;width:255px;height:49px;z-index:168;">
               <div id="wb_indexText39" style="position:absolute;left:5px;top:8px;width:550px;height:50px;text-align:center;z-index:169;">
                  <span style="color:#FFFFFF;font-family:Verdana;font-size:21px;">Полная прокладки электропроводки <br>в новой квартире, офисе , доме&nbsp; под ключ</span></div>
               <div id="wb_indexText52" style="position:absolute;left:10px;top:87px;width:136px;height:21px;z-index:170;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:17px;"><strong>от 9500 сом</strong></span></div>
            </form>
         </div>
         <div id="wb_indexForm12" style="position:absolute;left:622px;top:420px;width:576px;height:316px;z-index:180;">
            <form name="Form11" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm12">
               <input type="hidden" name="formid" value="indexform12">
               <input type="text" id="indexEditbox21" style="position:absolute;left:328px;top:108px;width:206px;height:35px;line-height:35px;z-index:171;" name="Размер помещения" value="" placeholder="&#1053;&#1072;&#1087;&#1088;&#1080;&#1084;&#1077;&#1088; 60 &#1084;2">
               <input type="tel" id="indexEditbox22" style="position:absolute;left:328px;top:186px;width:206px;height:35px;line-height:35px;z-index:172;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <div id="wb_indexText53" style="position:absolute;left:323px;top:158px;width:185px;height:16px;z-index:173;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <div id="wb_indexText54" style="position:absolute;left:323px;top:79px;width:236px;height:16px;z-index:174;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:13px;">Введите размер помещения*</span></div>
               <div id="wb_indexText55" style="position:absolute;left:7px;top:10px;width:562px;height:45px;text-align:center;z-index:175;">
                  <span style="color:#FFFFFF;font-family:Verdana;font-size:21px;">Перенос розеток под новую кухню с <br></span><span style="color:#FFFFFF;font-family:Verdana;font-size:17px;">дополнительными линиями для мощных электроприборов</span></div>
               <div id="wb_indexText56" style="position:absolute;left:22px;top:87px;width:136px;height:21px;z-index:176;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:17px;"><strong>от 8500 сом</strong></span></div>
               <input type="submit" id="indexButton12" name="" value="Расчитать стоимость услуг" style="position:absolute;left:319px;top:247px;width:255px;height:49px;z-index:177;">
            </form>
         </div>
         <div id="wb_indexShape15" style="position:absolute;left:0px;top:720px;width:62px;height:170px;z-index:181;">
            <div id="link5"><img src="images/img0019.png" id="indexShape15" alt="" style="width:62px;height:170px;"></div></div>
      </div>
   </div>
   <div id="indexLayer9" style="position:absolute;text-align:center;left:0%;top:2607px;width:100%;height:173px;z-index:258;min-width:1200px;">
      <div id="indexLayer9_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
      </div>
   </div>
   <div id="indexLayer10" style="position:absolute;text-align:center;left:0%;top:3975px;width:100%;height:631px;z-index:259;min-width:1200px;">
      <div id="indexLayer10_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexText57" style="position:absolute;left:305px;top:24px;width:610px;height:56px;text-align:center;z-index:232;">
            <span style="color:#363636;font-family:Sochi2014;font-size:48px;"><strong>ПРОЦЕСС РАБОТЫ:</strong></span></div>
         <div id="wb_indexCssMenu4" style="position:absolute;left:77px;top:175px;width:190px;height:50px;text-align:center;z-index:233;">
            <ul>
               <li class="firstmain"><a href="javascript:displaylightbox('./zvonok.php',{width:980,height:520,scrolling:'no'})" target="_self">.</a>
               </li>
            </ul>
            <br>
         </div>
         <div id="wb_indexText59" style="position:absolute;left:42px;top:248px;width:248px;height:127px;text-align:center;z-index:234;">
            <span style="color:#000000;font-family:Verdana;font-size:19px;">Вы Оставляете&nbsp; заявку на сайте или<br>звоните по телефону:</span><span style="color:#FFFFFF;font-family:Verdana;font-size:21px;"><br></span><span style="color:#000000;font-family:Tahoma;font-size:24px;"><strong>0 557 17 38 38<br>0 312 58 63 88</strong></span></div>
         <div id="wb_indexText60" style="position:absolute;left:332px;top:244px;width:247px;height:161px;text-align:center;z-index:235;">
            <span style="color:#000000;font-family:Verdana;font-size:19px;">Наш бригадир БЕСПЛАТНО выедет на объект, все замерит,&nbsp; уточняет все детали. Оговаривается цена и <br>сроки выполнения работ</span></div>
         <div id="wb_indexText61" style="position:absolute;left:611px;top:250px;width:281px;height:23px;text-align:center;z-index:236;">
            <span style="color:#000000;font-family:Verdana;font-size:19px;">Согласование договора</span></div>
         <div id="wb_indexText62" style="position:absolute;left:928px;top:251px;width:247px;height:46px;text-align:center;z-index:237;">
            <span style="color:#000000;font-family:Verdana;font-size:19px;">Выполнение работ <br>точно в срок</span></div>
         <div id="wb_indexText63" style="position:absolute;left:431px;top:547px;width:335px;height:46px;text-align:center;z-index:238;">
            <span style="color:#000000;font-family:Verdana;font-size:19px;">Сдача готового объекта <br>и окончательный расчет</span></div>
      </div>
   </div>
   <div id="indexLayer12" style="position:absolute;text-align:center;left:0%;top:4603px;width:100%;height:631px;z-index:260;min-width:1200px;">
      <div id="indexLayer12_Container" style="width:1211px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexText65" style="position:absolute;left:302px;top:439px;width:610px;height:63px;text-align:center;z-index:244;">
            <span style="color:#363636;font-family:Sochi2014;font-size:48px;"><strong>КАК НАС НАЙТИ</strong></span></div>
         <div id="wb_indexForm13" style="position:absolute;left:399px;top:23px;width:468px;height:377px;z-index:245;">
            <form name="Form12" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm13">
               <input type="hidden" name="formid" value="indexform13">
               <div id="wb_indexText34" style="position:absolute;left:49px;top:177px;width:300px;height:28px;z-index:239;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Tahoma;font-size:12px;"><strong>&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон, он будет являться идентификатором для получения скидки*</strong></span></div>
               <input type="tel" id="indexEditbox23" style="position:absolute;left:29px;top:222px;width:276px;height:47px;line-height:47px;z-index:240;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
               <input type="submit" id="indexButton13" name="" value="Расчитать стоимость услуг" style="position:absolute;left:24px;top:280px;width:319px;height:52px;z-index:241;">
               <div id="wb_indexText33" style="position:absolute;left:27px;top:20px;width:352px;height:46px;z-index:242;text-align:left;">
                  <span style="color:#FFD700;font-family:Verdana;font-size:19px;"><strong>Закажите расчет стоимости <br>услуг сейчас и получите</strong></span></div>
               <div id="wb_indexImage4" style="position:absolute;left:267px;top:0px;width:152px;height:333px;z-index:243;">
                  <img src="images/voltmetr.png" id="indexImage4" alt=""></div>
            </form>
         </div>
      </div>
   </div>
   <div id="container">
      <div id="wb_indexShape16" style="position:absolute;left:0px;top:0px;width:295px;height:63px;z-index:261;">
         <div id="link1"><img src="images/img0020.png" id="indexShape16" alt="" style="width:295px;height:63px;"></div>
      </div>
      <div id="wb_indexShape17" style="position:absolute;left:0px;top:0px;width:47px;height:94px;z-index:262;">
         <div id="link1"><a href="#link1"><img src="images/img0021.png" id="indexShape17" alt="" style="width:47px;height:94px;"></a></div>
      </div>
      <div id="wb_indexText2" style="position:absolute;left:177px;top:3153px;width:851px;height:74px;text-align:center;z-index:263;">
         <span style="color:#FFFFFF;font-family:Sochi2014;font-size:32px;"><strong>ЦЕНЫ НА НАИБОЛЕЕ ВОСТРЕБОВАННЫЕ УСЛУГИ<br>НАШИХ КЛИЕНТОВ</strong></span>
      </div>
      <div id="wb_indexShape12" style="position:absolute;left:0px;top:1268px;width:62px;height:170px;z-index:264;">
         <div id="link3"><img src="images/img0016.png" id="indexShape12" alt="" style="width:62px;height:170px;"></div>
      </div>
      <div id="wb_indexShape14" style="position:absolute;left:0px;top:3051px;width:62px;height:170px;z-index:265;">
         <div id="link4"><img src="images/img0018.png" id="indexShape14" alt="" style="width:62px;height:170px;"></div>
      </div>
   </div>
   <div id="indexLayer5" style="position:fixed;text-align:center;left:0;top:0;right:0;height:48px;z-index:266;min-width:1200px;">
      <div id="indexLayer5_Container" style="width:1200px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
         <div id="wb_indexCssMenu1" style="position:absolute;left:8px;top:9px;width:1185px;height:28px;text-align:center;z-index:231;">
            <ul>
               <li class="firstmain"><a href="#link1" target="_self">&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;</a>
               </li>
               <li><a href="#link2" target="_self">&#1055;&#1086;&#1095;&#1077;&#1084;&#1091;&nbsp;&#1052;&#1067;?</a>
               </li>
               <li><a href="#link3" target="_self">&#1056;&#1086;&#1076;&nbsp;&#1076;&#1077;&#1103;&#1090;&#1077;&#1083;&#1100;&#1085;&#1086;&#1089;&#1090;&#1080;</a>
               </li>
               <li><a href="#link4" target="_self">&#1062;&#1077;&#1085;&#1099;&nbsp;&#1085;&#1072;&nbsp;&#1091;&#1089;&#1083;&#1091;&#1075;&#1080;</a>
               </li>
               <li><a href="#link5" target="_self">&#1055;&#1086;&#1088;&#1103;&#1076;&#1086;&#1082;&nbsp;&#1088;&#1072;&#1073;&#1086;&#1090;&#1099;</a>
               </li>
               <li><a href="#link6" target="_self">&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1099;</a>
               </li>
            </ul>
            <br>
         </div>
      </div>
   </div>
</body>
</html>