<?php

namespace App\Console\Commands;

use App\Models\Bot\UserChatBot;
use App\Customs\Gpt;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GptMessageCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GptMessage:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $res = UserChatBot::where('close','0')->take(30)->get();
        if($res->count() > 0){
            foreach($res as $item){
                $env = new Gpt();
                $result = $env->aibot($item->message_client);
                if($result != 0){
                    $bot = $item->botChat->bot;
                    $telegram = new Api($bot->token);
                    if($result == 'Закончились'){
                        $telegram->sendMessage([
                            'chat_id' => '555530711',
                            'text' => 'Закончились ключи GPT',
                        ]);
                    }else{
                        try {
                            $sendtext = $result;
                            if(strlen($result) > 4000){
                                $sendtext = Str::limit($result, 3000);
                            }
                            $response = $telegram->sendMessage([
                                'chat_id' => $item->botChat->id_telegram,
                                'text' => $sendtext,
                            ]);

                            
                        } catch (TelegramResponseException $e) {
                            $response = "Заблокирован";
                        }
                        if($response == "Заблокирован"){
                            UserChatBot::create([
                                'bot_chat_id' => $item->bot_chat_id,
                                'messagebot' => 'Пользователь заблокировал бота',
                                'message_client' => null,
                                'close' => 1,
                                'send' => 1,
                            ]);
                        }else{
                            $message = UserChatBot::create([
                                'bot_chat_id' => $item->bot_chat_id,
                                'messagebot' => $result,
                                'message_client' => null,
                                'close' => 1,
                                'send' => 1,
                            ]);
                            if(strlen($result) > 4000){
                                $response = $telegram->sendMessage([
                                    'chat_id' => $item->botChat->id_telegram,
                                    'text' => 'Вам пришел не полный ответ, так как у телеграм есть лимиты на 1 сообщение, полный ответ вы модете посмотреть тут -> https://my-all.ru/info/'.$message->id.'?key='.$item->botChat->id_telegram,
                                ]);
                            }
                        }
                        $item->close = 1;
                        $item->send = 1;
                        $item->save();
                    }
                }
            }
        }
    }
}
