<?php
include "globals.php";
?>
 <script>
        $(document).ready(function() {
             $('#err').hide();
             $('#succ').hide();
        
         
        $('.delete').on('click',function() {
            var ajaxUrl = "ajax/ajax_eventsfunc.php" + $(this).attr('data-href');

            $.ajax({
                type: "GET",
                url: ajaxUrl,   
                data: "id=" + $(this).attr("data-id"), 
                success: function(data) {
                         var status = JSON.parse(data);
                    console.log(data);
                    $('#err').hide();
                    $('#succ').html(status.success);
                    $('#succ').show();
                    if (typeof status.error != "undefined") {
                        $('#succ').hide();
                        $('#err').html(status.error);
                        $('#err').show();
                    }
                }
            });
        });
        });
        
       
      </script>
<?php
      print" <div align='right'>
                        
                        	<a class='delete' href='#' data-href='?action=delall' data-id='{$r['evID']}' style='padding: 5px 17px;font-size: 10px;text-transform:uppercase;font-weight:600;border: 1px solid #111;background-color:darkred;'>Clear Events</a>
                        
                    </div>";
                    ?>
                                <div style="clear: both;"></div><br />
                                <div id="err"></div><div id="succ"></div>
<br />
<?php


$q=$conn->query("SELECT * FROM events WHERE evUSER=$userid ORDER BY evTIME DESC LIMIT 27;");
print"
<table class='tableinbox' width='100%'>
		 <tr>
<th colspan='3' class='tablehead'>Events</th>
</tr>
<tr>
<th>Details</th>
<th>Time</th>
</tr>";
if(mysqli_num_rows($q)==0)
{
    print"<tr><td colspan='3'>No events available</td></tr></table>";
}
else {
while($r = $q->fetch_assoc()) {
	if (!$r['evREAD']){
	    
	    if($r['evTIME'] > 0)
{
$la=time()-$r['evTIME'];
$unit="secs";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="mins";
}
if($la >= 60)
{
$la=(int) ($la/60);
$unit="hours";
if($la >= 24)
{
$la=(int) ($la/24);
$unit="days";
}
}
$str="$la $unit ago";
}
else
{
  $str="N/A";
}
		  print "
		  <tr>
		  <td width='80%'>
		 ".$conn->real_escape_string($r['evTEXT'])."
	
</td>
<td width='20%' align='center'> <b><font color=orange>NEW!</b></font><br />
<span style='font-size:9px;color:#999;'>$str<br />
<a class='delete' href='#' data-href='?action=delete' data-id='".abs(@intval($r['evID']))."'>Delete</a></span>
</td>";
		  print "</tr>";
	  } else {
	          if($r['evTIME'] > 0)
{
$la=time()-$r['evTIME'];
$unit="secs";
if($la >= 60)
{
$la=(int) ($la/60);
$unit="mins";
}
if($la >= 60)
{
$la=(int) ($la/60);
$unit="hours";
if($la >= 24)
{
$la=(int) ($la/24);
$unit="days";
}
}
$str="$la $unit ago";
}
else
{ 
  $str="N/A";
}
		 	  print "
		  <tr>
		  <td width='80%'>
		 ".$conn->real_escape_string($r['evTEXT'])."
	
</td>
<td width='20%' align='center'>
<span style='font-size:9px;color:#999;'>$str
<br />
<a class='delete' href='#' data-href='?action=delete' data-id='".abs(@intval($r['evID']))."'>Delete</a></span>
</td>";
		  print "</tr>";
  	
}
}
	$conn->query("UPDATE events SET evREAD=1 WHERE evUSER=$userid");
print"</table>";
}

$h->endpage();
?>