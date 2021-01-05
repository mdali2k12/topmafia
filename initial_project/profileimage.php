<?php
include"globals.php";
?>
      <script>
         $(document).ready(function() {
             $('#err').hide();
             $('#succ').hide();
         })
         var validateLogin = function() {
         
             var formData = new FormData(form);
         
             if ($('#imageurl').val() == "") {
                 $('#err').html("You did not enter anything!");
                 $('#err').show();
                 $('#succ').hide();
             } else {
                 $.ajax({
                     processData: false,
                     contentType: false,
                     url: 'ajax/ajax_image.php',
                     data: formData,
                     type: 'POST',
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
             }
         };
      </script>
        <?php
print "
<span class='informationhelp'><img src='https://topmafia.net/header/images/imageicons/info-black.png'> Any images that are not 100x100 will be automatically resized.</span>
";
echo"<div id='err'></div><div id='succ'></div><br />";
print"
<form action='' id='form' method='post'>
<table class='tableinbox' align='center' width='80%'>
<tr>
<th class='tablehead' colspan='2'>Profile Image</th>
</tr>
<tr>
<th>Image URL</th>
<td><input type='text' class='text-general3' id='imageurl' name='newpic' value='{$ir['display_pic']}' />
</td>
</tr>
<tr>
<td align='center' colspan='2'>
<input type='button' name='action' onclick='javascript:validateLogin();' class='buttonnormal' value='Update' /></td></tr></table></form>";

$h->endpage();
?>
