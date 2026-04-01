<?php

namespace App\Mail;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FacturePrete extends Mailable
{
    use Queueable, SerializesModels;

    public Commande $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre commande #' . $this->commande->id . ' est prête !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.facture_prete',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('facture.pdf', ['commande' => $this->commande]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(
                fn () => $pdf->output(),
                'facture_commande_' . $this->commande->id . '.pdf'
            )->withMime('application/pdf'),
        ];
    }
}
