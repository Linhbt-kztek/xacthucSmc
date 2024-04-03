<?php
namespace App\Http;
use Berkayk\OneSignal\OneSignalClient;

class OneSignalCustom extends OneSignalClient
{
	public function sendNotificationToDevice($message, $userId, $type) {
        $contents = array(
            "en" => $message
        );

        $params = array(
            'app_id' => $this->appId,
            'contents' => $contents
        );
        if($type == 1) {
        	$params['include_player_ids'] = array($userId);
        } else {
        	$params['include_ios_tokens'] = array($userId);
        }
        if (isset($url)) {
            $params['url'] = $url;
        }

        if (isset($data)) {
            $params['data'] = $data;
        }

        if (isset($buttons)) {
            $params['buttons'] = $buttons;
        }

        if(isset($schedule)){
            $params['send_after'] = $schedule;
        }

        $this->sendNotificationCustom($params);
    }
}
