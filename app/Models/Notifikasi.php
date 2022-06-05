<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    public $table = "notifikasi";
    use HasFactory;

    protected $guarded=[];

    public static function sendFcm($resep, $title, $user){
        Notifikasi::create([
            'user_id'=>$resep->user_id,
            'resep_id'=>$resep->id,
            'title'=>$title,
        ]);
        $data = array(
            'title'=>$resep->nama_resep,
            'sound' => "default",
            'body'=>$title,
            'color' => "#79bc64"
        );
        $fields = array(
            'to'=>$user->fcm,
            'notification'=>$data,
            "priority" => "high",
        );
        return Notifikasi::sendPushNotification($fields);
    }

    private static function sendPushNotification( $fields ) {

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
           'Authorization: key=AAAAKlhQEgs:APA91bE2Kb9slWp162NwpKn6rjkbY5NbR9F4uZYr8mA_bNxkWvu5QAWIG5Ad1joaWLQiDufOzOHAKaf9GD--h2-IYdeLWYDJ9aZ1j0rnAnMHHwljOI4jnri2Ui7lYI9ZZF3bVbad5SiB',
           'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();
  
        // Set the url, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, $url );
  
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  
        // Disabling SSL Certificate support temporarly
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  
        curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
  
        // Execute post
        $result = curl_exec( $ch );
        if ( $result === false ) {
           die( 'Curl failed: ' . curl_error( $ch ) );
        }
  
        // Close connection
        curl_close( $ch );
  
        return $result;
     }
}
