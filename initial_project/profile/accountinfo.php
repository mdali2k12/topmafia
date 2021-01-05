	<?php
	
$TotalStats = $r['strength'] + $r['agility'] + $r['guard'] + $r['labour'] + $r['IQ'];
$TotalRank = get_rank($TotalStats, 'strength + agility + guard + labour + IQ');

				print"
				<table width='100%' class='tablestatbox'>
				<tr>
				<th colspan='2'>General Information</th>
				</tr>
				<tr>
				<td width='50%'>
  <p class='alignleft'>Account Type:</p>
  <p class='alignright'>$userl</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Location:</p>
  <p class='alignright'>{$r['cityname']}</p>
  </td>
  </tr>
  <tr>
  	<td width='50%'>
  <p class='alignleft'>Money:</p>
  <p class='alignright'>".money_formatter($r['money'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Crystals:</p>
  <p class='alignright'>".number_format($r['crystals'])."</p>
  </td>
                </tr>
                 <tr>
  	<td width='50%'>
  <p class='alignleft'>VIP Days:</p>
  <p class='alignright'>".number_format($r['vip'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Credits:</p>
  <p class='alignright'>".number_format($r['credits'])."</p>
  </td>
                </tr>
                
                 <tr>
  	<td width='50%'>
  <p class='alignleft'>Gender:</p>
  <p class='alignright'>".$r['gender']."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Age:</p>
  <p class='alignright'>".number_format($r['daysold'])."</p>
  </td>
                </tr>
                     <tr>
  	<td width='50%'>
  <p class='alignleft'>Friends:</p>
  <p class='alignright'>".number_format($r['friends'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Enemies:</p>
  <p class='alignright'>".number_format($r['enemies'])."</p>
  </td>
                </tr>
                    <tr>
  	<td width='50%'>
  <p class='alignleft'>REFERRALS:</p>
  <p class='alignright'>".number_format($r['referrals'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Referred By:</p>
  <p class='alignright'>".$referredby."</p>
  </td>
                </tr>
                
                		
</table>

<br />";
if($r['gang'])
{
$gangt="<a href='gangs.php?action=view&ID={$r['gang']}'>[{$r['gangPREF']}] {$r['gangNAME']}</a>";
$gangunit = 
 $conn->query("SELECT g.*,u.* FROM gangs g LEFT JOIN users_data u ON g.gangID=u.gang WHERE userid='{$_GET['u']}'");
            $gng = $gangunit->fetch_assoc();
            
 $cnt1 = $conn->query("SELECT userid, gang FROM users_data WHERE gang='{$gng['gangID']}'");
 $cnt = number_format(mysqli_num_rows($cnt1));
 
}
else
{
$gangt="N/A";
     $cnt = 0;
}


print"

	<table width='100%' class='tablestatbox'>
				<tr> 
				<th colspan='2'>Gang Information</th>
				</tr>
				<tr>
				<td width='50%'>
  <p class='alignleft'>Gang:</p>
  <p class='alignright'>".$gangt."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Members:</p>
  <p class='alignright'>$cnt</p>
  </td>
  </tr>
  <tr>
  	<td width='50%'>
  <p class='alignleft'>Respect:</p>
  <p class='alignright'>".number_format($gng['gangRESPECT'])."</p>
  </td>

  	<td width='50%'>
  <p class='alignleft'>Age:</p>
  <p class='alignright'>".number_format($gng['gangAGE'])."</p>
  </td>
                </tr>
                
                		
</table>

<br />

	<table width='100%' class='tablestatbox'>
				<tr>
				<th colspan='2'>Stat Ranks</th>
				</tr>
				<tr>
				<td width='16.6%'>
  <p class='alignleft'>Strength:</p>
  <p class='alignright'>".get_rank($r['strength'], 'strength')."</p>
  </td>
                <td width='16.6%'>
  <p class='alignleft'>Agility:</p>
  <p class='alignright'>".get_rank($r['agility'], 'agility')."</p>
  </td>
  </tr>
  <tr>
  	<td width='16.6%'>
  <p class='alignleft'>Guard:</p>
  <p class='alignright'>".get_rank($r['guard'], 'guard')."</p>
  </td>
  
  	<td width='16.6%'>
  <p class='alignleft'>Labour:</p>
  <p class='alignright'>".get_rank($r['labour'], 'labour')."</p>
  </td>
                </tr>
                
  <tr>
  	<td width='16.6%'>
  <p class='alignleft'>IQ:</p>
  <p class='alignright'>".get_rank($r['IQ'], 'IQ')."</p>
  </td>
  
  	<td width='16.6%'>
  <p class='alignleft'>Total Rank:</p>
  <p class='alignright'>".number_format($TotalRank)."</p>
  </td>
                </tr>
                
                		
</table>

<br />

	<table width='100%' class='tablestatbox'>
				<tr>
				<th colspan='2'>Vital Information</th>
				</tr>
				<tr>
				<td width='50%'>
  <p class='alignleft'>Energy:</p>
  <p class='alignright'>".number_format($r['energy'])." / ".number_format($r['maxenergy'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Will:</p>
  <p class='alignright'>".number_format($r['will'])." / ".number_format($r['maxwill'])."</p>
  </td>
  </tr>
  <tr>
  	<td width='50%'>
  <p class='alignleft'>Brave:</p>
  <p class='alignright'>".number_format($r['brave'])." / ".number_format($r['maxbrave'])."</p>
  </td>
                <td width='50%'>
  <p class='alignleft'>Health:</p>
  <p class='alignright'>".number_format($r['hp'])." / ".number_format($r['maxhp'])."</p>
  </td>
                </tr>
                
                		
</table>

";
  ?>