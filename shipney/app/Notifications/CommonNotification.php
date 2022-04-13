<?php
/**
 * File name: CommonNotification.php
 * Last modified: 2020.04.29 at 10:35:47
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Notifications;

use Dompdf\Helpers;
use App\Models\User;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommonNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    public $type;
    private $title;
    private $body;
    private $image;
    private $custom_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $type, $title, $body, $image, $id)
    {
        //
        $this->user = $user;
        $this->type = $type;
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
        if(isset($id)){
            $this->custom_id = $id;
        }else{//default
            $this->custom_id = -1;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toFcm($notifiable)
    {

        $message = new FcmMessage();
        $notification = [
            'title' => $this->title,
            'body' => $this->body,
            //'icon' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/shipney%2Flogo%2Fapp_icon2.png?alt=media&token=23efd377-8499-4577-b0cc-7284c13f6693",
            'image' => $this->image,
        ];
        $data = [
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'sound' => 'default',
            'id' => $this->custom_id,
            
            'type' => $this->type,
            'message' => $notification,
        ];
        //Helpers::pre_r($data);
        $message->content($notification)->data($data)->priority(FcmMessage::PRIORITY_HIGH);

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->custom_id,
            'title' => $this->title,
            'body' => $this->body,
            'image' => $this->image,
        ];
    }
}
