<?php

namespace App\View\Composers;

use App\Models\TransaksiSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotifikasiSuratComposer
{
    public function compose(View $view)
    {
        if (!Auth::check()) {
            $view->with([
                'notifikasiSurat' => collect(),
                'jumlahNotif' => 0,
            ]);
            return;
        }

        $notifikasiSurat = TransaksiSurat::where('status', 'Baru')
            ->whereHas('template.pimpinan', function ($q) {
                $q->where('user_id', Auth::id());
            })
            ->with('template')
            ->latest()
            ->get();

        $view->with([
            'notifikasiSurat' => $notifikasiSurat,
            'jumlahNotif' => $notifikasiSurat->count(),
        ]);
    }
}
