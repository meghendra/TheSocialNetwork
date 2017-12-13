<?php  //index.php
/*------------------------------------------------------------------------------------------------*/
// Start_session, check if user is logged in or not, and connect to the database all in one included file
include_once("scripts/checkuserlog.php");
// Include the class files for auto making links out of full URLs and for Time Ago date formatting
include_once("wi_class_files/autoMakeLinks.php");
include_once ("wi_class_files/agoTimeFormat.php");
// Create the two objects before we can use them below in this script
$activeLinkObject = new autoActiveLink;
$myObject = new convertToAgo; 
?>
<?php
// Include this script for random member display on home page
include_once "scripts/homePage_randomMembers.php"; 
?>
<?php
$sql_blabs = mysql_query("SELECT * FROM blabbing ORDER BY blab_date DESC LIMIT 10");

$blabberDisplayList = ""; // Initialize the variable here

while($row = mysql_fetch_array($sql_blabs)){
	
	$blabid = $row["id"];
	$uid = $row["mem_id"];
	$the_blab = $row["the_blab"];
	//$the_blab = substr($the_blab, 0, 48);
	$the_blab = wordwrap($the_blab, 30, "\n", true);
	//$the_blab = wordwrap($the_blab, 14, "<br />\n");
	$notokinarray = array("fag", "gay", "shit", "fuck", "stupid", "idiot", "asshole", "cunt", "douche");
    $okinarray   = array("sorcerer", "grey", "shug", "farg", "smart", "awesome guy", "butthole", "cake", "dude");
	$the_blab = str_replace($notokinarray, $okinarray, $the_blab);
	$the_blab = ($activeLinkObject -> makeActiveLink($the_blab));
	$blab_date = $row["blab_date"];
	$convertedTime = ($myObject -> convert_datetime($blab_date));
    $whenBlab = ($myObject -> makeAgo($convertedTime));
	$blab_type = $row["blab_type"];
	$blab_device = $row["device"];
	
	// Inner sql query
	$sql_mem_data = mysql_query("SELECT id, username, firstname, lastname FROM myMembers WHERE id='$uid' LIMIT 1");
	while($row = mysql_fetch_array($sql_mem_data)){
			$uid = $row["id"];
			$username = $row["username"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			if ($firstname != "") {$username = "$firstname $lastname"; } // (I added usernames late in  my system, this line is not needed for you)
			///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
			$ucheck_pic = "members/$uid/image01.jpg";
			$udefault_pic = "members/0/image01.jpg";
			if (file_exists($ucheck_pic)) {
			$blabber_pic = '<div style="overflow:hidden; width:40px; height:40px;"><img src="' . $ucheck_pic . '" width="40px" border="0" /></div>'; // forces picture to be 100px wide and no more
			} else {
			$blabber_pic = "<img src=\"$udefault_pic\" width=\"40px\" height=\"40px\" border=\"0\" />"; // forces default picture to be 100px wide and no more
			}
	
			$blabberDisplayList .= '
      			<table width="100%" align="center" cellpadding="4" style="background-color:#CCCCCC; border:#999 1px solid;">
        <tr>
          <td width="7%" bgcolor="#FFFFFF" valign="top"><a href="profile.php?id=' . $uid . '">' . $blabber_pic . '</a>
          </td>
          <td width="93%" bgcolor="#F9F9F9" style="line-height:1.5em;" valign="top">
		 <span class="liteGreyColor textsize9"> ' . $whenBlab . ' <a href="profile.php?id=' . $uid . '"><strong>' . $username . '</strong></a> <br />
          via <em>' . $blab_device . '</em></span><br />
         <span class="textsize10"> ' . $the_blab . '</span>
            </td>
        </tr>
      </table>';
			}
	
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Description" content="" />
<meta name="Keywords" content="" />
<title>The Social Network- Social Network Community Building</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
<script src="js/jquery-1.4.2.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript"> 
function toggleSlideBox(x) {
		if ($('#'+x).is(":hidden")) {
			//$(".sourceBox").slideUp(200);
			$('#'+x).slideDown(300);
		} else {
			$('#'+x).slideUp(300);
		}
}
</script>
<style type="text/css">
<!--
.style1 {
	color: #000000;
	font-style: italic;
	font-weight: bold;
}
.style3 {color: #CC0033}
.style4 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?php include_once "header_template.php"; ?>

<table width="920" style="background-color:#F2F2F2;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>

    <td width="732" valign="top">
<div class="textsize16 greenColor" style="border:#999 1px solid; width:728px; border-top:none; border-bottom:none;"><img src="images/web_intersect_2.jpg" width="728" height="152" alt="The Social Network: Free Social Networking System" /></div>

<div id="sb1" style="display:none; width:704px; border:#999 1px solid; padding:12px; background-image:url(style/area1BG.jpg); line-height:1.5em; ">The Social Network is an open source social network website, and web community package for people worldwide.<br />
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:5px;">
  <tr>
      <td width="34%"><strong>&bull; Registration System</strong><span class="textsize10"> (php  mysql)</span><strong><br />
        &bull; Activation System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
        &bull; Login w/ keep log System</strong> <span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; Friend System</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Private Message System </strong><span class="textsize10">(php  mysql)</span><strong><br />
&bull; API and Gadget Systems </strong><span class="textsize10">(php  mysql)</span></td>
    <td width="33%"><strong>&bull; Profile EditingSystem</strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull; Member Listing System </strong> <span class="textsize10">(php  mysql)</span><strong><br />
&bull;Status System</strong> <span class="textsize10">(php  mysql)</span></td>
    </tr>
</table>
</div>
<div style="width:728px; border:#999 1px solid; border-bottom:none;"></div>
<table style="background-color:#EFEFEF; border:#999 thin solid; padding:10px; line-height:1.5em;" width="730" border="0" cellspacing="0" cellpadding="8">
  <tr>
      <td width="45%" valign="top"><br />
      <div style="font-size:15px; margin-bottom:5px;"><strong>Some Of Our Members</strong></div>        
        <?php  print "$MemberDisplayList"; ?><br />
         <div style="font-size:15px; margin-bottom:5px;"><strong>The Blabbers</strong></div>
         <div style="font-size:10px; margin-bottom:5px;"><strong>These are not to be  believed.</strong></div>
         <div style="width:284px; overflow:hidden; border: #999 thin solid;"> <?php echo "$blabberDisplayList"; ?></div>
         <br />        </td>
      <td width="55%" valign="top" style="font-size:10px;">
      <div style="font-size:15px; margin-bottom:5px;"><strong>What is The Social Network? </strong><strong></strong></div>
      <div style="font-size:12px;">
        <p class="style1">TSN is an online community website, which anyone can join for free. All you need is a valid email ID. </p>
        <p class="style1">&nbsp;</p>
        <p class="greenColor style4">LATEST UPDATES:</p>
        <p class="greenColor style4">&nbsp;</p>
        <ul>
          <ul>
            <li><strong><span class="style3">Background</span> added.</strong></li>
            <li><strong>Wanna see somthing cool hover your mouse pointer over the right side bar and see things in action. <span class="style3">(This a'int Flash people)-&gt;</span></strong></li>
            <li><strong>The <a href="about.php">About</a> page has been updated. </strong></li>
            <li><strong>Operating system and browser detector are online, to see things in action <a href="register.php">signup</a> and/or  <a href="login.php">login</a>, and take a look at the footer.</strong></li>
            <li><strong>Hitcounter added to the page footer.</strong></li>
            <li><strong><span class="style3">Sourcefiles</span> are now available for download click <a href="source_files.zip">here</a></strong> <strong>or push the Download button on the top menu bar. </strong></li>
            <li><strong><span class="style3"><a href="favicon.ico">Favicon</a></span> added to see it in action visit <a href="http://www.megh16.0fees.net/index.php">the original URL</a>.</strong><br />
            </li>
          </ul>
        </ul>
        </div>
      <br />
      <div style="font-size:15px; margin-bottom:5px;"></div>        </td>
    </tr>
  </table></td>
    <td width="188" valign="top"><img src="images/bg.png" width="188" height="782" border="0" /><script src="js/jquery.min.js"></script>
	<script src="js/jquery.jparallax.js"></script>
	<link rel="stylesheet" href="style/plx.css" type="text/css"/>

	    
		<div id="parallax">
		
			<img src="images/layer4.png" width="169" height="738" border="0">  
 			<img src="images/layer3.png" width="159" height="728" border="0">
 			<img src="images/layer2.png" width="149" height="718" border="0">
    		<img src="images/layer1.png" width="139" height="698" border="0">
    	</div>
	
      <script>
jQuery(document).ready(function(){
  jQuery('#parallax').jparallax();
});
    </script>
	  <br />
      
    <center></center>    </td></tr>
</table>
<?php include_once "footer_template.php"; ?>
</body>
</html>