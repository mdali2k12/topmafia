<?php


  if (get_rank($r['strength'], 'strength')==1)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/str.png' /><br/><span class='badgenote1'>#1 Strength</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/str.png' /><br/><span class='badgenote'>#1 Strength</span></div></a>";
  }
  
  if (get_rank($r['guard'], 'guard')==1)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/grd.png' /><br/><span class='badgenote1'>#1 Guard</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/grd.png' /><br/><span class='badgenote'>#1 Guard</span></div></a>";
  }
  
  if (get_rank($r['agility'], 'agility')==1)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/agl.png' /><br/><span class='badgenote1'>#1 Agility</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/agl.png' /><br/><span class='badgenote'>#1 Agility</span></div></a>";
  }
  
  if (get_level($r['level'], 'level')==1)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/lvl.png' /><br/><span class='badgenote1'>Top Level</span></div></a>";
  }
  else
  { 
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/lvl.png' /><br/><span class='badgenote'>Top Level</span></div></a>";
  }
  
  
  
  if ($r['bankmoney']>1000000)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/million1.png' /><br/><span class='badgenote1'>$1m+ bank</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/million1.png' /><br/><span class='badgenote'>$1m+ bank</span></div></a>";
  }
  
  if ($r['bankmoney']>10000000)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/million2.png' /><br/><span class='badgenote1'>$10m+ bank</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/million2.png' /><br/><span class='badgenote'>$10m+ bank</span></div></a>";
  }
  
  if ($r['donated']>50)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/donate1.png' /><br/><span class='badgenote1'>Donated $50+</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/donate1.png' /><br/><span class='badgenote'>Donated $50+</span></div></a>";
  }
  
  if ($r['donated']>100)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/donate2.png' /><br/><span class='badgenote1'>Donated $100+</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/donate2.png' /><br/><span class='badgenote'>Donated $100+</span></div></a>";
  }
  
  if ($r['donated']>250)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/donate3.png' /><br/><span class='badgenote1'>Donated $250+</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/donate3.png' /><br/><span class='badgenote'>Donated $250+</span></div></a>";
  }  

  if ($r['donated']>500)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/donate4.png' /><br/><span class='badgenote1'>Donated $500+</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/donate4.png' /><br/><span class='badgenote'>Donated $500+</span></div></a>";
  }  
  
  if ($r['donated']>1000)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/donate5.png' /><br/><span class='badgenote1'>Donated $1K+</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/donate5.png' /><br/><span class='badgenote'>Donated $1K+</span></div></a>";
  }  //die($r['daysold']'here....');  
  if ($r['daysold']>182)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/old.png' /><br/><span class='badgenote1'>6 Mnth</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/old.png' /><br/><span class='badgenote'>6 Mnth</span></div></a>";
  }  
  if ($r['daysold']>365)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/VET.png' /><br/><span class='badgenote1'>1 Year</span></div></a>";
  }
  else
  {
  print"<a href='#' class='spacing'><div class='badgefade'><img src='https://www.topmafia.net/game/badges/VET.png' /><br/><span class='badgenote'>1 Year</span></div></a>";
  }
  
  if ($r['user_level']>1)
  {
  print"<a href='#' class='spacing'><div class='badge'><img src='https://www.topmafia.net/game/badges/staff.png' /><br/><span class='badgenote1'>Game Staff</span></div></a></a>";
  }
  
  ?>