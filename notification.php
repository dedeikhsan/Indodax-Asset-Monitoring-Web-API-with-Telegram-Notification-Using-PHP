<?php

global $asetAman;
global $asetTurun;
global $asetNaik;

require_once "setting.php";

foreach ($data['tickers'] as $data) {

    if ($data['last'] >= $data['low'] && $data['last'] <= $data['high']) {
        $pesan = "Aset anda : " . $data['name'] . ' |' .  " Price: " . number_format($data['last']) . " aman!..";
        sendNotif($pesan);
        $hitungAman[] = 1;
        $asetAman = count($hitungAman);
    } else if ($data['last'] < $data['low']) {
        $pesan1 = "Aset anda : " . $data['name'] . ' |' .  " Price: " . number_format($data['last']) .  " turun!..";
        sendNotif($pesan1);
        $hitungTurun[] = 1;
        $asetTurun = count($hitungTurun);
    } else {
        $pesan2 = "Aset anda : " . $data['name'] . ' |' . " Price: " . number_format($data['last']) .  " naik!..";
        sendNotif($pesan2);
        $hitungNaik[] = 1;
        $asetNaik = count($hitungNaik);
    }

    $hitungTotal[] = 1;
    $asetTotal = count($hitungTotal);
}

//Aset aman
$pesan1 = "Total " . $asetAman . " aset anda aman!...";
echo $pesan1;
sendNotif($pesan1);

//Aset turun
if ($asetTurun == 0) {
    $erorTurun = "Total 0 aset turun!...";
    echo $erorTurun;
    sendNotif($erorTurun);
} else {
    $pesan2 = "Total " . $asetTurun . " aset anda turun!...";
    echo $pesan2;
    sendNotif($pesan2);
}

//Aset naik
if ($asetNaik == 0) {
    $erorNaik = "Total 0 aset anda naik!...";
    echo $erorNaik;
    sendNotif($erorNaik);
} else {
    $pesan3 = "Total " . $asetNaik . " aset anda naik!...";
    echo $pesan3;
    sendNotif($pesan3);
}

//Total aset
$pesan4 = "Total " . $asetTotal . " aset telah dicek, Enjoy your trade!...";
echo $pesan4;
sendNotif($pesan4);


function sendNotif($pesan)
{
    $token = "YOUR BOT ID";
    $chat_id = "YOUR CHAT/GROUP ID";

    $pesan = json_encode($pesan);
    $API = "https://api.telegram.org/bot" . $token . "/sendmessage?chat_id=" . $chat_id . "&text=$pesan";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, $API);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// $chat = "set";
// sendNotif($chat);
