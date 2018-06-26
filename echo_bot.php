
<?php
/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 
 
require_once('./LINEBotTiny.php');

$channelAccessToken = 'CFryF/jnbdfvU0fpaTsRPBy+tumb/fH/qr234FWwiriy5L3MsSzup1f0hgNof3sEBSg5+yzrTICVjq8i2rZEUZ1evUbe/fm0ou6rjSTGytKp8omr+FTAwf6eOwjFmBqRvWQWXItdv5RgRdHjafPpogdB04t89/1O/w1cDnyilFU=';
$channelSecret = '10ae60342956772efeb2b8e6c134564f';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
 
	$message = $event['message'];
	$user_type = urlencode($message['text']);
	$sources= $event['source'];
	$hisID= $sources['userId'];
	$ismember = "no";
$url="https://755.club.tw/line/exe.php?user_type=". $user_type . "&hisID=" . $hisID;
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
 
curl_close($ch);

$array_go=json_decode($output);

                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => $array_go));


}
?>