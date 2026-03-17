<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $planName;
    public $expiryDate;
    public $daysLeft;
    public $isArtist;

    /**
     * @param string $userName
     * @param string $planName
     * @param string $expiryDate  Formatted date string e.g. "March 20, 2026"
     * @param int    $daysLeft    e.g. 3
     * @param bool   $isArtist    Whether the subscriber is an artist
     */
    public function __construct(string $userName, string $planName, string $expiryDate, int $daysLeft, bool $isArtist = false)
    {
        $this->userName   = $userName;
        $this->planName   = $planName;
        $this->expiryDate = $expiryDate;
        $this->daysLeft   = $daysLeft;
        $this->isArtist   = $isArtist;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "⚠️ Your {$this->planName} plan expires in {$this->daysLeft} day(s) – SingWithMe",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription-expiry',
        );
    }
}
