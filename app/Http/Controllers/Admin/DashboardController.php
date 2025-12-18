<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $selectedMonth = Carbon::now()->month;
        $selectedYear = Carbon::now()->year;

        // =========================
        // DATA GRAFIK (punya lo)
        // =========================
        $startOfMonth = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
        $today = Carbon::today();

        $labels = [];
        $rawLabels = [];
        $dailyCounts = [];

        for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
            $count = DB::table('transaksi_surats')
                ->whereDate('created_at', $date)
                ->count();

            $labels[] = $date->format('j');
            $rawLabels[] = $date->translatedFormat('d F Y');
            $dailyCounts[] = $count;
        }

        $chartData = [
            [
                'label' => 'Jumlah Surat',
                'data' => $dailyCounts
            ]
        ];

        // =========================
        // CARD SUMMARY
        // =========================
        $totalSurat = DB::table('transaksi_surats')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $suratBaru = DB::table('transaksi_surats')
            ->where('status', 'Baru')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $suratAcc = DB::table('transaksi_surats')
            ->where('status', 'Acc')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $suratCancel = DB::table('transaksi_surats')
            ->where('status', 'Cancel')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        return view('admin.dashboard', compact(
            'chartData',
            'labels',
            'rawLabels',
            'selectedMonth',
            'selectedYear',
            'totalSurat',
            'suratBaru',
            'suratAcc',
            'suratCancel'
        ));
    }
}
