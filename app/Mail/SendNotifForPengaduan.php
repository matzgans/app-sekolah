<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotifForPengaduan extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $no_tiket,
        public string $tanggal_pengaduan,
        public ?string $status_pengaduan = 'pending'
    ) {}


    public function build()
    {
        return $this->subject('Pengaduan Baru')
            ->view('emails.pengaduan.email-pengaduan')
            ->with([
                'name' => $this->name,
                'no_tiket' => $this->no_tiket,
                'tanggal_pengaduan' => $this->tanggal_pengaduan,
                'status_pengaduan' => $this->status_pengaduan,
            ]);
    }
}
