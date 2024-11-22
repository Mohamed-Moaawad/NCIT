<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Setting;
use App\Models\Item;
use DataTables;
use Response;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;
use Alkoumi\LaravelArabicTafqeet\Tafqeet;
use PDF;
use PDFNew;
use Validator;
use Auth;


class EmailController extends Controller
{


    public function pdf($id,$hash){
        $data['title'] = Setting::find(1);
        $data['invoice'] = Invoice::where('id',$id)->first();
        $invoice=Invoice::where('id',$id)->where('hash',$hash)->first();
        $total=0;
        $tax=0;
        foreach($invoice->items as $item) {

            $total = $total + ($item->total + $item->tax);
            $tax=$tax+$item->tax;
        }
        $data['displayQRCodeAsBase64']= GenerateQrCode::fromArray([
            new Seller( $data['invoice']->user->company_name), // seller name
            new TaxNumber($data['invoice']->user->tax_number), // seller tax number
            new InvoiceDate($invoice->sdate), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total), // invoice total amount
            new InvoiceTaxAmount($tax) // invoice tax amount
            // TODO :: Support others tags
        ])->render();
        $data['total']=$total;
         if (is_float($total)){
         //  $total= round($total, 2);
            $total= sprintf("%.2f", $total);
            $data['tafqeetInArabic'] = Tafqeet::inArabic($total);
        }
        else{
            $data['tafqeetInArabic'] = Tafqeet::inArabic($total);
        }
        $pdf = PDFNEW::loadView('admin.invoices.pdf', $data);
        return $pdf->stream('invoice.pdf');
    }


}
