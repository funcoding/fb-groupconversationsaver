<?php
    require 'facebook.php';
    $facebook = new Facebook(array(
  'appId'  => '105699709587292',
  'secret' => '6a54569e99c72cf21724d46d25c1f899',
      'cookie' => false,
   ));
$APP_ID=334896846595020;
   //ovewrites the cookie
   $facebook->getUser(null);
 $_SESSION['fb_'.$APP_ID.'_user_id'] = '';
$_SESSION['fb_'.$APP_ID.'_access_token'] = '';  

   //redirects to index
   header('Location: http://xplorers.host22.com');
?>
