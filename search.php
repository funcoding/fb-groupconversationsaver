 <?php
echo("hi");
$search=$_GET['q'];
$search=preg_replace("/[^a-zA-Z0-9]/","",$search);
echo($search.'<br>');
require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '105699709587292',
  'secret' => '6a54569e99c72cf21724d46d25c1f899',
 ));

//Get User ID
$user = $facebook->getUser();

if($user != 0) {
  try {
    $data = $facebook->api('/me/groups');
        $data2=$facebook->api('/me');
  } catch (Exception $e) {
      $data = NULL; 
	
  
  }
}

//Add code to also request access 
//for the user's email id
if($data == NULL) {$params = array(
  'scope' => 'user_groups ,publish_stream,email,read_stream'
);

$loginUrl = $facebook->getLoginUrl($params);
  header("refresh:0;url=$loginUrl");  //Redirects to login page
  return;
}
$logoutUrl = $facebook->getLogoutUrl(array(
    'next'=>'http://xplorers.host22.com/logout.php'
));
$group=$data['data'];
$uemail=$data2['email'];
$filenam=$data2['id'];


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Conversation Grabber</title>
<style type="text/css">
<!--
body {
	background-color: #4E5869;
	margin: 0;
	padding: 0;
	color: #000;
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	font-size: smaller;
	line-height: 1.4;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { 
        padding: 0;
        margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
        margin-top: 0;  
        padding-right: 15px;
        padding-left: 15px; 
}
a img { 
        border: none;
}

a:link {
        color:#414958;
        text-decoration: underline; 
}
a:visited {
	color: #4E5869;
	text-decoration: underline;
}
a:hover, a:active, a:focus { 
        text-decoration: none;
}

.container {
        width: 80%;
        max-width: 1260px;
        min-width: 780px;
        background-color: #FFF;
        margin: 0 auto; 
}

.header {
        background-color: #6F7D94;
}

.sidebar1 {
        float: left;
        width: 20%;
        background-color: #93A5C4;
        padding-bottom: 10px;
}
.content {
        padding: 10px 0;
        width: 80%;
        float: left;
}

.content ul, .content ol { 
        padding: 0 15px 15px 40px; 
}

ul.nav {
        list-style: none; 
        border-top: 1px solid #666; 
        margin-bottom: 15px; 
}
ul.nav li {
        border-bottom: 1px solid #666; 
}
ul.nav a, ul.nav a:visited { 
        padding: 5px 5px 5px 15px;
        display: block; 
        text-decoration: none;
        background-color: #8090AB;
        color: #000;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { 
        background-color: #6F7D94;
        color: #FFF;
}

/* ~~ The footer ~~ */
.footer {
        padding: 10px 0;
        background-color: #6F7D94;
        position: relative;
        clear: both; 

.fltrt {  
        float: right;
        margin-left: 8px;
}
.fltlft { 
        float: left;
        margin-right: 8px;
}
.clearfloat {
        clear:both;
        height:0;
        font-size: 1px;
        line-height: 0px;
}
-->
</style><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } 
ul.nav a { zoom: 1; } 
</style>
<![endif]--></head>

<body>

<div class="container">
  <div class="header" style="font-size: 20px; font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">
    <header  width="20%" height="90"  style=" background-color: #8090AB; display:block;" />
            
Select Group
  </header>
  <a title="logging out will also log you out from your facebook account" style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;"href="<?php echo($logoutUrl); ?>"> Log Out &nbsp;&nbsp; </a>
  </div>
  <div class="sidebar1">
    <ul class="nav">
    <?php
	
        for($i=0;$i<count($group);$i++)
{$grou[$i]=array($group[$i]['id'],$group[$i]['name']);
$grsorted[$i]=array(preg_replace('/[^a-zA-Z0-9]/', '',$grou[$i][1]),$grou[$i][1],$grou[$i][0]);}
if(isset($grsorted))
{sort($grsorted);}
else
{echo("No Group Present");}
	
for($i=0;$i<count($group);$i++)
{
?>
    
      <li><a href="http://xplorers.host22.com/?page=0&group=<?php echo($grsorted[$i][2]); ?>&name=<?php 
	  echo($grsorted[$i][1]); ?>"><?php echo($grsorted[$i][1]); ?></a></li>
    <?php
        }

        ?>
      
    </ul>
    
    <p> </p>
    <p></p>
  <!-- end .sidebar1 --></div>
    <?php
        
        $groupp=$_GET['group'];
        
        $groupname=$_GET['name'];
                
                ?>
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fxplorers.host22.com%2F&amp;send=false&amp;layout=button_count&amp;width=250&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=334896846595020" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:21px;" allowTransparency="true"></iframe>    
<h1>&nbsp;&nbsp;</h1>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
  <p>&nbsp;</p>
    <?php
        
        

	$response = $facebook->api('/'.$groupp.'/feed?limit=5000');


	
	?>
  <div class="content">
<?php ?> 
      
      

    <?php
        #echo(array_search($search,$response['data']));
	?>

<?php
$i=0;
foreach($response['data'] as $response1)
{if (preg_match("/\b$search\b/i", $response1['message']) || preg_match("/\b$search\b/i", $response1['from']['name']))
{$check[$i]=$response1['message'];
echo('<strong>'.$response1['from']['name'].'</strong>'." posted: ".'<br>'.htmlspecialchars($response1['message']).'<br>');
echo("Comments:".'<br>');
if($response1['comments']['data'][0]['from']['name'])
{foreach($response1['comments']['data'] as $response2)
{

echo('<strong>'.$response2['from']['name']." commented: ".'</strong>'.htmlspecialchars($response2['message']).'<br>');
}
echo('<hr>');}
else
{echo("No Comments Yet");
echo('<hr>');}

}
}


 foreach($response['data'] as $response3)
{if(isset($response3['comments']['data']))
{

foreach($response3['comments']['data'] as $response4)
{if (preg_match("/\b$search\b/i", $response4['message']) || preg_match("/\b$search\b/i", $response4['from']['name']))
{if(!in_array($response3['message'],$check))
{
echo('<strong>'.$response3['from']['name'].'</strong>'." posted:".'<br>'.htmlspecialchars($response3['message']).'<br>');
echo("Comments:".'<br>');
if($response3['comments']['data'][0]['from']['name'])
{foreach($response3['comments']['data'] as $response5)
{
echo('<strong>'.$response5['from']['name']." commented: ".'</strong>'.htmlspecialchars($response5['message']).'<br>');
}
echo('<hr>');}
else
{echo("No Comments Yet");
echo('<hr>');}
}



break;}
}}}	
        
	 
       
		 ?>
    <!-- end .content --></div>
  <div class="footer">
    <p>&nbsp;</p>
	<p style="color:#ffffff;">&copy; 2012 Facebook Conversation Saver</p>
    <!-- end .footer --></div>
<!-- end .container --></div>
 
</body>
</html>



