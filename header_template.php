<?php
// header template
?>
<div style="background-image:url(style/headerStrip.jpg); height:50px; border-bottom:#999 1px solid;">
<table width="900" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="169"><a href="http://<?php echo $dyn_www; ?>"><img src="images/logo2.png" width="156" height="48" border="0" /></a></td>
    <td width="513">
   <div class="headerBtns" style="margin-top:12px;"> 
   	<a href="http://<?php echo $dyn_www; ?>/index.php">Home</a>
    <a href="http://<?php echo $dyn_www; ?>/about.php">About</a>
    <a href="http://<?php echo $dyn_www; ?>/member_search.php">Members</a>
    <a href="http://<?php echo $dyn_www; ?>/source_files.zip">Download</a>
    <a href="http://<?php echo $dyn_www; ?>/#">Screenshots</a>
    </div>
    </td>
    <td width="216"><div align="right" style="margin-bottom:12px;">&nbsp;<?php echo $logOptions; ?></div></td>
  </tr>
</table>
</div>