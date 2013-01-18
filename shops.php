<?php
  echo dataCore($user,$p,$rank);
  // -- REFERENCE
  // players create "Shops" in-game with Signs that have be formatted in a certain way to be able
  // to purchase items in-game. The game then saves the text on the sign in a database. After a
  // transasction has taken place, the data of whom bought it, from whom, what item, the amount of
  // of the item, the exact coordinates of the sign, and finally the price of the item is recorded in a log file.

  // -- APPLICATION
  // What my application does is extracts the data in the log files and saves it into a database table.
  // After which, my application gets the coordinates from the database and queries another database table
  // using the coordinates to get the text on sign. It then saves all this new information into a
  // temporary database table from which I am able to manipulate the data even further.

  function dbCreateTmpTable() {
    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_cs_shops` (`owner` text NOT NULL,`amount` text NOT NULL,`price` text NOT NULL,`item` text NOT NULL,`realname` text NOT NULL,`x` text NOT NULL,`y` text NOT NULL,`z` text NOT NULL,`bppi` text NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    mysql_query($sql);
  }
  function dbInsertData($dat) {
    $sql = "INSERT INTO `tmp_cs_shops` (owner,amount,price,item,realname,x,y,z,bppi) VALUES ('{$dat['owner']}','{$dat['amount']}','{$dat['price']}','{$dat['item']}','{$dat['real']}','{$dat['x']}','{$dat['y']}','{$dat['z']}','{$dat['bppi']}')";
    if (!mysql_query($sql)) {echo mysql_error();}
  }
  function getItemName($str) {
    switch ($str) {
      case '394':
      case '394:0':
      case 'Poisonous Potat':
      case 'Poisonous Pot:0':
        $str = 'Poisonous Potato';
      break;
      case 'Glowstone Dus:0':
        $str = 'Glowstone Dust';
      break;
      case 'Brown Mushroo:0':
        $str = 'Brown Mushroom';
      break;
      case 'Jack O Lanter:0':
        $str = 'Jack O Lantern';
      break;
      case 'Mossy Cobbles:0':
        $str = 'Mossy Cobblestone';
      break;
      case '31':
      case '31:0':
      case 'Long Grass':
      case 'Long Grass:0':
        $str = 'Shrub';
      break;
      case '31:1':
      case 'Long Grass:1':
        $str = 'Long Grass';
      break;
      case '31:2':
      case 'Long Grass:2':
        $str = 'Fern';
      break;
      case '111':
      case '111:0':
      case 'Water Lily':
      case 'Water Lily:0':
        $str = 'Lily Pad';
      break;
      case '373':
      case '373:0':
      case 'Potion':
      case 'Potion:0';
        $str = 'Potion';
      break;
      case '67':
      case '67:0':
      case 'Cobblestone Sta':
      case 'Cobblestone S:0':
        $str = 'Stairs:Cobblestone';
      break;
      case '108':
      case '108:0':
      case 'Brick Stairs:0':
      case 'Brick Stairs':
        $str = 'Stairs:Brick';
      break;
      case '109':
      case '109:0':
      case 'Smooth Stairs':
      case 'Smooth Stairs:0':
        $str = 'Stairs:StoneBrick';
      break;
      case '114':
      case '114:0':
      case 'Nether Brick St':
        $str = 'Stairs:NetherBrick';
      break;
      case '128':
      case '128:0':
      case 'Sandstone Stair':
      case 'Sandstone Sta:0':
        $str = 'Stairs:Sandstone';
      break;
      case '53':
      case '53:0':
      case 'Wood Stairs':
      case 'Wood Stairs:0':
        $str = 'Stairs:Wooden:Oak';
      break;
      case '134':
      case '134:0':
      case 'Spruce Wood Sta':
      case 'Spruce Wood S:0':
        $str = 'Stairs:Wooden:Spruce';
      break;
      case '135':
      case '135:0':
      case 'Birch Wood Stai':
      case 'Birch Wood St:0':
        $str = 'Stairs:Wooden:Birch';
      break;
      case '135':
      case '135:0':
      case 'Jungle Wood Sta':
      case 'Jungle Wood S:0':
        $str = 'Stairs:Wooden:Jungle';
      break;
      case '44':
      case '44:0':
      case 'Step':
      case 'Step:0':
      case 'Slab':
      case 'Slab:0':
        $str = 'Slab:Stone';
      break;
      case '44:1':
      case 'Step:1':
      case 'Step:Sandstone':
        $str = 'Slab:Sandstone';
      break;
      break;
      case '44:2':
      case 'Step:2':
      case 'Step:Wooden':
        $str = 'Slab:Wooden:Oak';
      break;
      case '44:3':
      case 'Step:3':
      case 'Step:Cobblestone':
        $str = 'Slab:Cobblestone';
      break;
      case '44:4':
      case 'Step:4':
      case 'Step:Brick':
        $str = 'Slab:Brick';
      break;
      case '44:5':
      case 'Step:5':
      case 'Step:Stone Brick':
        $str = 'Slab:StoneBrick';
      break;
      case '126':
      case '126:0':
      case 'Wood Step':
      case 'Wood Step:0':
        $str = 'Slab:Wooden:Oak';
      break;
      case '126:1':
      case 'Wood Step:1':
        $str = 'Slab:Wooden:Spruce';
      break;
      case '126:2':
      case 'Wood Step:2':
        $str = 'Slab:Wooden:Birch';
      break;
      case '126:3':
      case 'Wood Step:3':
        $str = 'Slab:Wooden:Jungle';
      break;
      case '383:120':
      case 'Monster Egg:120':
        $str = 'Mob Egg:Villager';
      break;
      case '383:99':
      case 'Monster Egg:99':
        $str = 'Mob Egg:SnowGolem';
      break;
      case '383:98':
      case 'Monster Egg:98':
        $str = 'Mob Egg:Ocelot';
      break;
      case '383:97':
      case 'Monster Egg:97':
        $str = 'Mob Egg:SnowGolem';
      break;
      case '383:96':
      case 'Monster Egg:96':
        $str = 'Mob Egg:Mooshroom';
      break;
      case '383:95':
      case 'Monster Egg:95':
        $str = 'Mob Egg:Wolf';
      break;
      case '383:94':
      case 'Monster Egg:94':
        $str = 'Mob Egg:Squid';
      break;
      case '383:93':
      case 'Monster Egg:93':
        $str = 'Mob Egg:Chicken';
      break;
      case '383:92':
      case 'Monster Egg:92':
        $str = 'Mob Egg:Cow';
      break;
      case '383:91':
      case 'Monster Egg:91':
        $str = 'Mob Egg:Sheep';
      break;
      case '383:90':
      case 'Monster Egg:90':
        $str = 'Mob Egg:Pig';
      break;
      case '383:63':
      case 'Monster Egg:63':
        $str = 'Mob Egg:Enderdragon';
      break;
      case '383:62':
      case 'Monster Egg:62':
        $str = 'Mob Egg:MagmaCube';
      break;
      case '383:61':
      case 'Monster Egg:61':
        $str = 'Mob Egg:Blaze';
      break;
      case '383:60':
      case 'Monster Egg:60':
        $str = 'Mob Egg:Silverfish';
      break;
      case '383:59':
      case 'Monster Egg:59':
        $str = 'Mob Egg:CaveSpider';
      break;
      case '383:58':
      case 'Monster Egg:58':
        $str = 'Mob Egg:Endermen';
      break;
      case '383:57':
      case 'Monster Egg:57':
        $str = 'Mob Egg:ZombiePigmen';
      break;
      case '383:56':
      case 'Monster Egg:56':
        $str = 'Mob Egg:Ghast';
      break;
      case '383:55':
      case 'Monster Egg:55':
        $str = 'Mob Egg:Slime';
      break;
      case '383:54':
      case 'Monster Egg:54':
        $str = 'Mob Egg:Zombie';
      break;
      case '383:53':
      case 'Monster Egg:53':
        $str = 'Mob Egg:GiantZombie';
      break;
      case '383:52':
      case 'Monster Egg:52':
        $str = 'Mob Egg:Spider';
      break;
      case '383:51':
      case 'Monster Egg:51':
        $str = 'Mob Egg:Skeleton';
      break;
      case '383:50':
      case 'Monster Egg:50':
        $str = 'Mob Egg:Creeper';
      break;
      case '48':
      case '48:0':
      case 'Mossy Cobbles:0':
      case 'Mossy Cobblesto':
        $str = 'Mossy Cobblestone';
      break;
      case '6':
      case '6:0':
      case 'Sapling':
      case 'Sapling:0':
        $str = 'Sapling:Oak';
      break;
      case '6:1':
      case 'Sapling:1':
        $str = 'Sapling:Spruce';
      break;
      case '6:2':
      case 'Sapling:2':
        $str = 'Sapling:Birch';
      break;
      case '6:3':
      case 'Sapling:3':
        $str = 'Sapling:Jungle';
      break;
      case '116':
      case 'Enchantment Tab':
      case 'Enchantment T:0':
        $str = 'Enchant Table';
      break;
      case '98':
      case '98:0':
      case 'Smooth Brick:0':
        $str = 'Smooth Brick';
      break;
      case '289':
      case 'Sulphur':
      case 'Sulphur:0':
        $str = 'Gunpowder';
      break;
      case '337:7':
      case 'Piston Base:7':
        $str = 'Piston';
      break;
      case '123':
      case '123:0':
        $str = 'Redstone Lamp';
      break;
      case '320':
      case '320:0':
      case 'Grilled Pork:0':
      case 'Grilled Pork':
        $str = 'Cooked Porkshop';
      break;
      case '17':
      case '17:0':
      case 'Log':
      case 'Log:0':
        $str = 'Log:Oak';
      break;
      case '17:1':
      case 'Log:1':
        $str = 'Log:Spruce';
      break;
      case '17:2':
      case 'Log:2':
        $str = 'Log:Birch';
      break;
      case '17:3':
      case 'Log:3':
        $str = 'Log:Jungle';
      break;
      case '5':
      case '5:0':
      case 'Wood':
      case 'Wood:0':
        $str = 'Wood:Oak';
      break;
      case '5:1':
      case 'Wood:1':
        $str = 'Wood:Spruce';
      break;
      case '5:2':
      case 'Wood:2':
        $str = 'Wood:Brich';
      break;
      case '5:3':
      case 'Wood:3':
        $str = 'Wood:Jungle';
      break;
      case '35':
      case '35:0':
      case 'Wool':
      case 'Wool:0':
        $str = 'Wool:White';
      break;
      case '35:1':
      case 'Wool:1':
        $str = 'Wool:Orange';
      break;
      case '35:2':
      case 'Wool:2':
        $str = 'Wool:Magenta';
      break;
      case '35:3':
      case 'Wool:3':
        $str = 'Wool:LightBlue';
      break;
      case '35:4':
      case 'Wool:4':
        $str = 'Wool:Yellow';
      break;
      case '35:5':
      case 'Wool:5':
        $str = 'Wool:Lime';
      break;
      case '35:6':
      case 'Wool:6':
        $str = 'Wool:Pink';
      break;
      case '35:7':
      case 'Wool:7':
      case 'Wool:Grey':
      case 'Wool:Gray':
        $str = 'Wool:Gray';
      break;
      case '35:8':
      case 'Wool:8':
      case 'Wool:LightGrey':
      case 'Wool:LightGray':
        $str = 'Wool:LightGray';
      break;
      case '35:9':
      case 'Wool:9':
        $str = 'Wool:Cyan';
      break;
      case '35:10':
      case 'Wool:10':
        $str = 'Wool:Purple';
      break;
      case '35:11':
      case 'Wool:11':
        $str = 'Wool:Blue';
      break;
      case '35:12':
      case 'Wool:12':
        $str = 'Wool:Brown';
      break;
      case '35:13':
      case 'Wool:13':
        $str = 'Wool:Green';
      break;
      case '35:14':
      case 'Wool:14':
        $str = 'Wool:Red';
      break;
      case '35:15':
      case 'Wool:15':
        $str = 'Wool:Black';
      break;
      case '351':
      case '351:0':
      case 'Ink Sack:0':
        $str = 'Ink Sack';
      break;
      case '351:1':
      case 'Ink Sack:1':
        $str = 'Rose Red';
      break;
      case '351:2':
      case 'Ink Sack:2':
        $str = 'Cactus Green';
      break;
      case '351:3':
      case 'Ink Sack:3':
        $str = 'Cocoa Beans';
      break;
      case '351:4':
      case 'Ink Sack:4':
        $str = 'Lapis Lazuli';
      break;
      case '351:5':
      case 'Ink Sack:5':
        $str = 'Purple';
      break;
      case '351:6':
      case 'Ink Sack:6':
        $str = 'Cyan';
      break;
      case '351:7':
      case 'Ink Sack:7':
        $str = 'Light Gray';
      break;
      case '351:8':
      case 'Ink Sack:8':
        $str = 'Gray';
      break;
      case '351:9':
      case 'Ink Sack:9':
        $str = 'Pink';
      break;
      case '351:10':
      case 'Ink Sack:10':
        $str = 'Lime';
      break;
      case '351:11':
      case 'Ink Sack:11':
        $str = 'Dandelion Yellow';
      break;
      case '351:12':
      case 'Ink Sack:12':
        $str = 'Light Blue';
      break;
      case '351:13':
      case 'Ink Sack:13':
        $str = 'Magenta';
      break;
      case '351:14':
      case 'Ink Sack:14':
        $str = 'Orange';
      break;
      case '351:15':
      case 'Ink Sack:15':
        $str = 'Bone Meal';
      break;
      case '373':
      case '373:0':
      case 'Glass Bottle':
      case 'Glass Bottle:0':
        $str = 'Water Bottle';
      break;
      case 'Diamond Chestpl':
      case 'Diamond Chest:0':
        $str = 'Diamond Chestplate';
      break;
    }
    // below code put at the end because it has to go through the switch first
    $dmg = array('Ink Sack','Log','Long Grass','Monster Egg','Potion','Sapling','Step','Wood','Wool');
    $tmp = preg_replace("/\:[0-9]+/","",$str);
    if (!in_array($tmp,$dmg)) {$str = preg_replace("/\:[0-9]+/","",$str);}
    return $str;
  }

  $f = getFile('shops');
  $f = $f."ChestShop.log";
  // save ChestShop log histroy in a database... cs_transactions doesn't record x, y, z
  // coords which I need to get the current text on signs
  $l = fopen($f,'r');
  $cnt = 0;
  while (!feof($l)) {
    $n = fgets($l,140);
    if (strlen($n) === 0) {continue;}
    $cnt++;
    if (strstr($n,"Disabling ChestShop")) {continue;}
    // added the world 'at' into the regex because of new ChestShop update
    $log = preg_replace("/[\w\s\:\/\[\]]+ ([\w\s]+) (s|b)(old|ought) ([0-9]+) ([\w\:\s]+) for ([0-9\.]+) [\w]+ ([\w\s]+) at \[world\] ([0-9\-]+), ([0-9\-]+), ([0-9\-]+)[\s]*/",'$1|$7|$4|$2 $6|$5|$8|$9|$10',$n);
    $brk = explode('|',$log);
    $brk[3] = strtoupper($brk[3]);
    // all-caps the item name and replace spaces with underscores // new update change
    $brk[4] = strtoupper($brk[4]);
    $brk[4] = preg_replace("/\s/","_",$brk[4]);
    // insert log contents into database
    $sql = "INSERT INTO `stuncraft_cs_log` (id,owner,customer,amount,price,item,x,y,z) VALUES ('','{$brk[1]}','{$brk[0]}','{$brk[2]}','{$brk[3]}','{$brk[4]}','{$brk[5]}','{$brk[6]}','{$brk[7]}')";
    if (!mysql_query($sql)) {
      echo err("A problem occured. Stopping all scripts on this page. ".mysql_error());
      var_dump($brk);
      exit;
    }
  }
  // if there is something in the log
  if ($cnt > 0) {
    // clears log file
    $fh = fopen($f,'w');
    fclose($fh);
  }
  // query pulls unique x,y,z values. meaning repeat transactions
  // from one shop aren't included, only one of the many is listed.
  $dat = array();
  $pla = getPlayerNames();
  $sql = "SELECT DISTINCT `x`, `y`, `z` FROM `stuncraft_cs_log`";
  $qry = mysql_query($sql);
  while ($row = mysql_fetch_array($qry,MYSQL_ASSOC)) {
    $s = "SELECT `blockId` FROM `lwc_protections` WHERE `x` = '{$row['x']}' AND `y` = '{$row['y']}' AND `z` = '{$row['z']}'";
    $q = mysql_query($s);
    if (mysql_num_rows($q) > 0) {
      $s = "SELECT MAX(`id`) AS `i` FROM `lb-world` WHERE `x` = '{$row['x']}' AND `y` = '{$row['y']}' AND `z` = '{$row['z']}' AND `type` != '0'";
      $q = mysql_query($s);
      $r = mysql_fetch_array($q,MYSQL_ASSOC);
      $s = "SELECT `signtext` FROM `lb-world-sign` WHERE `id` = '{$r['i']}'";
      $q = mysql_query($s);
      $r = mysql_fetch_array($q,MYSQL_ASSOC);
      $txt = preg_replace("/[^0-9A-Za-z\s\:\_\.]/","\\n",$r['signtext']);
      $ext = explode('\n',$txt);
      if (!in_array($ext[0],$pla) && $ext[0] !== 'Admin Shop') {continue;}
      $ext[2] = preg_replace("/([Bb|Ss])[\s]*([0-9]+)/","$1 $2",$ext[2]);
      $ext[2] = strtoupper($ext[2]);
      $nam = $ext[3];
      $ext[3] = getItemName($ext[3]);
      dbCreateTmpTable();
      $bppi = "";
      // format prices, and break down buy price per item or 'bppi' (instead of stacks) not interested in
      // sold items as the most commonly sold item is 'Cobblestone' for sure
      if (strstr($ext[2],'B')) {
        $pri = $ext[2];
        if (strstr($pri,':')) {
          $e = explode(':',$pri);
          if (strstr($pri,'B')) {$pri = $e[0];}
          if (strstr($pri,'B')) {$pri = $e[1];}
        }
        $e = explode(" ",$pri);
        $pri = $e[1] / $ext[1];
        $pri = number_format($pri,2);
        $pri = preg_replace("/[,]/","",$pri);
        $bppi = $pri;
      }
      $tmpDat = array('owner' => $ext[0],'amount' => $ext[1],'price' => $ext[2],'item' => $ext[3],'real' => $nam,'x' => $row['x'],'y' => $row['y'],'z' => $row['z'],'bppi' => $bppi);
      dbInsertData($tmpDat);
    }
  }
  $s = (isset($_GET['s'])) ? $_GET['s'] : "ASC";
  $s = ($s === 'ASC') ? 'DESC' : 'ASC';
  $g = (isset($_GET['g'])) ? $_GET['g'] : "";
  $srt = "";
  $tmp = "";
  if ($g) {
    if (array_key_exists($g,$tmpDat)) {
      switch ($g) {
        case 'bppi':
        case 'amount':
        case 'x':
        case 'y':
        case 'z':
        case 'price':
          // the below makes these columns sort in natural number form
          $g = "LENGTH({$g}) {$s}, {$g} {$s}";
          $srt = $s;
          $s = "";
        break;
      }
      $tmp = " ORDER BY {$g} {$s}";
    }
  }
  $s = ($srt) ? $srt : $s;
  $sql = "SELECT * FROM `tmp_cs_shops`{$tmp}";
  $qry = mysql_query($sql);
  echo "<table class=\"data\">\n".
       "  <tr>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=owner&amp;s={$s}\">Owner</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=amount&amp;s={$s}\"><acronym title=\"Amount\">#</acronym></a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=price&amp;s={$s}\">Price</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=item&amp;s={$s}\">Item</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=x&amp;s={$s}\">X</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=y&amp;s={$s}\">Y</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=z&amp;s={$s}\">Z</a></th>\n".
       "    <th><a href=\"index.php?p=shops&amp;g=bppi&amp;s={$s}\"><acronym title=\"Buy Price Per Item\">BPPI</acronym></a></th>\n".
       "  </tr>\n";
  while ($row = mysql_fetch_array($qry,MYSQL_ASSOC)) {
    echo "  <tr>\n".
         "    <td>{$row['owner']}</td>\n".
         "    <td>{$row['amount']}</td>\n".
         "    <td>{$row['price']}</td>\n".
         "    <td><acronym title=\"{$row['realname']}\">{$row['item']}</acronym></td>\n".
         "    <td>{$row['x']}</td>\n".
         "    <td>{$row['y']}</td>\n".
         "    <td>{$row['z']}</td>\n".
         "    <td>{$row['bppi']}</td>\n".
         "  </tr>\n";
  }
  echo "</table>";


//try {
//  $f = getFile('shops');
//  $f = $f."ChestShop.db";
//  $dbh = new PDO("sqlite:$f");
//  $qry = $dbh->query("SELECT COUNT(id) FROM `cs_transactions`");
//  var_dump($qry);
////  $fet = $qry->fetch();
//  foreach ($qry as $row) {
//    var_dump('echo...');
//    var_dump($row);
//    var_dump($row['id']);
//  }
//}
//catch(PDOException $e) {
//  echo $e->getMessage();
//}

?>