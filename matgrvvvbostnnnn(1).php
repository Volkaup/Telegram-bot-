<?php
date_default_timezone_set('Africa/Cairo');
$token = "7817692574:AAHaY4nH0wvEqYZJ_JU60q_5eMu8s3uDYl0";
define('API_KEY',$token);
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
            function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function save($path,$array){
return file_put_contents("$path",json_encode($array));
}
function save2($array){
    file_put_contents('sales.json', json_encode($array));
}
function SendChatAction($chat_id, $action)
{
    return bot('sendChatAction', [
        'chat_id' => $chat_id,
        'action' => $action
    ]);
}
function SendMessage($chat_id, $text, $parse_mode = "MARKDOWN", $disable_web_page_preview = true, $reply_to_message_id = null, $reply_markup = null)
{
    return bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $parse_mode,
        'disable_web_page_preview' => $disable_web_page_preview,
        'disable_notification' => false,
        'reply_to_message_id' => $reply_to_message_id,
        'reply_markup' => $reply_markup
    ]);
}
$update = json_decode(file_get_contents('php://input'));
if($update->message){
	$message = $update->message;
$message_id = $update->message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$title = $message->chat->title;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
}
if($update->callback_query){
$data = $update->callback_query->data;
$chat_id = $update->callback_query->message->chat->id;
$title = $update->callback_query->message->chat->title;
$message_id = $update->callback_query->message->message_id;
$name = $update->callback_query->message->chat->first_name;
$user = $update->callback_query->message->chat->username;
$from_id = $update->callback_query->from->id;
}
if($update->edited_message){
	$message = $update->edited_message;
	$message_id = $message->message_id;
$username = $message->from->username;
$chat_id = $message->chat->id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
	}
	if($update->channel_post){
	$message = $update->channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$title = $message->chat->title;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->edited_channel_post){
	$message = $update->edited_channel_post;
	$message_id = $message->message_id;
$chat_id = $message->chat->id;
$text = $message->text;
$user = $message->chat->username;
$name = $message->author_signature;
$from_id = $message->chat->id;
	}
	if($update->inline_query){
		$inline = $update->inline_query;
		$message = $inline;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$query = $message->query;
$text = $query;
		}
	if($update->chosen_inline_result){
		$message = $update->chosen_inline_result;
		$user = $message->from->username;
$name = $message->from->first_name;
$from_id = $message->from->id;
$inline_message_id = $message->inline_message_id;
$message_id = $inline_message_id;
$text = $message->query;
$query = $text;
		}
		$tc = $update->message->chat->type;
		$re = $update->message->reply_to_message;
		$re_id = $update->message->reply_to_message->from->id;
$re_user = $update->message->reply_to_message->from->username;
$re_name = $update->message->reply_to_message->from->first_name;
$re_messagid = $update->message->reply_to_message->message_id;
$re_chatid = $update->message->reply_to_message->chat->id;
$photo = $message->photo;
$video = $message->video;
$sticker = $message->sticker;
$file = $message->document;
$audio = $message->audio;
$voice = $message->voice;
$caption = $message->caption;
$photo_id = $message->photo[back]->file_id;
$video_id= $message->video->file_id;
$sticker_id = $message->sticker->file_id;
$file_id = $message->document->file_id;
$music_id = $message->audio->file_id;
$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$title = $message->chat->title;
if($re){
	$forward_type = $re->forward_from->type;
$forward_name = $re->forward_from->first_name;
$forward_user = $re->forward_from->username;
	}else{
$forward_type = $message->forward_from->type;
$forward_name = $message->forward_from->first_name;
$forward_user = $message->forward_from->username;
$forward_id = $message->forward_from->id;
if($forward_name == null){
	$forward = $message->forward_from_chat;
$forward_id = $message->forward_from_chat->id;
$forward_title = $message->forward_from_chat->title;
	}
}
$sales = json_decode(file_get_contents('sales.json'),1);

$title = $message->chat->title;
$admin = "8004276080"; // ايديك
///
$saiko = json_decode(file_get_contents("saiko.json"),1);
if($saiko['gch'] == null){
$saiko['gch'] = "❎";
file_put_contents("saiko.json",json_encode($saiko));
}
$xch = $saiko['ch'];
///
$members = explode("\n",file_get_contents("members.txt"));
$count = count($members) -1;
if($tc == 'private' and !in_array($from_id,$members)){
file_put_contents('members.txt',$from_id."\n",FILE_APPEND);
}
///
$oop = $xch;
$join = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$oop&user_id=".$from_id);
$zr = str_replace("@","",$oop);
if($saiko['ch'] != null){
if($saiko['gch'] == "✅"){
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
if(preg_match('/\/(start)(.*)/', $text)){
  $ex = explode(' ', $text);
  if(isset($ex[1])){
  if($ex[1] != $chat_id){
   if(!in_array($chat_id, $sales[$chat_id]['id'])){
    $sales[$ex[1]]['collect'] += 1;
    save2($sales);
    bot('sendMessage',[
     'chat_id'=>$ex[1] ,
     'text'=>"قام [$chat_id](tg://user?id=$chat_id) بلدخول الي رابطك 🌐 و حصلت علي نقطه واحده ✨
عدد نقاطك الان 💰 : ".$sales[$ex[1]]['collect'], 
'parse_mode'=>'markdown',
    ]);
   }
   }
   }
   }
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
عذراً يجب عليك الاشتراك في القناه لتستطيع استخدام البوت ⚠️
⏺ :  $oop
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'اضغط هنا ✅' ,'url'=>"t.me/$zr"]],
]])
]);
return false;
}
}
}
$savefile = json_decode(file_get_contents("$chat_id.json"),true);
///

///
if($text == "/start" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
قائمة الادمن 🔽
⎯ ⎯ ⎯ ⎯
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"اضف نقاط ➕",'callback_data'=>'addp'],['text'=>"خصم نقاط ➖",'callback_data'=>'delp']],
[['text'=>"صنع هديه 📦",'callback_data'=>'makegift']],
[['text'=>'الاحصائيات 📈' ,'callback_data'=>"1"]],
[['text'=>'تغير الـstart 📮' ,'callback_data'=>"4"],['text'=>'قناة الاشتراك 📊' ,'callback_data'=>"2"]],
[['text'=>'الاشعارات ℹ️' ,'callback_data'=>"6"],['text'=>'الادمنية 👨🏼‍💼' ,'callback_data'=>"5"]],
[['text'=>'اذاعة 📨' ,'callback_data'=>"10"]],
]])
]);
$saiko['ok'] = "no";
file_put_contents("saiko.json",json_encode($saiko));
}
if($data == 'makegift' && $from_id == $admin){
file_put_contents('admin.json',json_encode(['ok'=>'gift']));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
ارسل الكود هكذا مثلا : PVQ7VWP51LVQP510BS-6
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"الغاء",'callback_data'=>'back']],
]
])
]);
return false;
}
if($text != '/start' && json_decode(file_get_contents('admin.json'),true)['ok'] == 'gift' && $from_id == $admin){
file_put_contents('gifts.txt',$text."\n",FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
تم صنع الكود : `-gift{$text}`
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"نشر فلقناه 🗿",'callback_data'=>'postchanel#'.$text]],
]
])
]);
unlink('admin.json');
return false;
}
if(explode('#',$data)['0'] == 'postchanel' && $from_id == $admin){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
تم النشر 👍🏼
",
]);
$pahs = explode('#',$data)[1];
$paaw = explode('-',$pahs)[2];
bot('sendMessage',[
'chat_id'=>"@VOLKA_UP1",
'text'=>"
📦 - تم صنع هديه بقيمه {$paaw} نقاط ♨️
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"الحصول عليها 🌝",'url'=>'https://t.me/RX20bot?start=-gift'.explode('#',$data)[1]]],
]
])
]);
return false;
}
if($data == 'addp' and $from_id == $admin){
file_put_contents('adm.txt','add');
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
حسنا ارسل ايدي العضو 
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
return false;
}
$com = file_get_contents('adm.txt');
if($text != '/start' and $com == 'add' and $from_id == $admin){
file_put_contents('adm2.txt',$text);
file_put_contents('adm.txt','count');
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
حسنا ارسل عدد النقاط
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
return false;
}
$com = file_get_contents('adm.txt');
if($text != '/start' and $com == 'count' and $from_id == $admin){
$ids = file_get_contents('adm2.txt');
if(in_array($ids,$sales[$ids]['id'])){
$sales[$ids]['collect'] += $text;
save2($sales);
bot('sendMessage',[
'chat_id'=>$ids,
'text'=>"
تمت إضافة $text الي حسابك ➕
عدد نقاطك الحالي {$sales[$ids]['collect']} 💰
",
]);
unlink('adm.txt');
unlink('adm2.txt');
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
تمت إضافة $text الي [$ids](tg://user?id=$ids) 🙂
",
'parse_mode'=>"markdown",
]);
return false;
} else {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
لا يوجد هكذا مستخدم في ملف النقاط
",
]);
unlink('adm.txt');
unlink('adm2.txt');
return false;
}
}
if($data == 'delp' and $from_id == $admin){
file_put_contents('adm.txt','del');
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
حسنا ارسل ايدي العضو 
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
return false;
}
$com = file_get_contents('adm.txt');
if($text != '/start' and $com == 'del' and $from_id == $admin){
file_put_contents('adm2.txt',$text);
file_put_contents('adm.txt','counts');
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
حسنا ارسل عدد النقاط
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
return false;
}
$com = file_get_contents('adm.txt');
if($text != '/start' and $com == 'counts' and $from_id == $admin){
$ids = file_get_contents('adm2.txt');
if(in_array($ids,$sales[$ids]['id'])){
$sales[$ids]['collect'] -= $text;
save2($sales);
bot('sendMessage',[
'chat_id'=>$ids,
'text'=>"
تمت خصم $text من حسابك ➖
عدد نقاطك الحالي {$sales[$ids]['collect']} 💰
",
]);
unlink('adm.txt');
unlink('adm2.txt');
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
تمت خصم $text من [$ids](tg://user?id=$ids) 🙂
",
'parse_mode'=>"markdown",
]);
return false;
} else {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
لا يوجد هكذا مستخدم في ملف النقاط
",
]);
unlink('adm.txt');
unlink('adm2.txt');
return false;
}
}
if($data == "back"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
قائمة الادمن 🔽
⎯ ⎯ ⎯ ⎯
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>"اضف نقاط ➕",'callback_data'=>'addp'],['text'=>"خصم نقاط ➖",'callback_data'=>'delp']],
[['text'=>"صنع هديه 📦",'callback_data'=>'makegift']],
[['text'=>'الاحصائيات 📈' ,'callback_data'=>"1"]],
[['text'=>'تغير الـstart 📮' ,'callback_data'=>"4"],['text'=>'قناة الاشتراك 📊' ,'callback_data'=>"2"]],
[['text'=>'الاشعارات ℹ️' ,'callback_data'=>"6"],['text'=>'الادمنية 👨🏼‍💼' ,'callback_data'=>"5"]],
[['text'=>'اذاعة 📨' ,'callback_data'=>"10"]],
]])
]);
unlink("adm.txt");
unlink('admin.json');
$saiko['ok'] = "no";
file_put_contents("saiko.json",json_encode($saiko));
return false;
}
if($data == "1"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
عدد الاعضاء : *$count*
  ⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
}
if($saiko['ch'] == null){
$ch = "لا توجد قناة حاليا";
}elseif($saiko['ch'] != null){
$ch = $saiko['ch'];
}
$nch = $saiko['gch'];
if($data == "2"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
قنوات الاشتراك الاجباري 🔽
🔢 القناة : $ch
⎯ ⎯ ⎯ ⎯
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'حذف القناة 🗑️' ,'callback_data'=>"del_ch"],['text'=>'اضف قناة ➕' ,'callback_data'=>"add_ch"]],
[['text'=>'الاشتراك الاجباري '.$nch.'' ,'callback_data'=>"3"]],
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "no";
file_put_contents("saiko.json",json_encode($saiko));
}
if($data == "3" ){
if($saiko['gch']!="✅"){
$iu = "✅";
}else{
$iu ="❎";
}
$saiko['gch'] = $iu;
file_put_contents("saiko.json",json_encode($saiko));
$nch = $saiko['gch'];
bot('editMessageReplyMarkup',[
'chat_id'=>$update->callback_query->message->chat->id,
'message_id'=>$update->callback_query->message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'حذف القناة 🗑️' ,'callback_data'=>"del_ch"],['text'=>'اضف قناة ➕' ,'callback_data'=>"add_ch"]],
[['text'=>'الاشتراك الاجباري '.$nch.'' ,'callback_data'=>"3"]],
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);}
if($data == "add_ch"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
ارفعني ادمن في القناه وارسل معرف القناه مع @ ⏳
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"2"]],
]])
]);
$saiko['ok'] = "ok_ch";
file_put_contents("saiko.json",json_encode($saiko));
exit();
}
if(preg_match("/@/",$text) and $saiko['ok'] == "ok_ch" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ تم اضافه القناة الى الاشتراك الاجباري",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"2"]],
]])
]);
$saiko['ok'] = "no";
$saiko['ch'] = $text;
file_put_contents("saiko.json",json_encode($saiko));
}
if(!preg_match("/@/",$text) and $saiko['ok'] == "ok_ch" and !$data and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"حدث خطاء تاكد من معرف القناة ⚠️",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
}
if($data == "del_ch" and $ch != "لا توجد قناة حاليا"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
تم حذف القناة $ch ✅
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"2"]],
]])
]);
$saiko['ch'] = null;
file_put_contents("saiko.json",json_encode($saiko));
}
if($data == "del_ch" and $ch == "لا توجد قناة حاليا"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
لا توجد قناة ليتم حذفها ⚠️
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"2"]],
]])
]);
}
$qqppla = str_replace("/ban ","",$text);
if($text == "/ban $qqppla" and $from_id == $admin){
file_put_contents("bands.txt",$qqppla."\n",FILE_APPEND);
bot('sendMessage',[
'chat_id'=>$qqppla,
'text'=>"
تم حظرك من البوت 😒
",
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
تم حظرة [$qqppla](tg://user?id=$qqppla) 😊
",
'parse_mode'=>"markdown",
]);
}
$qqppla2 = str_replace("/unban ","",$text);
if($text == "/unban $qqppla2"){
$unban = str_replace("$qqppla2","",file_get_contents("bands.txt"));
file_put_contents("bands.txt","$unban");
bot('sendMessage',[
'chat_id'=>$qqppla2,
'text'=>"
تم الغاء حظرك من البوت 😼
",
]);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
تم الغاء حظره [$qqppla2](tg://user?id=$qqppla2) 😊
",
'parse_mode'=>"markdown",
]);
}
if($data == "4"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
يمكنك الان ارسال رسالة الـstart ⏳
رسالة الـstart الحالية : $start
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "ok_start";
file_put_contents("saiko.json",json_encode($saiko));
}
if($text and $saiko['ok'] == "ok_start" and $from_id == $admin){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
تم تغير رسالة الـstart الى ℹ️:
$text
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "no";
$saiko['start'] = $text;
file_put_contents("saiko.json",json_encode($saiko));
}
if($data == "5"){
$key=[];
foreach ($saiko['admin'] as $ad){
$key[inline_keyboard][]=[[text=>"$ad",callback_data=>"del#$ad"]];
}
$key[inline_keyboard][]=[[text=>"اضف ادمن ➕",callback_data=>"add_admin"]];
$key[inline_keyboard][]=[[text=>"رجوع ↪️",callback_data=>"back"]];
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
يمكنك رفع ادمن وحذف ادمن عن طريق الازرار 🔽
⎯ ⎯ ⎯ ⎯
يمكن للادمن التحقق من الاحصائيات فقط ⚠️
",
reply_markup=>json_encode($key)
]);
}
$ex = explode("#", $data);
if($ex[0] == "del"){
$ser = array_search($ex[1],$saiko["admin"]);
unset($saiko["admin"][$ser]);
file_put_contents("saiko.json",json_encode($saiko));
$key=[];
foreach ($saiko['admin'] as $ad){
$key[inline_keyboard][]=[[text=>"$ad",callback_data=>"del#$ad"]];
}
$key[inline_keyboard][]=[[text=>"اضف ادمن ➕",callback_data=>"add_admin"]];
$key[inline_keyboard][]=[[text=>"رجوع ↪️",callback_data=>"back"]];
bot('editMessageReplyMarkup',[
'chat_id'=>$update->callback_query->message->chat->id,
'message_id'=>$update->callback_query->message->message_id,
reply_markup=>json_encode($key)
]);
}
if($data == "add_admin"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
الان ارسل ايدي الشخص ℹ️
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "ok_admin";
file_put_contents("saiko.json",json_encode($saiko));
}
if($text  and $from_id == $admin and $saiko['ok'] == "ok_admin" and !in_array($text,$members)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
$text ليس عضو بالبوت ⚠️
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
}
$test = $saiko['admin'];
if($text and $from_id == $admin and $saiko['ok'] == "ok_admin" and in_array($text,$test)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
العضو مرفوع ادمن ⚠️
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "no";
file_put_contents("saiko.json",json_encode($saiko));
exit();
}
if($text and $from_id == $admin and $saiko['ok'] == "ok_admin" and in_array($text,$members)){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
تم اضافه $text ادمن ✅
",
'reply_to_message_id'=>$message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['admin'][] = $text;
$saiko['ok'] = "no";
file_put_contents("saiko.json",json_encode($saiko));
}
if($text== "/start" and in_array($from_id,$saiko['admin'])){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
عدد الاعضاء : *$count*
  ⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
'reply_to_message_id'=>$message->message_id,
]);
}
$d6 = $saiko['d6'];
$d7 = $saiko['d7'];
if($data == "6"){
bot('EditMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
اضغط لتعديل على القفل و الفتح 🔽
⎯ ⎯ ⎯ ⎯
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'اشعارات الدخول '.$d6.'' ,'callback_data'=>"d6"]],
[['text'=>'اشعارات الاستخدام '.$d7.'' ,'callback_data'=>"d7"]],
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);
}
if($data == "d6" ){
if($saiko['d6']!="✅"){
$dp = "✅";
}else{
$dp ="❎";
}
$saiko['d6'] = $dp;
file_put_contents("saiko.json",json_encode($saiko));
$d6 = $saiko['d6'];
bot('editMessageReplyMarkup',[
'chat_id'=>$update->callback_query->message->chat->id,
'message_id'=>$update->callback_query->message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'اشعارات الدخول '.$d6.'' ,'callback_data'=>"d6"]],
[['text'=>'اشعارات الاستخدام '.$d7.'' ,'callback_data'=>"d7"]],
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);}
if($data == "d7" ){
if($saiko['d7']!="✅"){
$as = "✅";
}else{
$as ="❎";
}
$saiko['d7'] = $as;
file_put_contents("saiko.json",json_encode($saiko));
$d7 = $saiko['d7'];
bot('editMessageReplyMarkup',[
'chat_id'=>$update->callback_query->message->chat->id,
'message_id'=>$update->callback_query->message->message_id,
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'اشعارات الدخول '.$d6.'' ,'callback_data'=>"d6"]],
[['text'=>'اشعارات الاستخدام '.$d7.'' ,'callback_data'=>"d7"]],
[['text'=>'رجوع ↪️' ,'callback_data'=>"back"]],
]])
]);}
if($message and $text != "/start" and $from_id != $admin and $d7 == "✅" and !$data){
bot('forwardMessage',[
'chat_id'=>$admin,
'from_chat_id'=>$chat_id,
 'message_id'=>$update->message->message_id,
'text'=>$text,
]);
}
if($user == null){
$user = "None";
}elseif($user != null){
$user = $user;
}
if($text == "/start" and $from_id != $admin and $d6 == "✅" and !in_array($from_id,$members)){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"
تم دخول عضو جديد الى البوت ℹ️ :
الاسم : [$name]
المعرف : [@$user]
الايدي : [$from_id](tg://user?id=$from_id)
⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
]);
}
#اذاعه .
if($data == "10"){
			            bot('EditMessageText',[
	'chat_id'=>$chat_id, 
	'message_id'=>$message_id,
'text'=>"
ارسل الرساله التي تريد اذاعتها يمكن ان تكون (نص، صوره ، فديو، الخ) ⏳
",
'reply_markup'=>json_encode([ 
'inline_keyboard'=>[
[['text'=>'الغاء ↪️' ,'callback_data'=>"back"]],
]])
]);
$saiko['ok'] = "send";
file_put_contents("saiko.json",json_encode($saiko));
}
if(!$data and $saiko['ok'] == 'send' and $from_id == $admin){
				foreach($members as $ASEEL){
					if($text)
bot('sendMessage', [
'chat_id'=>$ASEEL,
'text'=>"$text",
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($photo)
bot('sendphoto', [
'chat_id'=>$ASEEL,
'photo'=>$photo_id,
'caption'=>$caption,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($video)
bot('Sendvideo',[
'chat_id'=>$ASEEL,
'video'=>$video_id,
'caption'=>$caption,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($video_note)
bot('Sendvideonote',[
'chat_id'=>$ASEEL,
'video_note'=>$video_note_id,
]);
if($sticker)
bot('Sendsticker',[
'chat_id'=>$ASEEL,
'sticker'=>$sticker_id,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($file)
bot('SendDocument',[
'chat_id'=>$ASEEL,
'document'=>$file_id,
'caption'=>$caption,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($music)
bot('Sendaudio',[
'chat_id'=>$ASEEL,
'audio'=>$music_id,
'caption'=>$caption,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
if($voice)
bot('Sendvoice',[
'chat_id'=>$ASEEL,
'voice'=>$voice_id,
'caption'=>$caption,
'parse_mode'=>"MARKDOWN",
'parse_mode'=>"HTML",
'disable_web_page_preview'=>true,
]);
					}
	             for($i=0;$i<count($members); $i++){
$ok = bot('sendChatAction' , ['chat_id' =>$members[$i],
'action' => 'typing' ,])->ok;
if($members[$i] != "" and $ok != 1){
file_put_contents("A5.txt","$members[$i]
",FILE_APPEND);
}}
$ooo = explode("\n",file_get_contents("A5.txt"));
$iii = count($ooo) - 1;
$mmm = $count - $iii;
					bot('sendmessage',[
	'chat_id'=>$chat_id, 
'text'=>"
تم الانتهاء من الاذاعة ✅
⎯ ⎯ ⎯ ⎯
تم ارسالها الى $mmm
لم ترسل الى $iii
⎯ ⎯ ⎯ ⎯
",
'parse_mode'=>"Markdown",
	'reply_to_meesage_id'=>$message_id,
]);

					unlink("A5.txt");
	file_put_contents("saiko.json",json_encode($saiko));
				}
$hostarray = array("https://dev-bothost.pantheonsite.io/api-host.php","https://dev-bothost2.pantheonsite.io/api-host.php");
$hostarray1 = array_rand($hostarray,1);
$hostarray2 = $hostarray[$hostarray1];
$lockbot = 'false';
$collects = $sales[$chat_id]['collect'];
if($text == '/start' && $from_id != 1931474462){
if($lockbot == 'true'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
~ عذرا عزيزي 🤚
• البوت في صيانه حاليا 🔧
- تابع قناة البوت لمعرفة موعد تشغيله ⁉️
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قناة البوت 💣",'url'=>'t.me/VOLKA_UP1']]
]
])
]);
return false;
}
}
if($data && $from_id != 1931474462){
if($lockbot == 'true'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*
~ عذرا عزيزي 🤚
• البوت في صيانه حاليا 🔧
- تابع قناة البوت لمعرفة موعد تشغيله ⁉️
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"قناة البوت 💣",'url'=>'t.me/VOLKA_UP1']]
]
])
]);
return false;
}
}
$bandlist = explode("\n",file_get_contents("bands.txt"));
if($text == '/start'){
if(in_array($from_id,$bandlist)){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
*انت محظور من استخدام البوت 📛*
",
'parse_mode'=>"markdown",
]);
return false;
} else {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
➖ اهلا بك في بوت صنع استضافه 🔧
➖ يمكنك صنع استضافه بكل سهوله ⚡
➖ فقط اجمع نقاط و اشتري استضافه 💁🏼‍♂️

➖ فلتختر ما تريد 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد نقاطك ← $collects 🎭",'callback_data'=>'mypoints'],['text'=>"إحصائياتي 👨🏼‍💼",'callback_data'=>'mystatus']],
[['text'=>"جمع نقاط 💰",'callback_data'=>'points'],['text'=>"هديه يوميه 🎁",'callback_data'=>'gifts']],
[['text'=>"صنع استضافه ⚒️",'callback_data'=>'make'],['text'=>"اسعار الاستضافات 💸",'callback_data'=>"webpied"]],
[['text'=>"شرح البوت ⁉️",'callback_data'=>'help'],['text'=>"قناة الهدايا ♨️",'url'=>'T.me/VOLKA_UP1']],
]
])
]);
}
}
if($data == "webpied"){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*
~ اهلا بك في قسم اسعار الاستضافات بلنقاط 💰💁🏼‍♂️

اسم الاستضافه | السعر الخاص بها

دومين عشوائي 🗃️ | 6
اسم اختياري 📝 | 6
دومين خارجي 📂 | 6
حساب استضافه 📇 | 8
استضافه بايثون 🐍 | 9

- للإستفسار : @E_E_3_E_3 ⁉️*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
if($data){
if(in_array($from_id,$bandlist)){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*انت محظور من استخدام البوت 📛*
",
'parse_mode'=>"markdown",
]);
return false;
}
}
if($data == 'make'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*📇 اختر نوع الاستضافه التي تريد صنعها 🛡️*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"Php Hosting 🐘",'callback_data'=>'php'],['text'=>"Python Hosting 🐍(9)",'callback_data'=>'python']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
if($data == 'points'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*
~ اهلا بك في قسم جمع النقاط 💸

• كل ما عليك هو نسخ الرابط الخاص بك و مشاركته مع أصدقائق 👥
• مع كل عضو جديد يدخل الي البوت من خلال رابطك سوف تحصل علي  نقطه ➕

- الرابط الخاص بك هو 🔗🔽*

https://t.me/RX20bot?start={$chat_id}
",
'disable_web_page_preview'=>true,
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"مشاركة الرابط ♻️",'switch_inline_query'=>'share']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
$inlinequery = $update->inline_query->query;
$inlineID = $update->inline_query->from->id;
if($inlinequery == "share" ){
    bot('answerInlineQuery',[
    'inline_query_id'=>$update->inline_query->id,    
    'cache_time'=>'300',
    'results' => json_encode([[
    'type'=>'article',
    'id'=>base64_encode(rand(5,555)),
    'title'=>'اضغط هنا لمشاركة البوت علي رابطك تلقائيا ♻️',
    'thumb_url'=>"https://t.me/RX20bot",
    'description'=>"
شارك البوت مع صديقك للحصول علي نقاط 💰
",
    'input_message_content'=>[
    'disable_web_page_preview'=>true,
    'message_text'=>"
➖ افضل بوت صنع استضافات PHP و PYTHON مجانا 💣
➖ يمكنك صنع استضافات عديده مجانا بمميزات مدفوعه 🛠️
➖ للدخول الي البوت اضغط علي الزر الذي بلأسفل 🌝👍🏼
"],
    'reply_markup'=>['inline_keyboard'=>[
    [['text'=>"دخول للبوت 🤖",'url'=>"https://t.me/RX20bot?start={$from_id}"]]
    ]]
    ]])
    ]);
    }
if(preg_match('/\/(start)(.*)/', $text)){
  $ex = explode(' ', $text);
  if(isset($ex[1])){
 if(substr($ex[1],0,4) == '-ref'){
  if($ex[1] != $chat_id){
   if(!in_array($chat_id, $sales[$chat_id]['id'])){
   if($sales[$ex[1]]['countmember'] == null){
   $sales[$ex[1]]['countmember'] = 0;
   save2($sales);
   }
    $sales[$ex[1]]['collect'] += 1;
    $sales[$ex[1]]['countmember'] += 1;
    save2($sales);
    bot('sendMessage',[
     'chat_id'=>$ex[1] ,
     'text'=>"قام [$chat_id](tg://user?id=$chat_id) بلدخول الي رابطك 🌐 و حصلت علي نقطه واحده ✨
عدد نقاطك الان 💰 : ".$sales[$ex[1]]['collect'], 
'parse_mode'=>'markdown',
    ]);
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
➖ اهلا بك في بوت صنع استضافه 🔧
➖ يمكنك صنع استضافه مجانيه بكل سهوله ⚡
➖ فقط اجمع نقاط و اشتري استضافه 💁🏼‍♂️

➖ فلتختر ما تريد 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد نقاطك ← $collects 🎭",'callback_data'=>'mypoints'],['text'=>"إحصائياتي 👨🏼‍💼",'callback_data'=>'mystatus']],
[['text'=>"جمع نقاط 💰",'callback_data'=>'points'],['text'=>"هديه يوميه 🎁",'callback_data'=>'gifts']],
[['text'=>"صنع استضافه ⚒️",'callback_data'=>'make'],['text'=>"اسعار الاستضافات 💸",'callback_data'=>"webpied"]],
[['text'=>"شرح البوت ⁉️",'callback_data'=>'help'],['text'=>"قناة الهدايا ♨️",'url'=>'T.me/VOLKA_UP1']],
]
])
]);
    $sales[$chat_id]['id'][] = $chat_id;
    save2($sales);
   }
   if($sales[$chat_id]['collect'] == null){
   $sales[$chat_id]['collect'] = 0;
   $sales[$chat_id]['countmember'] = 0;
   save2($sales);
  } 
  } else {
  	bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
• لا يمكنك الدخول علي رابطك للحصول علي نقاط 🌝👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد نقاطك ← $collects 🎭",'callback_data'=>'mypoints'],['text'=>"إحصائياتي 👨🏼‍💼",'callback_data'=>'mystatus']],
[['text'=>"جمع نقاط 💰",'callback_data'=>'points'],['text'=>"هديه يوميه 🎁",'callback_data'=>'gifts']],
[['text'=>"صنع استضافه ⚒️",'callback_data'=>'make'],['text'=>"اسعار الاستضافات 💸",'callback_data'=>"webpied"]],
[['text'=>"شرح البوت ⁉️",'callback_data'=>'help'],['text'=>"قناة الهدايا ♨️",'url'=>'T.me/VOLKA_UP1']],
]
])
]);
}
} elseif(substr($ex[1],0,4) == '-gif'){
$gif = str_replace('-gift','',$ex[1]);
$gifs = explode("\n",file_get_contents("gifts.txt"));
if(in_array($gif,$gifs)){
$pointsc = explode('-',$gif);
$countal = $pointsc[1] + $collects;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
🎉 تمت إضافة → {$pointsc[1]} الي حسابك اصبحت نقاطك → {$countal} ➕
",
]);
$save[$chat_id]['collect'] += $countal;
save2($save);
$pqhsqg = str_replace($gif,'',$gifs);
file_put_contents('gifts.txt',$pqhsqg);
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"
حصل عليها → [$from_id](tg://user?id=$from_id) 🎉
",
'parse_mode'=>"markdown",
]);
} else {
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
⛔ - الكود تم استخدامه او هو معطل ⚠️
",
]);
}
}
if($message && !in_array($chat_id,$sales[$chat_id]['id'])){
$sales[$chat_id]['id'][] = $chat_id;
save2($sales);
if($sales[$chat_id]['collect'] == null){
$sales[$chat_id]['collect'] = 0;
save2($sales);
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
➖ اهلا بك في بوت صنع استضافه 🔧
➖ يمكنك صنع استضافه مجانيه بكل سهوله ⚡
➖ فقط اجمع نقاط و اشتري استضافه 💁🏼‍♂️

➖ فلتختر ما تريد 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد نقاطك ← $collects 🎭",'callback_data'=>'mypoints'],['text'=>"إحصائياتي 👨🏼‍💼",'callback_data'=>'mystatus']],
[['text'=>"جمع نقاط 💰",'callback_data'=>'points'],['text'=>"هديه يوميه 🎁",'callback_data'=>'gifts']],
[['text'=>"صنع استضافه ⚒️",'callback_data'=>'make'],['text'=>"اسعار الاستضافات ??",'callback_data'=>"webpied"]],
[['text'=>"شرح البوت ⁉️",'callback_data'=>'help'],['text'=>"قناة الهدايا ♨️",'url'=>'T.me/VOLKA_UP1']],
]
])
]);
}
}
}
if($data == 'php'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*📇 اختر نوع صنع الاستضافه 🔗*

*⚠️ العدد داخل الاقواس () هو سعر الاستضافه 💸*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"اسم عشوائي 🗃️(6)",'callback_data'=>'anyname'],['text'=>"اسم اختياري 📝(6)",'callback_data'=>'myname']],
[['text'=>"دومين خارجي 📂(6)",'callback_data'=>'anydomain'],['text'=>'حساب استضافه 📇(8)','callback_data'=>'accname']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
unlink("$chat_id.txt");
unlink("$chat_id.text");
} if($data == 'anyname'){
if($sales[$chat_id]['collect'] < 6){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*🔗 اختر الدومين الذي يعجبك 📬*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"orgfree.com",'callback_data'=>'creat#orgfree.com'],['text'=>"6te.net",'callback_data'=>'creat#6te.net']],
[['text'=>"ueuo.com",'callback_data'=>'creat#ueuo.com'],['text'=>"eu5.org",'callback_data'=>'creat#eu5.org']],
[['text'=>"noads.biz",'callback_data'=>'creat#noads.biz'],['text'=>"coolpage.biz",'callback_data'=>'creat#coolpage.biz']],
[['text'=>"freeoda.com",'callback_data'=>'creat#freeoda.com'],['text'=>"freevar.com",'callback_data'=>'creat#freevar.com']],
[['text'=>"freetzi.com",'callback_data'=>'creat#freetzi.com'],['text'=>"xp3.biz",'callback_data'=>'creat#xp3.biz']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
}
$exp = explode("#",$data);
if($exp[0] == 'creat'){
$domains = json_decode(file_get_contents("{$hostarray2}?a=1&domain=".$exp[1]),true);
$status = $domains['status'];
if($status == 'true'){
$domain_name = $domains['url'];
$pasw = $domains['pass'];
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*➖ Done Create Hosting ⚒️*
*————————————————*
➖ Domain Url : http://{$domain_name}
➖ FTP Server : `$domain_name`
➖ Username : `$domain_name`
➖ Password : `$pasw`
➖ Login CPanel : http://{$domain_name}/cpanel/
➖ Login FTP : http://{$domain_name}/ftp/
*————————————————*
⚡ *BY : *@E_E_3_E_3 ∾ @VOLKA_UP1
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع مرة اخري ♻️",'callback_data'=>'make']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
$sales[$chat_id]['collect'] -= 6;
save2($sales);
}
} if($data == 'myname'){
if($sales[$chat_id]['collect'] < 6){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*🔗 اختر الدومين الذي يعجبك 📬*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"orgfree.com",'callback_data'=>'creat1#orgfree.com'],['text'=>"6te.net",'callback_data'=>'creat1#6te.net']],
[['text'=>"ueuo.com",'callback_data'=>'creat1#ueuo.com'],['text'=>"eu5.org",'callback_data'=>'creat1#eu5.org']],
[['text'=>"noads.biz",'callback_data'=>'creat1#noads.biz'],['text'=>"coolpage.biz",'callback_data'=>'creat1#coolpage.biz']],
[['text'=>"freeoda.com",'callback_data'=>'creat1#freeoda.com'],['text'=>"freevar.com",'callback_data'=>'creat1#freevar.com']],
[['text'=>"freetzi.com",'callback_data'=>'creat1#freetzi.com'],['text'=>"xp3.biz",'callback_data'=>'creat1#xp3.biz']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
}
$exp2 = explode("#",$data);
if($exp2[0] == 'creat1'){
if($sales[$chat_id]['collect'] < 6){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
file_put_contents("$chat_id.text",$exp2[1]);
file_put_contents("$chat_id.txt","mydom");
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"*
• ارسل الاسم الذي تريده لصنع الاستضافه 📤
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'make']],
]
])
]);
return false;
} 
}
$com = file_get_contents("$chat_id.txt");
if($text != '/start' and $com == 'mydom'){
$domn = file_get_contents("$chat_id.text");
$domains = json_decode(file_get_contents("{$hostarray2}?a=2&name=$text&domain=".$domn),true);
$status = $domains['status'];
if($status == 'false'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
*• حدث خطأ اثناء صنع الاستضافه 📛*

*• الاخطاء المحتمله 🤔⬇️

¹~> الاسم مستخدم من قبل 💣
²~> تم قطع الاتصال بين الخوادم 💤
³~> الاسم الذي ارسلته بللغه العربيه 🔒
*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
unlink("$chat_id.txt");
unlink("$chat_id.text");
} else {
$domain_name = $domains['url'];
$pasw = $domains['pass'];
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
*➖ Done Create Hosting ⚒️*
*————————————————*
➖ Domain Url : http://{$domain_name}
➖ FTP Server : `$domain_name`
➖ Username : `$domain_name`
➖ Password : `$pasw`
➖ Login CPanel : http://{$domain_name}/cpanel/
➖ Login FTP : http://{$domain_name}/ftp/
*————————————————*
⚡ *BY : *@E_E_3_E_3 ∾ @VOLKA_UP1
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع مرة اخري ♻️",'callback_data'=>'make']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
unlink("$chat_id.txt");
unlink("$chat_id.text");
$sales[$chat_id]['collect'] -= 6;
save2($sales);
} 
} 
if($data == 'anydomain'){
if($sales[$chat_id]['collect'] < 8){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
file_put_contents("$chat_id.txt","anydomain");
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*
➖ حسنا ارسل الدومين الخاص بك 🖇️
➖ مثال علي ذلك : www.domain.com 💡
➖ لا ترسل كلام فارغ امشان ما يتم حظرك 📛

• عليك وضع اسماء السيرفرات التاليه 🔓⬇️*

`ns1.freewha.com`
`ns2.freewha.com`
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'make']],
]
])
]);
return false;
}
}
$com = file_get_contents("$chat_id.txt");
if($text != '/start' and $com == 'anydomain'){
$domains = json_decode(file_get_contents("{$hostarray2}?a=3&domain=".$text),true);
$status = $domains['status'];
if($status == 'false'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
*• حدث خطأ اثناء صنع الاستضافه 📛*

*• الاخطاء المحتمله 🤔⬇️

¹~> الاسم مستخدم من قبل 💣
²~> تم قطع الاتصال بين الخوادم 💤
³~> الاسم الذي ارسلته غير صالح 🔒
*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
unlink("$chat_id.txt");
} else {
$domain_name = $domains['url'];
$pasw = $domains['pass'];
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
*➖ Done Create Hosting ⚒️*
*————————————————*
➖ Domain Url : http://{$domain_name}
➖ FTP Server : `$domain_name`
➖ Username : `$domain_name`
➖ Password : `$pasw`
➖ Login CPanel : http://{$domain_name}/cpanel/
➖ Login FTP : http://{$domain_name}/ftp/
*————————————————*
⚡ *BY : *@E_E_3_E_3 ∾ @VOLKA_UP1
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع مرة اخري ♻️",'callback_data'=>'make']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
$sales[$chat_id]['collect'] -= 8;
save2($sales);
unlink("$chat_id.txt");
} 
} 
if($data == 'accname'){
if($sales[$chat_id]['collect'] < 9){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
$hosting = json_decode(file_get_contents("{$hostarray2}?a=4"),true);
$status = $hosting['status'];
if($status == 'false'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*• حدث خطأ اثناء صنع الاستضافه 📛*

*• الاخطاء المحتمله 🤔⬇️

¹~> تم قطع الاتصال بين الخوادم 💤
*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
} else {
$email = $hosting['email'];
$pass = $hosting['pass'];
$logi = $hosting['login'];
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*➖ Done Create Hosting ⚒️*
*————————————————*
➖ Email : `$email`
➖ Password : `$pass`
➖ Login Hosting : [Click-Here،,،اضغط-هنا]($logi)
*————————————————*
⚡ *BY : *@E_E_3_E_3 ∾ @VOLKA_UP1
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع مرة اخري ♻️",'callback_data'=>'make']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
$sales[$chat_id]['collect'] -= 9;
save2($sales);
} 
}
}
if($data == 'backw'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"*
➖ اهلا بك في بوت صنع استضافه 🔧
➖ يمكنك صنع استضافه مجانيه بكل سهوله ⚡
➖ فقط اجمع نقاط و اشتري استضافه 💁🏼‍♂️

➖ فلتختر ما تريد 👍🏼
*",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"عدد نقاطك ← $collects 🎭",'callback_data'=>'mypoints'],['text'=>"إحصائياتي 👨🏼‍💼",'callback_data'=>'mystatus']],
[['text'=>"جمع نقاط 💰",'callback_data'=>'points'],['text'=>"هديه يوميه 🎁",'callback_data'=>'gifts']],
[['text'=>"صنع استضافه ⚒️",'callback_data'=>'make'],['text'=>"اسعار الاستضافات 💸",'callback_data'=>"webpied"]],
[['text'=>"شرح البوت ⁉️",'callback_data'=>'help'],['text'=>"قناة الهدايا ♨️",'url'=>'T.me/VOLKA_UP1']],
]
])
]);
unlink("$chat_id.txt");
unlink("$chat_id.text");
}
if($data == 'python'){
if($sales[$chat_id]['collect'] < 9){
bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>'عذرا نقاطك ليست كافيه 😥',
      'show_alert'=>true
     ]);
    } else {
$hosting = json_decode(file_get_contents("{$hostarray2}?a=5"),true);
$status = $hosting['status'];
if($status == 'false'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*• حدث خطأ اثناء صنع الاستضافه 📛*

*• الاخطاء المحتمله 🤔⬇️

¹~> تم قطع الاتصال بين الخوادم 💤
*
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
} else {
$email = $hosting['email'];
$userhost = $hosting['user'];
$pass = $hosting['pass'];
$logi = $hosting['login'];
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*➖ Done Create Hosting ⚒️*
*————————————————*
➖ Email : `$email`
➖ Username : `$userhost`
➖ Password : `$pass`
➖ Login Hosting : [Click-Here،,،اضغط-هنا]($logi)
*————————————————*
⚡ *BY : *@E_E_3_E_3 ∾ @VOLKA_UP1
",
'parse_mode'=>"markdown",
'disable_web_page_preview'=>true,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"صنع مرة اخري ♻️",'callback_data'=>'make']],
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
$sales[$chat_id]['collect'] -= 9;
save2($sales);
} 
}
}
if($data == 'help'){
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"
*➖ اهلا بك في قسم الشرح ⚠️

• يمكنك صنع استضافه PHP او PYTHON بسهوله عن طريق البوت 🤖
• فقط اضغط علي جمع نقاط سوف يعطيك البوت الرابط الخاص بك 🔗
• يمكنك بواسطة الرابط الخاص بك جمع النقاط فقط شارك الرابط الخاص بك مع اصدقائق 👥
• مع كل عضو جديد يدخل للبوت عن طريق رابطك سوف تحصل علي نقطه ➕
• بعد جمع عدد كاف من النقاط 💰🔽
• فقط اضغط علي صنع استضافه 🔧
• اختر نوع الاستضافه التي تريدها PHP او PYTHON 🔓
• اختر الدومين الذي تريده 🔗
• بعد ذلك انسخ اسم المستخدم و كلمة السر و سجل دخولك في الاستضافه 💯

• للإستفسار : *@E_E_3_E_3 ✔️
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
if($data == 'mystatus'){
$countme = $sales[$chat_id]['countmember'];
bot('editMessageText',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>"🙋🏻‍♂️ - اهلا عزيزي في إحصائياتك 📈

عدد نقاطك ← $collects
عدد الاشخاص الذين دخلو من رابطك ← $countme
",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"رجوع 🔙",'callback_data'=>'backw']],
]
])
]);
}
if($data == 'mypoints'){
	bot('answercallbackquery',[
      'callback_query_id' => $update->callback_query->id,
      'text'=>"• عدد نقاطك الحالي هو : $collects 💸",
      'show_alert'=>true
     ]);
    }
$d = date('D');
$day = explode("\n",file_get_contents($d.".txt"));
if($d == "Sat"){
unlink("Fri.txt");
}
if($d == "Sun"){
unlink("Sat.txt");
}
if($d == "Mon"){
unlink("Sun.txt");
}
if($d == "Tue"){
unlink("Mon.txt");
}
if($d == "Wed"){
unlink("The.txt");
}
if($d == "Thu"){
unlink("Wed.txt");
}
if($d == "Fri"){
unlink("Thu.txt");
}
if($data == "gifts"){ 
if(!in_array($from_id, $day)){
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text'=>"
• لقد حصلت علي : 0.4 نقطه 🎁
• يمكنك الحصول علي مرة اخري غدا 🎃
",
'show_alert'=>true,
]);
file_put_contents($d.'.txt',$from_id."\n",FILE_APPEND);
$sales[$from_id]['collect'] += 0.4;
save2($sales);
}else{
bot('answercallbackquery',[
'callback_query_id'=>$update->callback_query->id,
'text' =>"
• لقد حصلت عليها بلفعل 😕
• حاول مجددا بعد منتصف الليل 🔄
",
'show_alert'=>true,
]);
}
}
