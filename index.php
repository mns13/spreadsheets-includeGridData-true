<?php

require_once __DIR__ . "/vendor/autoload.php";

$client = new Google_Client();
$client->setAuthConfig(__DIR__.'\credentials.json');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1FS5_xR8YqkBnQPBtL2-r5ieNik-QOVILke5GWnxHovM';

$spreadsheets = $service->spreadsheets->get($spreadsheetId,['includeGridData'=>true]);

$sheets = $spreadsheets->getSheets();

$tmp = $sheets[0];
$sheets = $tmp->data;

$tmp = $sheets[0];
$sheets = $tmp->rowData;

foreach($sheets as $sheet) {

  $rows = $sheet->values;

  foreach($rows as $row){

    if(empty($row->hyperlink)) continue;
    echo $row->formattedValue . "<br>";
    echo $row->hyperlink . "!<br><br>";

  }

}