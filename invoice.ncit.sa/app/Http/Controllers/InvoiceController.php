<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Invoice_item;
use App\Models\Setting;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Response;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;
use PDF;
use PDFNew;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use Alkoumi\LaravelArabicTafqeet\Tafqeet;


class InvoiceController extends Controller
{
    function __construct()
    {
        $this->middleware('checktypeuser');
        $this->middleware('auth');
    }

    ////////////////////////////index/ عرض كل الفواتير   /////////////////////////////
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Invoice::where('user_id', Auth::user()->id)->latest()->get();
            return DataTables::of($data)
                ->addColumn('client', function ($m) {

                    return $m->client->name;

                })
                 ->addColumn('status', function ($m) {
                    if ($m->status == 1) {
                        return 'مدفوعة';
                    } else {
                        return 'غيرمدفوعة';
                    }
                })
                ->addColumn('total', function ($m) {
                    $total_all = 0;
                    foreach ($m->items as $item) {
                        $total_all = $total_all + ($item->total + $item->tax);
                    }

                    return $total_all;

                })
                ->addColumn('action', 'admin.invoices.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
        return view('admin.invoices.invoices', $data);

    }

    //////////////////////////////rep////////////
    public function rep(Request $request)
    {
        if ($request->ajax()) {
            $data = Invoice::where('user_id', Auth::user()->id)->
            with('items')->latest()->get();
            return DataTables::of($data)
                ->addColumn('client', function ($m) {
                    return $m->client->name;
                })
                ->addColumn('status', function ($m) {
                    if ($m->status == 1) {
                        return 'مدفوعة';
                    } else {
                        return 'غيرمدفوعة';
                    }
                })
                ->addColumn('total', function ($m) {
                    $total_all = 0;
                    foreach ($m->items as $item) {
                        $total_all = $total_all + ($item->total + $item->tax);
                    }

                    return $total_all;

                })
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
        return view('admin.invoices.reports', $data);
    }

    public function pdf_Rep($id)
    {
        $data['title'] = Setting::find(1);
        $data['client'] = Client::where('id', $id)->get();
        $data['user'] = User::find(Auth::user()->id);
        $data['invoices'] = Invoice::where('user_id', Auth::user()->id)->where('client_id', $id)->
        with('items')->latest()->get();


        $pdf = PDFNEW::loadView('admin.invoices.pdf_rep', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf_rep');
    }

    ///////////////////////////////////////////////////////////////////////////
    public function pdf_Rep_date($id,$from = null, $to = null )
    {

        $data['title'] = Setting::find(1);
        $data['client'] = Client::where('id', $id)->get();
        $data['user'] = User::find(Auth::user()->id);
        if ($from !=null && $to!=null) {
            $from_date = date('Y-m-d', strtotime($from));
            $to_date = date('Y-m-d', strtotime($to));
            $data['titel_rep'] = ' كشف حساب من '.$from_date.' إلى  '.$to_date;
            $data['invoices'] = Invoice::where('user_id', Auth::user()->id)->where('client_id', $id)->
            whereBetween('sdate', [$from_date, $to_date])->
            with('items')->latest()->get();
        } else {
            $data['titel_rep'] = 'كشف حساب  ';
            $data['invoices'] = Invoice::where('user_id', Auth::user()->id)->where('client_id', $id)->
            with('items')->latest()->get();
        }
        $pdf = PDFNEW::loadView('admin.invoices.pdf_rep', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf_rep');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = Setting::find(1);
        $data['clients'] = Client::where('user_id', Auth::user()->id)->get();
        $data['items'] = Item::where('user_id', Auth::user()->id)->get();
        return view('admin.invoices.addInvoice', $data);
    }
    ////////////////////////////store/ حفظ   /////////////////////////////

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $error = Validator::make($request->all(), [
            'client_id' => 'required',
            'sdate' => 'required',
            'status' => 'required',
            "item.*" => "required",
            "quantity.*" => "required",
            "cost.*" => "required",

        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }
        $tax = Setting::find(1);
        $invoice = new Invoice();
        $invoice->user_id = Auth::user()->id;
        $invoice->client_id = $request->client_id;
        $invoice->sdate = $request->sdate;
        $invoice->status = $request->status;
        $invoice->hash = rand(1111111111, 9999999999);
        $invoice->note = $request->note;
        $c = Invoice::where('user_id', Auth::user()->id)->count();
        $c++;
        // $serial=  'EP'.date("Y")."/".str_pad($c, 4, '0', STR_PAD_LEFT);
        $serial = str_pad($c, 4, '0', STR_PAD_LEFT);
        $invoice->serial = $serial;
        $invoice->save();
        $i = 0;
        foreach ($request->item as $item) {

            $invoice_item = new Invoice_item();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->item_id = $item;
            $invoice_item->quantity = $request->quantity[$i];
            $invoice_item->cost = $request->cost[$i];
            $invoice_item->tax = $tax->tax * ($request->quantity[$i] * $request->cost[$i]);
            $invoice_item->total = $request->quantity[$i] * $request->cost[$i];
            $i = $i + 1;
            $invoice_item->save();


        }
        $request->session()->flash('alert-success', 'تم بنجاح');
        return $invoice->id;

    }
    ////////////////////////////show/ عرض   /////////////////////////////

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = Setting::find(1);
        $data['clients'] = Client::where('user_id', Auth::user()->id)->get();
        $data['invoice'] = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $data['items'] = Item::where('user_id', Auth::user()->id)->get();
        $invoice = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $total = 0;
        $tax = 0;
        foreach ($invoice->items as $item) {

            $total = $total + ($item->total + $item->tax);
            $tax = $item->tax;
        }
        $data['displayQRCodeAsBase64'] = GenerateQrCode::fromArray([
            new Seller(Auth::user()->company_name), // seller name
            new TaxNumber(Auth::user()->registration_no), // seller tax number
            new InvoiceDate($invoice->sdate), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total), // invoice total amount
            new InvoiceTaxAmount($tax) // invoice tax amount
            // TODO :: Support others tags
        ])->render();
        $data['total'] = $total;
        return view('admin.invoices.viewInvoice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['title'] = Setting::find(1);
        $data['clients'] = Client::where('user_id', Auth::user()->id)->get();
        $data['invoice'] = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $data['items'] = Item::where('user_id', Auth::user()->id)->get();
        return view('admin.invoices.updateInvoice', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $error = Validator::make($request->all(), [
            'client_id' => 'required',
            'sdate' => 'required',
            'status' => 'required',
            "item.*" => "required",
            "quantity.*" => "required",
            "cost.*" => "required",
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }
        $tax = Setting::find(1);
        $invoice = Invoice::find($id);
        $invoice->user_id = Auth::user()->id;
        $invoice->client_id = $request->client_id;
        $invoice->sdate = $request->sdate;
        $invoice->status = $request->status;
        $invoice->note = $request->note;
        $invoice->update();
        Invoice_item::where('invoice_id', $id)->delete();
        $i = 0;
        foreach ($request->item as $item) {

            $invoice_item = new Invoice_item();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->item_id = $item;
            $invoice_item->quantity = $request->quantity[$i];
            $invoice_item->cost = $request->cost[$i];
            $invoice_item->tax = $tax->tax * ($request->quantity[$i] * $request->cost[$i]);
            $invoice_item->total = $request->quantity[$i] * $request->cost[$i];
            $i = $i + 1;
            $invoice_item->save();


        }
        $request->session()->flash('alert-success', 'تم بنجاح');
        return $invoice->id;
    }
    ////////////////////////////delete/ حذف   /////////////////////////////

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Invoice::where('id', $id)->where('user_id', Auth::user()->id)->delete();

    }

    public function pdf($id)
    {
        $data['title'] = Setting::find(1);
        $data['clients'] = Client::where('user_id', Auth::user()->id)->get();
        $data['invoice'] = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $data['items'] = Item::where('user_id', Auth::user()->id)->get();
        $invoice = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $total = 0;
        $tax = 0;
        foreach ($invoice->items as $item) {

            $total = ($total) + ($item->total + $item->tax);
            $tax = $tax + $item->tax;
        }
        $data['displayQRCodeAsBase64'] = GenerateQrCode::fromArray([
            new Seller(Auth::user()->company_name), // seller name
            new TaxNumber(Auth::user()->tax_number), // seller tax number
            new InvoiceDate($invoice->sdate), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($total), // invoice total amount
            new InvoiceTaxAmount($tax) // invoice tax amount
            // TODO :: Support others tags
        ])->render();
        $data['total'] = $total;

        if (is_float($total)) {
            //$total= round($total, 2);
            $total = sprintf("%.2f", $total);
            $data['tafqeetInArabic'] = Tafqeet::inArabic($total);
        } else {
            $data['tafqeetInArabic'] = Tafqeet::inArabic($total);
        }
        $pdf = PDFNEW::loadView('admin.invoices.pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf');
    }

    public function send_pdf($id)
    {
        $title = Setting::find(1);
        $invoice = Invoice::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $url = route('send_Email', ['id' => $id, 'hash' => $invoice->hash]);
        $total_all = 0;
        foreach ($invoice->items as $item) {

            $total_all = $total_all + ($item->total + $item->tax);

        }


        $msg = 'Greetings,' . "\n" . 'This email serves as your official invoice from ' . Auth::user()->company_name . "\n" . 'Invoice URL: ' . $url . "\n" . 'Invoice Amount: ' . $total_all . "\n" . 'Due Date: ' . $invoice->sdate . "\n" . 'If you have any questions or need assistance, please don t hesitate to contact us' .
            "\n" . 'Best Regards,' . "\n" . Auth::user()->company_name;


        mail($invoice->client->email, Auth::user()->company_name, $msg);
    }

    public function pdf_all()
    {
        $data['title'] = Setting::find(1);
        $data['invoices'] = Invoice::where('user_id', Auth::user()->id)->get();
        $invoices = Invoice::where('user_id', Auth::user()->id)->get();
        $i = 0;
        foreach ($invoices as $invoice) {
            $i++;
            $total = 0;
            $tax = 0;
            foreach ($invoice->items as $item) {

                $total = $total + ($item->total + $item->tax);
                $tax = $tax + $item->tax;
            }
            $data['displayQRCodeAsBase64' . $i] = GenerateQrCode::fromArray([
                new Seller(Auth::user()->company_name), // seller name
                new TaxNumber(Auth::user()->tax_number), // seller tax number
                new InvoiceDate($invoice->sdate), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                new InvoiceTotalAmount($total), // invoice total amount
                new InvoiceTaxAmount($tax) // invoice tax amount
                // TODO :: Support others tags
            ])->render();
        }
        $pdf = PDFNEW::loadView('admin.invoices.pdf_all', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('invoice.pdf_all');
    }
    
      ///////////////////////// reminder
    public function reminder(Request $request, $id)
    {
        $error = Validator::make($request->all(), [
            'reminder_date' => 'required',
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }
        $invoice = Invoice::find($id);
        $invoice->reminder_date = $request->reminder_date;
        $invoice->update();
    }
       ///////////////////////// reminder_cancel
    public function reminder_cancel(Request $request, $id)
    {

        $invoice = Invoice::find($id);
        $invoice->reminder_date = null;
        $invoice->update();
    }

}
