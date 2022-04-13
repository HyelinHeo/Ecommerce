<?php
/**
 * File name: StatusChangedOrder.php
 * Last modified: 2020.04.29 at 10:35:47
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Notifications;

use Dompdf\Helpers;
use App\Models\Order;
use Benwilkins\FCM\FcmMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class StatusChangedOrder extends Notification
{
    use Queueable;
    /**
     * @var Order
     */
    private $order;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    //public function __construct(Order $order, $type)
    public function __construct(Order $order, $type)
    {
        //
        $this->order = $order;
        $this->type = config('app.notification.NOTIFICATION_TYPE_ORDER_STATE'); //$type;
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
        $shipney_item_count = "";

        if($this->order->item_count > 1) {
            $shipney_item_count = "+".$this->order->item_count;
        }


        $message = new FcmMessage();
        $notification = [
            'title' => trans('lang.notification_your_order', [], "ko"),
            //'title' => trans('lang.notification_your_order', ['order_id' => $this->order->id, 'order_status' => $this->order->orderStatus->status], "ko"),
            'body' => "(".$this->order->nation_code.")".$this->order->receiver_name." [".$this->order->item_main_name."] #".$this->order->orderno,
            //'icon' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/shipney%2Flogo%2Fnotification_icon.png?alt=media&token=3c9befcb-6a08-4bda-b066-402c595c2386",
            //'image' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/shipney%2Flogo%2Fnotification_image.png?alt=media&token=9b605cdc-d86d-4f8b-b8aa-520ba3e271d4",
            //'icon' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/shipney%2Flogo%2Fnotification_icon.png?alt=media&token=a8aa814e-5d75-4a33-9e38-e457d4c61079",
            //'image' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/shipney%2Flogo%2Fthumb_notification_image.png?alt=media&token=notification_image.png",
            //'image' => "https://firebasestorage.googleapis.com/v0/b/shipney-mobile.appspot.com/o/user_item%2F20210830%2FSPCDF1630291110584%2Fthumb_1630291114939?alt=media&token=1630291114939",
            //'text' => "test",
            //'status' => 'done',
            /*
            'image' => $this->order->productOrders[0]->product->market->getFirstMediaUrl('image', 'thumb')  // shipney image
            */
        ];
        $data = [
            'click_action' => "FLUTTER_NOTIFICATION_CLICK",
            'sound' => 'default',
            //'type' => $this->type,
            'message' => $notification,
            'id' => $this->order->id,
            'updated_at' => $this->order->updated_at,
            //'order_no' => $this->order->orderno,
            //'order_status' => $this->order->order_status_id,
            //'nation_code' => $this->order->nation_code,
            //'receiver_name' => $this->order->receiver_name,
            //'address' => $this->order->address1.$this->order->address2.$this->order->address3.$this->order->address4,
            //'item_main_name' => $this->order->item_main_name,
            //'item_main_category' => $this->order->item_main_category,
            //'item_count' => $this->order->item_count,
            //'photo' => $this->order->photo1,
        ];
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
            'id' => $this->order->id,
            'title' => "",
            'body' => "(".$this->order->nation_code.")".$this->order->receiver_name." [".$this->order->item_main_name."] #".$this->order->orderno,
            'image' => "",
        ];
    }
}
