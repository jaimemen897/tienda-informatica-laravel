<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];

        $pdf = PDF::loadView('factura', $data);

        return $pdf->download('hdtuto.pdf');
    }
}
