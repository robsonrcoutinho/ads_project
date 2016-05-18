<?php

namespace adsproject\Http\Controllers;

use adsproject\PushNotification;
use Illuminate\Http\Request;

use adsproject\Http\Requests;
use adsproject\Http\Controllers\Controller;

class PushNotificationController extends Controller
{


    public function sendNotificationToDevice(){
        $deviceToken = 'e2JQLols-Zg:APA91bG6tQAX8_yqYBTEyDRII5wRQ5oVmNhNRv8Ee3zVbXvbFAGPJ6qAft8sLK_YTFUHB6FDp35LmdvKwFgBOl_PnwlFaGBHcboo6YAp2qJGBgtk8bhiJnqDS4nFQAvP3IJzDqcZOnL-';

        $message = 'Msg teste dispositivo';

        $collection = PushNotification::adsproject('ADSNotify')
            ->to($deviceToken)
            ->send($message);
    }

}
