<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use PhpMqtt\Client\MqttClient;
use Illuminate\Console\Command;
use PhpMqtt\Client\ConnectionSettings;

class MQTTListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen mqtt server & broadcast to ui web';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('MQTT Client listener');
        
        $servers = Server::where('type', 'MQTT')->where('active', true)->get();

        foreach($servers as $server) {
            $mqtt = $this->connection($server);
            $mqtt->subscribe();
            $mqtt->loop(true);
        }
    }

    public function connection($row)
    {
        $server = $row->host;
        $port   = $row->port;
        $clientId = Str::random(10);
        $mqtt_version = MqttClient::MQTT_3_1_1;
        $clean_session = false;

        $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

        $connectionSettings = (new ConnectionSettings)
            ->setUsername($row->username)
            ->setPassword($row->password)
            ->setKeepAliveInterval(60);

        $mqtt->connect($connectionSettings, $clean_session);

        return $mqtt;
    }
}
