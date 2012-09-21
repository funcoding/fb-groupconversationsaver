<?php
    require 'facebook.php';
    $facebook = new Facebook(array(
      'appId'  => '334896846595020',
  'secret' => 'ed7d180bbf5c7e5f8ad076a422e3e959',
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
