<?php

namespace App\Exports;

use App\Models\Multa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MultasExport implements FromView
{
    protected $multas;

    public function __construct($multas)
    {
        $this->multas = $multas;
    }

    public function view(): View
    {
        return view('multas.reportes.export', [
            'multas' => $this->multas
        ]);
    }
}
