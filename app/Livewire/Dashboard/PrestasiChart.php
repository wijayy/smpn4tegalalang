<?php

namespace App\Livewire\Dashboard;

use App\Models\PrestasiSiswa;
use Livewire\Component;

class PrestasiChart extends Component
{
    public $months = [];
    public $totals = [];

    public function mount()
    {
        // Ambil data 6 bulan terakhir
        $data = PrestasiSiswa::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format data untuk chart
        $months = [];
        $totals = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $label = $month->format('M');
            $months[] = $label;

            $total = $data->firstWhere('month', $month->month)->total ?? 0;
            $totals[] = $total;
        }

        $this->months = $months;
        $this->totals = $totals;

        // dd($this->months, $this->totals);
    }

    public function render()
    {
        return view('livewire.dashboard.prestasi-chart');
    }
}
