<?php
$inv=$conn->query("SELECT iv.*,i.*,it.* FROM users_inventory iv inner join items i ON iv.inv_itemid=i.itmid inner join itemtypes it ON i.itmtype=it.itmtypeid WHERE iv.inv_userid={$r['userid']} ORDER BY RAND() LIMIT 15");
  if (mysqli_num_rows($inv) == 0)
  {
  print "<b>This user has no items!</b>";
  }
  else
  {
    while($i=$inv->fetch_assoc())
      {
      print "<a href='iteminfo.php?ID=".$i['itmid']."'><img src='https://topmafia.net/game/images/items/".$i['itmid'].".png'/></a>";
      }
  }
  ?>