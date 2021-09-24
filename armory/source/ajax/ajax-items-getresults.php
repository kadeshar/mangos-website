<?php
require "ajax-shared-functions.php";
if(!isset($_GET["searchQuery"]))
	$do_query = 0;
else
{
	$SearchQuery = validate_string($_GET["searchQuery"]);
	if(strlen($SearchQuery) >= $config["min_items_search"])
		$do_query = 1;
	else
		$do_query = 0;
}
if($do_query)
{
	//switchConnection("armory", REALM_NAME);
	$doquery_pls_gm = execute_query("armory", "SELECT * FROM `cache_item_search` WHERE `item_name` LIKE '%".change_whitespace($SearchQuery)."%' AND `mangosdbkey` = ".$realms[REALM_NAME][2]);
	$TotalCachedItems = ($doquery_pls_gm ? count($doquery_pls_gm) : 0);
	$item_search_cache = array();
	if ($TotalCachedItems)
    {
        foreach ($doquery_pls_gm as $result_pls_gm)
        {
            $item_search_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
            $Items[] = array($result_pls_gm["item_id"], $result_pls_gm["item_name"], $result_pls_gm["item_level"], $result_pls_gm["item_source"], $result_pls_gm["item_relevance"]);
        }
    }
	//while($result_pls_gm = mysql_fetch_assoc($doquery_pls_gm))
	//{
	//	$item_search_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
	//	$Items[] = array($result_pls_gm["item_id"], $result_pls_gm["item_name"], $result_pls_gm["item_level"], $result_pls_gm["item_source"], $result_pls_gm["item_relevance"]);
	//}
	//switchConnection("mangos", REALM_NAME);
	if($config["locales"])
		$ItemsQuery = execute_query("world", "SELECT `entry` FROM `locales_item` WHERE `name_loc".$config["locales"]."` LIKE '%".change_whitespace($SearchQuery)."%'");
	else
		$ItemsQuery = execute_query("world", "SELECT `entry` FROM `item_template` WHERE `name` LIKE '%".change_whitespace($SearchQuery)."%'");
	$TotalItems = ($ItemsQuery ? count($ItemsQuery) : 0);
	if($TotalItems > $TotalCachedItems)
	{
	    foreach ($ItemsQuery as $ItemInfo)
        {
            if(!isset($item_search_cache[$ItemInfo["entry"]]))
            {
                $item_search_cache[$ItemInfo["entry"]] = cache_item_search($ItemInfo["entry"]);
                $Items[] = array($ItemInfo["entry"], $item_search_cache[$ItemInfo["entry"]]["item_name"], $item_search_cache[$ItemInfo["entry"]]["item_level"], $item_search_cache[$ItemInfo["entry"]]["item_source"], $item_search_cache[$ItemInfo["entry"]]["item_relevance"]);
            }
        }
		//while($ItemInfo = mysql_fetch_assoc($ItemsQuery))
		//{
		//	if(!isset($item_search_cache[$ItemInfo["entry"]]))
		//	{
		//		$item_search_cache[$ItemInfo["entry"]] = cache_item_search($ItemInfo["entry"]);
		//		$Items[] = array($ItemInfo["entry"], $item_search_cache[$ItemInfo["entry"]]["item_name"], $item_search_cache[$ItemInfo["entry"]]["item_level"], $item_search_cache[$ItemInfo["entry"]]["item_source"], $item_search_cache[$ItemInfo["entry"]]["item_relevance"]);
		//	}
		//}
	}
	unset($item_search_cache);
	if($TotalItems)
	{
		$Orders = array("ItemName", "ItemLevel", "Source", "Relevance");
		$OrderOppositeSort = array();
		$OrderSymbol = array();
		$OrderSuffix = array();
		foreach($Orders as $Val)
		{
			$OrderOppositeSort[$Val] = "DESC";
			$OrderSymbol[$Val] = "";
			$OrderSuffix[$Val] = "";
		}
		if(isset($_GET["OrderBy"]))
		{
			$OrderBy = addslashes($_GET["OrderBy"]);
			$OrderSort = addslashes($_GET["OrderSort"]);
			if($OrderBy == "ItemName" || $OrderBy == "ItemLevel" || $OrderBy == "Source" || $OrderBy == "Relevance")
			{
				if($OrderSort == "ASC")
				{
					$OrderOppositeSort[$OrderBy] = "DESC";
					$arrow = "down";
				}
				else
				{
					$OrderOppositeSort[$OrderBy] = "ASC";
					$arrow = "up";
				}
				$OrderSymbol[$OrderBy] = "<span class=\"sort ".$arrow."\"></span>";
				$OrderSuffix[$OrderBy] = "rating";
			}
		}
		else
			$OrderBy = 2;
		$TotalPages = ceil($TotalItems / $config["results_per_page_items"]);
		if(isset($_GET["page"]))
			$PageNo = ValidatePageNumber((int) $_GET["page"], $TotalPages);
		else
			$PageNo = 1;
?>
<span class="csearch-results-info"><?php echo $TotalItems," ",$lang["results_for"] ?> <em><?php echo stripslashes($SearchQuery) ?></em> <?php echo $lang["in_realm"]," ",REALM_NAME ?>:</span><br />
<div id="big-results" style="clear: both;">
<div class="data">
<table class="data-table">
<tr class="masthead">
<td>
<div>
<p></p>
</div>
</td><td style="width: 5%;"></td>
<td style="width: 35%;"><a href="#" onclick="showResult('?searchQuery=<?php echo $SearchQuery,"&page=",$PageNo,"&OrderBy=ItemName&OrderSort=",$OrderOppositeSort["ItemName"],"&realm=",addslashes(REALM_NAME) ?>', 'source/ajax/ajax-items-getresults.php')"><?php echo $lang["item_name"]," ",$OrderSymbol["ItemName"] ?></a></td>
<td style="width: 20%;" align="center"><a href="#" onclick="showResult('?searchQuery=<?php echo $SearchQuery,"&page=",$PageNo,"&OrderBy=ItemLevel&OrderSort=",$OrderOppositeSort["ItemLevel"],"&realm=",addslashes(REALM_NAME) ?>', 'source/ajax/ajax-items-getresults.php')"><?php echo $lang["item_level"]," ",$OrderSymbol["ItemLevel"] ?></a></td>
<td style="width: 25%;" align="center"><a href="#" onclick="showResult('?searchQuery=<?php echo $SearchQuery,"&page=",$PageNo,"&OrderBy=Source&OrderSort=",$OrderOppositeSort["Source"],"&realm=",addslashes(REALM_NAME) ?>', 'source/ajax/ajax-items-getresults.php')"><?php echo $lang["source"]," ",$OrderSymbol["Source"] ?></a></td>
<td style="width: 15%;" align="center"><a href="#" onclick="showResult('?searchQuery=<?php echo $SearchQuery,"&page=",$PageNo,"&OrderBy=Relevance&OrderSort=",$OrderOppositeSort["Relevance"],"&realm=",addslashes(REALM_NAME) ?>', 'source/ajax/ajax-items-getresults.php')"><?php echo $lang["relevance"]," ",$OrderSymbol["Relevance"] ?></a></td><td align="right">
<div>
<b></b>
</div>
</td>
</tr>
<?php
		if(!isset($OrderSort))
		{
			$TheSortId = 4;
			$TheSortType = 1;
		}
		else
		{
			switch($OrderBy)
			{
				case "ItemName": $TheSortId = 1; break;
				case "ItemLevel": $TheSortId = 2; break;
				case "Source": $TheSortId = 3; break;
				default: $TheSortId = 4; // Relevance
			}
			$TheSortType = $OrderSort == "DESC" ? 1 : 0;
		}
		$Items = asort2d($Items, $TheSortId, $TheSortType, 4);
		$Chunks = array_chunk($Items, $config["results_per_page_items"], 1);
		$Items = $Chunks[($PageNo - 1)];
		$visible_item_ids = "";
		foreach($Items as $Key => $Data)
			$visible_item_ids .= $Data[0].",";
		$visible_item_ids .= "0";
		//switchConnection("armory", REALM_NAME);
		$doquery_pls_gm = execute_query("armory", "SELECT * FROM `cache_item` WHERE `item_id` IN (".$visible_item_ids.") AND `mangosdbkey` = ".$realms[REALM_NAME][2]);
		$item_cache = array();
		foreach ($doquery_pls_gm as $result_pls_gm)
            $item_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
		//while($result_pls_gm = mysql_fetch_assoc($doquery_pls_gm))
		//	$item_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
		//switchConnection("armory", REALM_NAME);
		$doquery_pls_gm = execute_query("armory", "SELECT `item_id` FROM `cache_item_tooltip` WHERE `item_id` IN (".$visible_item_ids.") AND `mangosdbkey` = ".$realms[REALM_NAME][2]);
		$item_tooltip_cache = array();
		foreach ($doquery_pls_gm as $result_pls_gm)
            $item_tooltip_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
		//while($result_pls_gm = mysql_fetch_assoc($doquery_pls_gm))
		//	$item_tooltip_cache[$result_pls_gm["item_id"]] = $result_pls_gm;
		foreach($Items as $Key => $Data)
		{
			if(!isset($item_cache[$Data[0]]))
				$item_cache[$Data[0]] = cache_item($Data[0]);
			$item_icon = $item_cache[$Data[0]]["item_icon"];
			$item_quality = $item_cache[$Data[0]]["item_quality"];
			if(!isset($item_tooltip_cache[$Data[0]]))
				cache_item_tooltip($Data[0]);
?>
<tr>
<td>
<div>
<p></p>
</div>
</td>
<td><img class="p43" onMouseOut="hideTip();" onmouseover="showTip('<?php echo $lang["loading"] ?>'); showTooltip(<?php echo $Data[0],",",$realms[REALM_NAME][2] ?>)" src="<?php echo $item_icon ?>"></td>
<td class="<?php echo $OrderSuffix["ItemName"] ?>"><span class="item-icon"><q><a class="rarity<?php echo $item_quality ?>" href="index.php?searchType=iteminfo&item=<?php echo $Data[0],"&realm=",REALM_NAME ?>" onMouseOut="hideTip();" onmouseover="showTip('<?php echo $lang["loading"] ?>'); showTooltip(<?php echo $Data[0],",",$realms[REALM_NAME][2] ?>)"><?php echo $Data[1] ?></a><strong class="rarityShadow<?php echo $item_quality ?>"><?php echo $Data[1] ?></strong></q></span></td>
<td align="center" class="<?php echo $OrderSuffix["ItemLevel"] ?>"><q><?php echo $Data[2] ?></q></td>
<td align="center" class="<?php echo $OrderSuffix["Source"] ?>"><q><?php echo $Data[3] ?></q></td>
<td align="center" class="<?php echo $OrderSuffix["Relevance"] ?>"><q><?php echo $Data[4] ?></q></td>
<td align="right">
<div>
<b></b>
</div>
</td>
</tr>
<?php
		}
?>
</table></div>
<div class="paging">
<div class="returned">
<span><span class=""><?php echo $lang["page"] ?>&nbsp;</span><span class="bold"><?php echo $PageNo ?></span><span class="">&nbsp;<?php echo $lang["of"] ?>&nbsp;</span><span class=""><?php echo $TotalPages ?></span></span>
</div>
<?php
		echo BuildPageButtons($PageNo, $TotalPages, "?searchQuery=".$SearchQuery."&realm=".addslashes(REALM_NAME), "source/ajax/ajax-items-getresults.php")
?>
</div>
<?php
	}
	else
	{
		// No Results for search //
?>
<span class="csearch-results-info">0 <?php echo $lang["results_for"] ?> <em><?php echo stripslashes($SearchQuery) ?></em> <?php echo $lang["in_realm"]," ",REALM_NAME ?>:</span><br />
<div id="big-results" style="clear: both;">
<div class="data">
<table class="data-table">
<tr class="masthead">
<td>
<div>
<p></p>
</div>
</td><td style="width: 5%;"></td>
<td style="width: 30%;"><a class="noLink"><?php echo $lang["item_name"] ?></a></td>
<td style="width: 25%;" align="center"><a class="noLink"><?php echo $lang["item_level"] ?></a></td>
<td style="width: 25%;" align="center"><a class="noLink"><?php echo $lang["source"] ?></a></td>
<td style="width: 15%;" align="center"><a class="noLink"><?php echo $lang["relevance"] ?></a></td><td align="right">
<div>
<b></b>
</div>
</td>
</tr>
<tr>
<td align="center" colspan="7"><?php echo $lang["no_results"] ?></td>
</tr>
</table></div>
<?php
	}
	print_exec_time_and_memory($script_start);
}
else
	echo "<span class=\"csearch-results-info\">Error, you either failed to provide a item name or your search string was too short (&lt; ",$config["min_items_search"]," characters) or you used invalid symbols (only alphabetic characters, digits and whitespace are allowed - whitespace can be used as any symbol)</span>";
?>