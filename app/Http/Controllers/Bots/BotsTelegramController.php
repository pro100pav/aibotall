<?php

namespace App\Http\Controllers\Bots;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bot\Bot;
use App\Models\Bot\BotChat;
use App\Models\Bot\UserChatBot;
use App\Models\Gpt\GptKey;
use App\Customs\Gpt;
use App\Customs\CreateUser;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class BotsTelegramController extends Controller
{
    public function index(Request $request, $id){
        $bot = Bot::find($id);
        $token = $bot->token;
        $telegram = new Api($token);
        $result = $telegram->getWebhookUpdates();

        if (isset($result["message"])) {
            
            $chat_id = '';
            if(isset($result["message"]["chat"]["id"])){
                $chat_id = $result["message"]["chat"]["id"];
            }
            // if($chat_id == 1072379974){
            //     exit();
            // }
            $text = '';
            if(isset($result["message"]["text"])){
                $text = $result["message"]["text"];
            }
            $this->saveUserNew($result, $text, $chat_id, $bot);
            if($text){
                
                if($text == '/start'){
                    $this->saveMessage($text, $chat_id, $bot, 'client');
$reply = 'Привет, я бесплатный чат GPT в телеграм боте.

Я могу отвечать на вопросы, предоставлять информацию, выполнять команды, развлекать, помогать в организации задач и многое другое. Результат нашего с тобой взаимодействия. зависит именно от твоих целей и фантазии.

<b>Вот пара примеров:</b>

ТЫ можешь попросить меня, составить или переделать текст для постов, статей или презентации например, главное чтобы я мог понять свою роль и экспертность. 
Пример 1. Тебе нужно написать текст для постов в сообщество предоставляющие услуги. я могу например, сначала предложить темы для постов.. 

Пример твоего запроса:
—> <b>Представь, что ты мастер по ремонту Стиральных машин, напиши 10 тем для постов.</b>

Я предоставлю тебе варианты тем, далее я могу написать пост на каждую. 
Например: 
—>  <b>Представь, что ты мастер по ремонту Стиральных машин, напиши пост на тему:
"Какие средства для стирки лучше использовать и почему"</b>

Пример 2. Вариант.. Я могу выступить, к примеру, в роли нумеролога, и рассказать о качествах человека. тогда можешь написать так...

Пример:

—> <b>Представь, что ты нумеролог, проведи индивидуальный разбор Мужчины Ивана, по дате рождения 25.07.1987</b>

———————————
<i>И еще очень много вариантов применения, ты можешь придумать)) Не ограничивай свою фантазию) Вариантов применения очень много.</i>
';
                    try {
                        $response = $telegram->sendPhoto([
                            'chat_id' => $chat_id,
                            'photo' => \Telegram\Bot\FileUpload\InputFile::create('https://my-all.ru/assets/botimage.jpg'),
                        ]);
                        $response = $telegram->sendMessage([
                            'chat_id' => $chat_id,
                            'text' => $reply,
                            'parse_mode' => 'HTML'
                        ]);
                    } catch (TelegramResponseException $e) {
                        $response = "Заблокирован";
                    }
                    
                    $this->saveMessage($reply, $chat_id, $bot, 'bot');
                    
                }elseif($text == '/register'){
                    $this->saveMessage($text, $chat_id, $bot, 'client');
                    $create = new CreateUser();
                    $resultUser = $create->index($result);
                    if($resultUser == 'Существует'){
$reply = "Вы уже зарегистрированы
Личный кабинет: https://my-all.ru/login
"; 
                    }else{
$reply = "Ваши данные для входа в личный кабинет:
Логин: ".$resultUser['login']."
Пароль: ".$resultUser['password']."
Личный кабинет: https://my-all.ru/login
";
                    }

                    try {
                        $response = $telegram->sendMessage([
                            'chat_id' => $chat_id,
                            'text' => $reply,
                        ]);
                    } catch (TelegramResponseException $e) {
                        $response = "Заблокирован";
                    }
                    $this->saveMessage($reply, $chat_id, $bot, 'bot');
                    
                }elseif($text == '/login'){
                    $this->saveMessage($text, $chat_id, $bot, 'client');
$reply = "Личный кабинет: https://my-all.ru/login"; 
                        try {
                            $response = $telegram->sendMessage([
                                'chat_id' => $chat_id,
                                'text' => $reply,
                            ]);
                        } catch (TelegramResponseException $e) {
                            $response = "Заблокирован";
                        }
                    $this->saveMessage($reply, $chat_id, $bot, 'bot');
                    
                }else{
                    
                    $reply = 'Ваш запрос получен, когда ответ будет сформирован мы пришлем его вам. Среднее время обработки запроса составляет 1 минуту';
                    $response = $telegram->sendMessage([
                        'chat_id' => $chat_id,
                        'text' => $reply,
                    ]);
                    $req = $this->saveMessage($text, $chat_id, $bot, 'botgpt');
                    
                }
            }
        }
    }


    function saveUserNew($info, $idUser, $chat_id, $bot){
        $hasChat = BotChat::where([['bot_id', $bot->id],['id_telegram', $chat_id]])->first();
        if(!$hasChat){
            $name = '';
            $username = '';
            if(isset($info["message"]["chat"]["first_name"])){
                $name = $info["message"]["chat"]["first_name"];
            }else{
                $name = 'Таинственный незнакомец';
            }
            if(isset($info["message"]["chat"]["username"])){
                $username = $info["message"]["chat"]["username"];
            }
            BotChat::create([
                'bot_id' => $bot->id,
                'name' => $name,
                'nicname' => $username,
                'id_telegram' => $chat_id,
            ]);
        }
    }
    function saveMessage($info, $chat_id, $bot, $messageWhy){
        $chat = BotChat::where([['bot_id', $bot->id],['id_telegram', $chat_id]])->first();
        if($chat){
            if($messageWhy == 'client'){
                return UserChatBot::create([
                    'bot_chat_id' => $chat->id,
                    'messagebot' => null,
                    'message_client' => $info,
                    'close' => 1,
                    'send' => 1,
                ]);
            }else if($messageWhy == 'botgpt'){
                return UserChatBot::create([
                    'bot_chat_id' => $chat->id,
                    'messagebot' => null,
                    'message_client' => $info,
                    'close' => 0,
                    'send' => 0,
                ]);
            }else{
                return UserChatBot::create([
                    'bot_chat_id' => $chat->id,
                    'messagebot' => $info,
                    'message_client' => null,
                    'close' => 1,
                    'send' => 1,
                ]);
            }
        }
    }
}