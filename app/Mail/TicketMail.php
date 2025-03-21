<?php

namespace App\Mail;

use App\Models\Evenement;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $evenement;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Ticket $ticket
     * @param Evenement $evenement
     * @param User $user
     */
    public function __construct(Ticket $ticket, Evenement $evenement, User $user)
    {
        $this->ticket = $ticket;
        $this->evenement = $evenement;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre Ticket pour l\'Événement')
                    ->view('emails.ticket');
    }
}
