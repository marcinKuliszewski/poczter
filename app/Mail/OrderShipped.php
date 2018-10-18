<?php namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable 
{
    use Queueable, SerializesModels;
/** * The order instance. * * @var Order */ 

public $order;
public function __construct(Order $order) 
    { 
    $this->order = $order;
    }
/** * Build the message. * * @return $this */
    
public function build() 
      {
    return $this->view('emails.orders.shipped'); 
    
      }
    
    
    
   } 