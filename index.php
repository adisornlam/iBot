<?php
    $accessToken = "PthQHPDy0/tQVhN5OFxYjF3+blSYfYlh5wp1jAa5rOj4MRpSvlGtvJ+1xm7nQ//nqdo9r9A01b3yQWlFS/t+7nBF7wE16EPkLczdwIUdx7FaMYnD/CIvP6LCK+5XkYkGSKjTg7pwhVllrNooCXbZqgdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $msg = "สวัสดีจ้า มีอะไรให้น้องไอลิลช่วยคะ กดส่งตัวเลขมาได้เลยค่ะ \n";
        $msg .= "กด 1 ที่อยู่คอนโด\n"; 
        $msg .= "กด 2 บัตรประชาชนพ่อ \n";
        $msg .= "กด 3 บัตรประชาชนแม่ \n";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $msg;
        replyMsg($arrayHeader,$arrayPostData);
    }else if($message == 1){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "403/45 หมู่ 8 เดอะริเวอร์ปาร์คโมเดิร์นเพลส ถนนพหลโยธิน 70 ตำบลคูคต อำเภอลำลูกา จังหวัดปทุมธานี 12130";
        replyMsg($arrayHeader,$arrayPostData);
    }else if($message == 2){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "1400500036581";
        replyMsg($arrayHeader,$arrayPostData);
    }else if($message == 3){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "1xxxxxxxxxxxx";
        replyMsg($arrayHeader,$arrayPostData);
    }else if(($message == 55) OR ($message == 555) OR ($message == 5555)){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11538";
        $arrayPostData['messages'][0]['stickerId'] = "51626504";
        replyMsg($arrayHeader,$arrayPostData);
    }else if($message == "น่ารัก"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11538";
        $arrayPostData['messages'][0]['stickerId'] = "51626499";
        replyMsg($arrayHeader,$arrayPostData);
    }else if(($message == "สุดยอด") OR ($message == "ยอดเยี่ยม") OR ($message == "เยี่ยม")){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11537";
        $arrayPostData['messages'][0]['stickerId'] = "52002735";
        replyMsg($arrayHeader,$arrayPostData);
    }else if(($message == "ok") OR ($message == "เค") OR ($message == "โอเคจ้า") OR ($message == "โอเค")){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11537";
        $arrayPostData['messages'][0]['stickerId'] = "52002740";
        replyMsg($arrayHeader,$arrayPostData);
    }else if($message == "วาดรูป"){   
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "line://app/1573340913-29AmBnaD";
    }
    
    
    function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }

    function pushMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/push";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
     }
   exit;
?>
