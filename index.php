 <?php
require 'facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => 'App Id',
  'secret' => 'App Secret',
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
  'scope' => 'user_groups ,publish_stream,email'
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
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# conversationsaver: http://ogp.me/ns/fb/conversationsaver#">
  <meta property="fb:app_id"      content="334896846595020" /> 
  <meta property="og:type"        content="conversationsaver:group_post" /> 
  <meta property="og:url"         content="http://xplorers.host22.com" /> 
  <meta property="og:title"       content="Facebook conversation saver" /> 
  <meta property="og:image"       content="https://s-static.ak.fbcdn.net/images/devsite/attachment_blank.png" /> 
  <meta property="og:description" content="Extract and Save those specific post from your facebook group wall which you think will be important for future reference" /> 
<link rel="shortcut icon" href="http://xplorers.host22.com/logo.jpg" />
<title>Conversation Grabber</title>
<script type="text/javascript" src="jquery-1.8.0.js"></script>
<script type="text/javascript">
function showDiv() {
   document.getElementById('Search').style.display = "block";
}
</script>
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
<a title="Report for bugs,improvements etc" style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;" target="_blank" href="https://www.yourlink.com"> Contact Us &nbsp;&nbsp; </a>  
  <a style="color:#006;font-weight:900;font-size:small;float:right; text-decoration:none;" href="https://yourlink.com">Home&nbsp;&nbsp;&nbsp;</a>
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
    
      <li><a href="https://yourlink.com/?page=0&group=<?php echo($grsorted[$i][2]); ?>&name=<?php 
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
                if(!isset($groupp))
        {
                ?>
    
<h1>&nbsp;&nbsp;Facebook Conversation Saver</h1>
         <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conversation 
		 Saver is used to save and download specific posts from facebook groups.
		 Saved Posts will be sent as attachment to users email id. Select a group from list and start saving those posts which you think are important.</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
  <p>&nbsp;</p>
    <?php
        }
        else
{$curPage = $_REQUEST["page"];
$offset = $curPage * 25;
$nextPage = $curPage + 1;
if ($curPage > 0) {
  $prevPage = $curPage - 1;
 
} else {
  $prevPage = 0;
 
} 

$t=$offset+25;
	$response = $facebook->api('/'.$groupp.'/feed?limit='.$t.'&offset='.$offset);
	?>
  <div class="content">
  <form method="get" action="search.php">

<div id="Search"  style="display:none;"  >
   &nbsp;&nbsp; <input type="text" name="q"/></div>
    

  <div class="fadeOutbox">
    <input style="background:transparent;border:none;text-decoration:underline;color:blue; cursor:pointer;" type="button" class="Search" name="search" value="Search Group" onClick="showDiv()" />
  </div>

<input type="hidden" name="group" value="<?php echo($groupp) ?>" >
<input type="hidden" name="groupname" value="<?php echo($groupname) ?>">
<input type="hidden" name="page" value=0>
</form>  
<script type="text/javascript">
$(".fadeOutbox").click(function () {
   $(this).hide("fast");
});
</script>
<?php if($curPage!=0) {?> 
      <p> <a style="font-weight:800; color:#000;text-decoration:none;"href="https://yourlink.com/?page=<?php echo($prevPage);?>&group=<?php echo($groupp); ?>&name=<?php 
	  echo($groupname); ?>"><-- previous page &nbsp;&nbsp;</a>  <?php } ?>
      <?php
	  if(is_array($response['data'][1]))
	  {?>
      <a style="font-weight:800;color:#000;text-decoration:none; float:right;" href="https://yourlink.com/?page=<?php echo($nextPage);?>&group=<?php echo($groupp); ?>&name=<?php 
	  
	  echo($groupname); ?>">next page --></a></p> <?php } ?>
    <h1><?php echo(stripslashes($groupname));?></h1>
    <?php
        
         foreach ($response['data'] as $value) {
        
	if(isset($value['link']))
{$link='</br>'."Link:".$value['link'].'<br>';
}
else
{$link=NULL;}	
if($value['likes']['count']>0)
   {
   $likes="[Total likes:".$value['likes']['count']."]";
   
   }
else
{
	$likes=NULL;
}
if(isset($value['name']))
{$vname='<br>'.$value['name'];}
else
{$vname=NULL;}
if(isset($value['caption']))
{$caption='<br>'.$value['caption'];}
else
{$caption=NULL;}
if(isset($value['message']))
{
        ?>
    </p>
    <form method="post" action="">
      <p name="who"><?php echo('<strong>'.$value['from']['name'].'</strong>'); ?> posted:</p>
    <p name="message1"><?php echo(stripslashes(htmlspecialchars($value['message'])).'&nbsp;'.$likes.$vname.$caption.$link);  ?>
	<input style="  color:#03F;
    font-weight:bold;
text-decoration: underline;" title="Extract and mail the post" type="submit"  value="Save post" 
        name="submit"/>
        <?php if($value['comments']['data'][0]['from']['name'])
        {
        ?>
    <p>Comments:</p>
    <?php
        for($i=0;$i<count($value['comments']['data']);$i++)
      {?>
    <p name="comments"><?php echo('<strong>'.$value['comments']['data'][$i]['from']['name']); ?> commented:<?php 
 echo('</strong>'.htmlspecialchars($value['comments']['data'][$i]['message']));
 if(isset($value['comments']['data'][$i]['likes']))
 {echo('<br>'."[Likes: ".$value['comments']['data'][$i]['likes']."]");}
echo('<br>');
?>
<input type="hidden" value="<?php echo($value['comments']['data'][$i]['from']['name']);  ?>" name="name2<?php echo($i); ?>"/>
      <input type="hidden" value="<?php echo(strip_tags(stripslashes(htmlspecialchars($value['comments']['data'][$i]['message']))));
          if(isset($value['comments']['data'][$i]['likes']))
 {echo(" [Likes: ".$value['comments']['data'][$i]['likes']."]");}  ?>" name="message2<?php echo($i); ?>"/>
        <input type="hidden" value="<?php echo($i);  ?>" name="count"/>
        
  

<?php
}}
else
{echo('<br>'."Comments:".'<br>'.'&nbsp;&nbsp;'."No Comments Yet");}
echo('<hr>');
        }
?>

   <input type="hidden" value="<?php echo($value['from']['name']);  ?>" name="name1"/>
      <input type="hidden" value="<?php echo(htmlentities($value['message']).$likes);  ?>" name="comments"/> 
	<input type="hidden" value="<?php echo($value['name']);  ?>" name="name1name"/>
	<input type="hidden" value="<?php echo($value['caption']);  ?>" name="name1caption"/>
	<input type="hidden" value="<?php echo($link);  ?>" name="name1link"/>
      <input type="hidden" value="<?php echo($uemail);  ?>" name="useremail"/> 
        <input type="hidden" value="<?php echo($filenam);  ?>" name="data"/>  
 
  </form>  
      <?php }}
          ?>  
      
    <p>&nbsp;</p>
    <?php if($curPage!=0) {?> 
      <p> <a style="font-weight:800; color:#000;text-decoration:none;"href="https://yourlink.com/?page=<?php echo($prevPage);?>&group=<?php echo($groupp); ?>&name=<?php 
	  echo($groupname); ?>"><-- previous page &nbsp;&nbsp;</a>  <?php } ?>
      <?php
	  if(is_array($response['data'][1]))
	  {?>
      <a style="font-weight:800;color:#000;text-decoration:none; float:right;" href="https://yourlink.com/?page=<?php echo($nextPage);?>&group=<?php echo($groupp); ?>&name=<?php 
	  
	  echo($groupname); ?>">next page --></a></p> <?php } ?>
    <!-- end .content --></div>
  <div class="footer">
    <p>&nbsp;</p>
	<p style="color:#ffffff;">&copy; 2012 Facebook Conversation Saver</p>
    <!-- end .footer --></div>
<!-- end .container --></div>
 
</body>
</html>


