<?php

namespace adsproject\Http\Controllers;

use adsproject\PushNotification;
use Illuminate\Http\Request;

use adsproject\Http\Requests;
use adsproject\Http\Controllers\Controller;

class PushNotificationController extends Controller
{


    public function sendNotificationToDevice(){
        $deviceToken = 'c8glrE5hu1A:APA91bFEkTMvWCDb5Nx61Mb0GzFnOJVR09CrjAA3ajy1M2eNwetkndkF5f0_kO3DJQR-FDFVpKNLB1y_IrC9ewQdvsB9bz3HSJzyuAdS2JTDShw4i1jthnaa7yprlFMObQT_0ZLU1S1j';

        $message = 'Msg teste dispositivo';

        $collection = PushNotification::adsproject('ADSNotify')
            ->to($deviceToken)
            ->send($message);
    }

}
