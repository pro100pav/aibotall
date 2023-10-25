<?php

namespace App\Console\Commands;

use App\Models\Bot\UserChatBot;
use App\Customs\Gpt;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Illuminate\Console\Command;
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

        $res = UserChatBot::where('close','0')->first();
        if($res){
            $env = new Gpt();
            $result = $env->aibot($res->message_client);
            if($result != 0){
                
                $bot = $res->botChat->bot;
                $telegram = new Api($bot->token);

                if($result == 'Закончились'){
                    $telegram->sendMessage([
                        'chat_id' => '555530711',
                        'text' => 'Закончились ключи GPT',
                    ]);
                }else{
                    try {
                        $response = $telegram->sendMessage([
                            'chat_id' => $res->botChat->id_telegram,
                            'text' => $result,
                        ]);
                    } catch (TelegramResponseException $e) {
                        $response = "Заблокирован";
                    }
                    if($response == "Заблокирован"){
                        UserChatBot::create([
                            'bot_chat_id' => $res->bot_chat_id,
                            'messagebot' => 'Пользователь заблокировал бота',
                            'message_client' => null,
                            'close' => 1,
                            'send' => 1,
                        ]);
                    }else{
                        UserChatBot::create([
                            'bot_chat_id' => $res->bot_chat_id,
                            'messagebot' => $result,
                            'message_client' => null,
                            'close' => 1,
                            'send' => 1,
                        ]);
                    }
                    $res->close = 1;
                    $res->send = 1;
                    $res->save();
                }
                
                
            }
        }
    }
}
