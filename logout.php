<?php
    require 'facebook.php';
    $facebook = new Facebook(array(
  'appId'  => 'App Id',
  'secret' => 'App Secret',
      'cookie' => false,
   ));
$APP_ID=334896846595020;
   //ovewrites the cookie
   $facebook->getUser(null);
 $_SESSION['fb_'.$APP_ID.'_user_id'] = '';
$_SESSION['fb_'.$APP_ID.'_access_token'] = '';  

   //redirects to index
   header('Location: https://fbgroupconversationsaver-fbapps.rhcloud.com/');
?>
