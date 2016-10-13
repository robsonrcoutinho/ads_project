<?php

namespace adsproject\Http\Controllers;

use adsproject\Http\Requests;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class PushNotificationController extends Controller
{


    public function sendNotificationToDevice(){
        $deviceToken = 'cgeEZE46t0o:APA91bEDG0oKx7He7fsuI0kjdP65EJDswjoOtQd0M9ESixDaSHn0aSkgPqRi0TvRP18HGquTnxy7aQY0txvYDcH3PYJ-cNkKaOomEnA574KNgn-4k2E6WOx7tsENC3VRZHPvfa-f3hfV';
        PushNotification::app('ads')
            ->to($deviceToken)
            ->send('Test push');
        return 'ok';
    }

}
