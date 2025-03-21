<?php

namespace App\Mail;

use App\Models\Evenement;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $evenement;
    public $nom;
    public $prenom;
    public $ticket; // Déclarez la propriété ticket

    /**
     * Créer une nouvelle instance de message.
     *
     * @param Evenement $evenement
     * @param string $nom
     * @param string $prenom
     * @param string $ticket
     * @return void
     */
    // Dans votre classe TicketMail :
public function __construct(Ticket $ticket, Evenement $evenement)
{
    $this->ticket = $ticket;
    $this->evenement = $evenement;
}

// Dans la méthode build :
public function build()
{
    return $this->subject('Votre ticket pour l\'événement')
                ->view('emails.ticket')
                ->with([
                    'ticket' => $this->ticket,
                    'evenement' => $this->evenement,
                ]);
}

}
