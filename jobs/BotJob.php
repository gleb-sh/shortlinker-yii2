<?php

namespace app\jobs;

use yii\base\BaseObject;
use app\models\Click;

class BotJob extends BaseObject implements \yii\queue\JobInterface
{
    public $userAgent;
    public $link;

    public function execute($queue)
    {
        $ch = curl_init('http://qnits.net/api/checkUserAgent?userAgent=' . $this->userAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = \json_decode($result,true);

        if (!$result['isBot']) {
            $click = new Click;
            $click->link_id = $this->link;
            $click->click_date = new \yii\db\Expression('NOW()');
            $click->save();
        }
    }
}