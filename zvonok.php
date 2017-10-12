<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['formid'] == 'indexform2')
{
   $mailto = 'alladinstroi@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'ЭЛЕКТРОМОНТАЖ Заказ обратного звонка с сайта';
   $message = 'Заказ обратного звонка с сайта';
   $success_url = './zvonok-otpravlen.php';
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
<html>
<head>
<meta charset="utf-8">
<title>Услуги компании</title>
<meta name="description" content="Профессиональные Электромонтажные работы в Кыргызстане">
<meta name="keywords" content="Профессиональные Электромонтажные работы в Кыргызстане">
<meta name="generator" content="Профессиональные Электромонтажные работы в Кыргызстане">
<style>
div#container
{
   width: 1000px;
   position: relative;
   margin: 0 auto 0 auto;
   text-align: left;
}
body
{
   background-color: #000000;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   text-align: center;
}
</style>
<link href="wb.validation.css" rel="stylesheet">
<link href="electro.css" rel="stylesheet">
<style>
#zvonokLayer1
{
   background-color: transparent;
   background-image: url(images/zayavka_zvonok_1.png);
   background-repeat: repeat;
   background-position: left top;
}
#indexShape8
{
   border-width: 0;
}
#wb_indexText5 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText5 div
{
   text-align: left;
}
#wb_indexText6 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_indexText6 div
{
   text-align: left;
}
#indexButton2
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
   font-size: 20px;
}
#wb_indexText8 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_indexText8 div
{
   text-align: center;
}
#indexEditbox5
{
   border: 3px #A9A9A9 ridge;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 19px;
   padding: 0px 17px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
#wb_zvonokText2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: center;
}
#wb_zvonokText2 div
{
   text-align: center;
}
#wb_indexForm2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#indexEditbox4
{
   border: 3px #A9A9A9 ridge;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Tahoma;
   font-weight: bold;
   font-size: 19px;
   padding: 0px 17px 0px 12px;
   text-align: left;
   vertical-align: middle;
}
</style>
<script src="jquery-1.11.1.min.js"></script>
<script src="wb.validation.min.js"></script>
<script>
$(document).ready(function()
{
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
   $("#indexForm2").submit(function(event)
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
});
</script>
<!-- Yandex.Metrika counter -->
<script>
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter42513944 = new Ya.Metrika({
                    id:42513944,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
      <noscript><div><img src="https://mc.yandex.ru/watch/42513944" style="position:absolute; left:-9999px;" alt=""/></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>
   <div id="container">
      <div id="zvonokLayer1" style="position:absolute;text-align:left;left:0px;top:0px;width:1014px;height:519px;z-index:15;">
         <div id="wb_indexShape8" style="position:absolute;left:0px;top:0px;width:1011px;height:519px;filter:alpha(opacity=80);opacity:0.80;z-index:6;">
            <img src="images/img0008.png" id="indexShape8" alt="" style="width:1011px;height:519px;"></div>
         <div id="wb_zvonokText2" style="position:absolute;left:48px;top:61px;width:909px;height:84px;text-align:center;z-index:7;">
            <span style="color:#FFD700;font-family:Tahoma;font-size:35px;"><strong>ОСТАВЬТЕ ЗАЯВКУ<br></strong>И МЫ СВЯЖЕМСЯ С ВАМИ В БЛИЖАЙШЕЕ ВРЕМЯ</span></div>
         <div id="wb_indexForm2" style="position:absolute;left:262px;top:180px;width:466px;height:288px;z-index:8;">
            <form name="Form13" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="indexForm2">
               <input type="hidden" name="formid" value="indexform2">
               <div id="wb_indexText5" style="position:absolute;left:56px;top:13px;width:178px;height:16px;z-index:0;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Arial;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096;е имя*</span></div>
               <div id="wb_indexText6" style="position:absolute;left:57px;top:95px;width:178px;height:16px;z-index:1;text-align:left;">
                  <span style="color:#FFFFFF;font-family:Arial;font-size:13px;">&#1042;&#1074;&#1077;&#1076;&#1080;&#1090;&#1077; &#1042;&#1072;&#1096; телефон*</span></div>
               <input type="submit" id="indexButton2" name="" value="ЗАКАЗАТЬ ЗВОНОК" style="position:absolute;left:56px;top:182px;width:354px;height:60px;z-index:2;">
               <div id="wb_indexText8" style="position:absolute;left:0px;top:255px;width:460px;height:14px;text-align:center;z-index:3;">
                  <span style="color:#FFD700;font-family:Arial;font-size:11px;">* Ваши данные будут в безопасности и не будут переданы третьим лицам</span></div>
               <input type="text" id="indexEditbox5" style="position:absolute;left:57px;top:35px;width:317px;height:41px;line-height:41px;z-index:4;" name="Имя" value="" placeholder="&#1060;.&#1048;.&#1054;.">
               <input type="tel" id="indexEditbox4" style="position:absolute;left:57px;top:117px;width:317px;height:44px;line-height:44px;z-index:5;" name="Телефон" value="" placeholder="0 (&#8226;&#8226;&#8226;) &#8226;&#8226; &#8226;&#8226; &#8226;&#8226;">
            </form>
         </div>
      </div>
   </div>
</body>
</html>