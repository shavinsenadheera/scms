<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderProcess extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->markdown('emails.customer.orderprocess')
                    ->subject('Order (#'.$this->details['order_no'].') alert')
                    ->with($this->details);
    }
}
