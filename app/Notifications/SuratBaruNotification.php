<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;

class SuratBaruNotification extends Notification
{
    use Queueable;

    public $surat;

    public function __construct($surat)
    {
        $this->surat = $surat;
    }

    public function via($notifiable)
    {
        return ['database']; // simpan di tabel notifications
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Surat baru telah dibuat oleh ' . Auth::user()->name,
            'surat_id' => $this->surat->id,
            'perihal' => $this->surat->perihal ?? '-', // supaya aman kalau ga ada field perihal
            'created_by' => Auth::id(),
        ];
    }
}
