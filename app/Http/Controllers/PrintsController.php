<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class PrintsController extends Controller
{
    public function print_customer_info()
    {
        $data = Customer::all();

        $filename = 'customer_log.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'margein-left' => 10,
            'margin-right' => 10,
            'margin-top' => 15,
            'margin-bottom' => 20,
            'margin-header' => 10,
            'margin-footer' =>10,
            //'mode' => 'utf-8', 'format' => 'A4-L'
        ]);

        // $html = \View::make('prints.customer_info')->with('customers', $data);
        $html = View::make('prints.customer_info')->with('customers', $data)->render();
        // $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($filename,"I");

    }
}
