<?php

namespace App\Mail\NewCustomer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCustomerStatusAlert extends Mailable{
    use Queueable, SerializesModels;
    public $details;
    public function __construct($details){
        $this->details = $details;
    }
    public function build(){
        return $this->markdown('emails.customer.NewCustomerStatusAlert')->with($this->details);
    }
}
