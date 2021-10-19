<?php

namespace App\Mail\Internal;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindDueOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->markdown('emails.internal.remindDueOrder', [
            'url' => $this->data['url'],
            'orderNo' => $this->data['orderNo'],
            'deliveryDate' => $this->data['deliveryDate']
        ]);
    }
}
