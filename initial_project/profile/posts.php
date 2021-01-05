<?php

class bbcode {
var $engine=""; 
function bbcode()
{
require "profile/bbcode_engine.php";
$this->engine= new bbcode_engine;
$this->engine->cust_tag("/</","<");
$this->engine->cust_tag("/>/",">");
//Since \n and <br> screw up preg, convert them out.
$this->engine->cust_tag("/\n/","&nbrlb;");
$this->engine->simple_bbcode_tag("b");
$this->engine->simple_bbcode_tag("i");  
$this->engine->simple_bbcode_tag("u");  
$this->engine->simple_bbcode_tag("s");
$this->engine->simple_bbcode_tag("sub");  
$this->engine->simple_bbcode_tag("sup");
$this->engine->simple_bbcode_tag("big");
$this->engine->simple_bbcode_tag("small"); 
$this->engine->adv_bbcode_tag("list","ul");
$this->engine->adv_bbcode_tag("olist","ol");
$this->engine->adv_bbcode_tag("item","li");
$this->engine->adv_option_tag("font","font","family");
$this->engine->adv_option_tag("size","font","size"); 
$this->engine->adv_option_tag("url","a","href");
$this->engine->adv_option_tag("color","font","color");
$this->engine->adv_option_tag("style","span","style");
$this->engine->simp_option_notext("img","src");
$this->engine->simp_bbcode_att("img","src");
$this->engine->cust_tag("/\(c\)/","&copy;");
$this->engine->cust_tag("/\(tm\)/","&#38;#153;");
$this->engine->cust_tag("/\(r\)/","&reg;");
$this->engine->adv_option_tag_em("email","a","href");
$this->engine->adv_bbcode_att_em("email","a","href");
$this->engine->cust_tag("/\[left\](.+?)\[\/left\]/","<div align='left'>\\1</div>");
$this->engine->cust_tag("/\[center\](.+?)\[\/center\]/","<div align='center'>\\1</div>");
$this->engine->cust_tag("/\[right\](.+?)\[\/right\]/","<div align='right'>\\1</div>");
$this->engine->cust_tag("/\[quote\](.+?)\[\/quote\]/","<div class='quotemain'><div class='quotetop'>QUOTE</div>\\1</div>");
$this->engine->cust_tag("/\[highlight\](.+?)\[\/highlight\]/","<div class='highlighted'>\\1</div>");

$this->engine->cust_tag("/&nbrlb;/","<br />\n"); 
}
function bbcode_parse($html)
{
return $this->engine->parse_bbcode($html);
}
}

$bbc = new bbcode;
 $signature = $conn->query("SELECT userid, signature FROM profilesignatures WHERE userid='{$_GET['u']}'");

                echo "
<table class='tableinbox' width='100%'>";



                if (mysqli_num_rows($signature) == 0) {
                    print "<tr><td>
       <font color=#fff>No profile signature available!</font></td></tr>";
                } else {
                    while ($sig = $signature->fetch_assoc()) {
                 
                        echo "<tr>
        <td align='center' width='100%'>
        ";
$sig['signature']=$bbc->bbcode_parse($sig['signature']);

print "<center>{$sig['signature']}</center>";
                    }
                    echo "</td></tr>";
                }

                ?>
<?php
if($ir['userid'] == $_GET['u'])
{ 
    echo'
<tr><td align="center">
 <a href="signature.php?action=signaturechange"><input type="submit" class="buttonsubmit" value="Edit Signature" /></a>
            
        </td></tr>
        
      ';
}
        ?>
        
            
</table> 