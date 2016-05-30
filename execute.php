<?php
$channel_id = "1467935162";
$channel_secret = "5e7c61c9e02a806fe75fe8492565fcf5";
$mid = "u061417cfdfc7a13cfbd29e14c9187cc9";
 
/* 送られてきたメッセージの情報を取得 */
$result = file_get_contents("php://input");
$receive = json_decode($result);
$text = $receive->result{0}->content->text;
$from = $receive->result[0]->content->from;
//$content_type = $receive->result[0]->content->contentType;
 
/* 返信 */
$header = ["Content-Type: application/json; charser=UTF-8", "X-Line-ChannelID:" . $channel_id, "X-Line-ChannelSecret:" . $channel_secret, "X-Line-Trusted-User-With-ACL:" . $mid];
//$message = getContentType($content_type);
$nicemakerBOT = file_get_contents("http://nicemaker.esy.es/line.php?send=" . $result);

$message = explode("║",$nicemakerBOT);
//sendMessage($header, $from, $nicemakerBOT);
//sendMessage($header, $from, $message[1]);

for($i=0;$i<$message[0];$i=$i+2){
//	$temp= explode("║",$massage[$i]);
//	$sendto=$temp[0];
//	$sendtext=$temp[1];
sendMessage($header, $message[$i+1], $message[$i+2]);
} 
/* メッセージを送る */
function sendMessage($header, $to, $message) {
 
$url = "https://trialbot-api.line.me/v1/events";
$data = ["to" => [$to], "toChannel" => 1383378250, "eventType" => "138311608800106203", "content" => ["contentType" => 1, "toType" => 1, "text" => $message]];
$context = stream_context_create(array(
"http" => array("method" => "POST", "header" => implode(PHP_EOL, $header), "content" => json_encode($data), "ignore_errors" => true)
));
file_get_contents($url, false, $context);
}
 
/* コンテントタイプの種類分け */
function getContentType($value) {
 
$content_type = "";
switch($value) {
		 		case 1 :
		$content_type = "Text message";
		break;
		case 2 :
		$content_type = "Image message";
		break;
		case 3 :
		$content_type = "Video message";
		break;
		case 4 :
		$content_type = "Video message";
		break;
		case 7 :
		$content_type = "Location message";
		break;
		case 8 :
		$content_type = "Sticker message";
		break;
		case 10 :
		$content_type = "Contact message";
		break;
		default:
		$content_type = "unknown";
		break;
}	
 
return $content_type;
}
