<?php
set_time_limit(0);
header('content-type: text/html; charset=utf-8');

// Turn off output buffering
ini_set('output_buffering', 'off');
// Turn off PHP output compression
ini_set('zlib.output_compression', false);
//Flush (send) the output buffer and turn off output buffering
while (@ob_end_flush());
// Implicitly flush the buffer(s)
ini_set('implicit_flush', true);
ob_implicit_flush(true);

// Connect to database
require_once "meekrodb.2.3.class.php";
DB::$host = "database";
DB::$user = "laravel";
DB::$password = "laravel";
DB::$dbName = "laravel";
DB::$encoding = "utf8";

$txtfile = file_get_contents('http://www.heartofthecards.com/translations/hotcwsappdata174fv.txt');

foreach( explode("^^^^^^", $txtfile) as $line )
{
	$entry = explode("=====", $line);
	$cardNo = trim($entry[0]);
	$cardEngName = trim($entry[3]);
	
	$entry[4] = trim($entry[4]);
	$entry[5] = trim($entry[5]);
	
	if(strcmp($entry[4], "No Keyword1") == 0)
		$cardTraitOne = "None";
	else
		$cardTraitOne = $entry[4];
	
	if(strcmp($entry[5], "No Keyword2") == 0)
		$cardTraitTwo = "None";
	else
		$cardTraitTwo = $entry[5];
  
  // Card array to update values
  $card = array(
    'name_eng' => $cardEngName,
	'trait_one_eng' => $cardTraitOne,
	'trait_two_eng' => $cardTraitTwo
  );
  
  DB::update('ws_cards', $card, 'card_id LIKE %ss', $cardNo);
  
  echo "Updated $cardNo\r\n";

  flush();
}
?>