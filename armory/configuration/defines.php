<?php
$defines = array(
// Type => array(client_1.12.1, client_2.4.3, client_3.0.9, client_3.1.3, client_3.2.2, client_3.3.2)
// Character Data
"HP"							=> array(  28,   31,   31,   31,   31),
"MANA"							=> array(  29,   32,   32,   32,   32),
"RAGE"							=> array(  30,   33,   33,   33,   33),
"ENERGY"						=> array(  32,   35,   35,   35,   35), // Runic for DK
"LEVEL"							=> array(  34,   53,   53,   53,   53),
"GENDER"						=> array(  36,   22,   22,   22,   22),
"MEELE_MAIN_HAND_ATTACK_TIME"	=> array( 147,   61,   61,   61,   61),
"MEELE_OFF_HAND_ATTACK_TIME"	=> array( 148,   62,   62,   62,   62),
"RANGED_ATTACK_TIME"			=> array( 149,   63,   63,   63,   63),
"MEELE_MAIN_HAND_MIN_DAMAGE"	=> array( 155,   69,   69,   69,   69),
"MEELE_MAIN_HAND_MAX_DAMAGE"	=> array( 156,   70,   70,   70,   70),
"MEELE_OFF_HAND_MIN_DAMAGE"		=> array( 157,   71,   71,   71,   71),
"MEELE_OFF_HAND_MAX_DAMAGE"		=> array( 158,   72,   72,   72,   72),
"STRENGTH"						=> array( 171,   84,   84,   84,   84),
"AGILITY"						=> array( 172,   85,   85,   85,   85),
"STAMINA"						=> array( 173,   86,   86,   86,   86),
"INTELLECT"						=> array( 174,   87,   87,   87,   87),
"SPIRIT"						=> array( 175,   88,   88,   88,   88),
"ARMOR"							=> array( 186,   99,   99,   99,   99),
//"HOLY_RES"					=> array( 187,  100,  100,  100,  100),
"FIRE_RES"						=> array( 188,  101,  101,  101,  101),
"NATURE_RES"					=> array( 189,  102,  102,  102,  102),
"FROST_RES"						=> array( 190,  103,  103,  103,  103),
"SHADOW_RES"					=> array( 191,  104,  104,  104,  104),
"ARCANE_RES"					=> array( 192,  105,  105,  105,  105),
"MELEE_AP_BASE"					=> array( 210,  123,  123,  123,  123),
"MELEE_AP_BONUS"				=> array( 211,  124,  124,  124,  124),
"RANGED_AP_BASE"				=> array( 213,  126,  126,  126,  126),
"RANGED_AP_BONUS"				=> array( 214,  127,  127,  127,  127),
"RANGED_MIN_DAMAGE"				=> array( 216,  129,  129,  129,  129),
"RANGED_MAX_DAMAGE"				=> array( 217,  130,  130,  130,  130),
//"GUILD"						=> array( 237,  151,  151,  151,  151),
//"GUILD_RANK"					=> array( 238,  152,  152,  152,  152),
"SKILL_DATA"					=> array( 928, 1012,  610,  610,  636),
"BLOCK_PERCENTAGE"				=> array(1316, 1400,  998,  998, 1024),
"DODGE_PERCENTAGE"				=> array(1317, 1401,  999,  999, 1025),
"PARRY_PERCENTAGE"				=> array(1318, 1402, 1000, 1000, 1026),
"EXPERTISE"						=> array(1319, 1403, 1001, 1001, 1027),
"CRIT_PERCENTAGE"				=> array(1321, 1405, 1003, 1003, 1029),
"RANGED_CRIT_PERCENTAGE"		=> array(1322, 1406, 1004, 1004, 1030),
"SPELL_CRIT_PERCENTAGE"			=> array(1324, 1408, 1006, 1006, 1032),
"SPELL_DAMAGE"					=> array(1462, 1547, 1145, 1145, 1171),
"SPELL_HEALING"					=> array(1483, 1568, 1166, 1166, 1192),
"KILLS"							=> array(1517, 1602, 1200, 1202, 1228),
"DEFENSE_RATING"				=> array(1521, 1606, 1204, 1206, 1232),
"DODGE_RATING"					=> array(1522, 1607, 1205, 1207, 1233),
"PARRY_RATING"					=> array(1523, 1608, 1206, 1208, 1234),
"BLOCK_RATING"					=> array(1524, 1609, 1207, 1209, 1235),
"MELEE_HIT_RATING"				=> array(1525, 1610, 1208, 1210, 1236),
"RANGED_HIT_RATING"				=> array(1526, 1611, 1209, 1211, 1237),
"SPELL_HIT_RATING"				=> array(1527, 1612, 1210, 1212, 1238),
"MELEE_CRIT_RATING"				=> array(1528, 1613, 1211, 1213, 1239),
"RANGED_CRIT_RATING"			=> array(1529, 1614, 1212, 1214, 1240),
"SPELL_CRIT_RATING"				=> array(1530, 1615, 1213, 1215, 1241),
"RESILIENCE_RATING"				=> array(1534, 1620, 1218, 1220, 1246),
"MELEE_HASTE_RATING"			=> array(1537, 1622, 1219, 1221, 1247),
"RANGED_HASTE_RATING"			=> array(1538, 1623, 1220, 1222, 1248),
"SPELL_HASTE_RATING"			=> array(1539, 1624, 1221, 1223, 1249),
"EXPERTISE_RATING"				=> array(1543, 1628, 1225, 1227, 1253),
"HONOR"							=> array(1562, 1648, 1246, 1251, 1277),
"ARENAPOINTS"					=> array(1563, 1649, 1247, 1252, 1278),
"MANA_REGEN"					=> array(1564,   39,   39,   39,   39),
"MANA_REGEN_INTERRUPT"			=> array(1565,   46,   46,   46,   46),
// Item Data
"PERMANENT"						=> array(   0,   0,   0,   22,   22,   22),
//"TEMPORARY"					=> array(  25,   25,   25,   25,   25),
"SOCKET_1"						=> array(   0,   28,   28,   28,   28,   28),
//"SOCKET_2"					=> array(  31,   31,   31,   31,   31),
//"SOCKET_3"					=> array(  34,   34,   34,   34,   34),
"SOCKET_BONUS"					=> array(   0,   37,   37,   37,   37,   37),
"PRISMATIC_SOCKET"				=> array(   0,   40,   40,   40,   40), // WOTLK
"RANDOM_1"						=> array(   3,   18,   27,   43,   43,   21), // RandomSuffix
//"RANDOM_2"					=> array(  43,   46,   46,   46,   46), // RandomSuffix
//"RANDOM_3"					=> array(  46,   49,   49,   49,   49), // RandomSuffix and RandomProperty
//"RANDOM_4"					=> array(  49,   52,   52,   52,   52), // RandomProperty
//"RANDOM_5"					=> array(  52,   55,   55,   55,   55), // RandomProperty
"DURABILITY"					=> array(  58,   61,   61,   61,   61),
"MAX_DURABILITY"				=> array(  59,   62,   62,   62,   62),
);
?>