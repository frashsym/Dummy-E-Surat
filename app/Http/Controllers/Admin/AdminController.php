<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');

        $selectedMonth = Carbon::now()->month;
        $selectedYear  = Carbon::now()->year;

        $startOfMonth = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->startOfMonth();
        $today        = Carbon::today();

        $labels = [];
        $rawLabels = [];
        $dailyCounts = [];

        for ($date = $startOfMonth->copy(); $date->lte($today); $date->addDay()) {
            $count = DB::table('transaksi_surats')
                ->whereDate('created_at', $date)
                ->count();

            $labels[] = $date->format('j'); // 1,2,3...
            $rawLabels[] = $date->translatedFormat('d F Y');
            $dailyCounts[] = $count;
        }

        $chartData = [
            [
                'label' => 'Jumlah Surat',
                'data' => $dailyCounts
            ]
        ];

        return view('admin.admin', compact(
            'chartData',
            'labels',
            'rawLabels',
            'selectedMonth',
            'selectedYear'
        ));
    }
}
