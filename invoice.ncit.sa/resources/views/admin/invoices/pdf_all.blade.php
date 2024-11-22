<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>فواتير</title>

    <link href="{{asset('style/css/customInvoice.css?v=199')}}" rel="stylesheet" type="text/css"/>


    <style>
        @page {
            footer: page-footer;
        }
    </style>

</head>
<body dir="rtl">
@php
$i=0;
@endphp
@foreach($invoices as $invoice)
    <?php $total = 0;
    $tax = 0;
    $total_all = 0;
    $i++;
    ?>
    @foreach($invoice->items as $item)
        <?php
        $total = $total + $item->total;
        $tax = $tax + $item->tax;
        $total_all = $total_all + ($item->total + $item->tax)
        ?>
    @endforeach
<header>
    <div style="margin-bottom: 20px;margin-top: 3px">
    <div class="divblock1 " style="">
        <img class="img_logo" alt="" src="{{asset('img/'.$invoice->user->company_img)}}" style="
                                                      "/>
        <br>
        <p>
        {{$invoice->user->company_name}} <br>
        @php

            echo nl2br  ($invoice->user->address);
        @endphp
        <br>
        الرقم الضريبي:{{$invoice->user->tax_number}}
        </p>
    </div>
        <div class="divblock " style="text-align: left">
            <p style="font-size: 15px;font-weight: bold;padding-top: 95px">Invoice # {{$invoice->serial}} </p>
        </div>
    </div>

    <div style="margin-bottom: 20px;margin-top: 5px">
        <div class="divblock1 ">
            <table class="meta">

                <tr>
                    <th><span contenteditable> فاتورة رقم /# Invoice   </span></th>
                    <td><span contenteditable>{{$invoice->serial}}</span></td>
                </tr>
                <tr>
                    <th><span contenteditable>الحالة / Status:</span></th>
                    <td><span contenteditable> @if($invoice->status==1)
                                مدفوعة
                            @else
                                غير مدفوعة
            @endif
        </div>
        </span></td>
        </tr>
        <tr>
            <th><span contenteditable>  التاريخ / Date:</span></th>
            <td><span contenteditable>{{$invoice->sdate}}</span></td>
        </tr>

        <tr>
            <th><span contenteditable>  الاجمالي / Total:</span></th>
            <td><span contenteditable>SAR {{number_format($total)}}</span></td>
        </tr>
        </table>

    </div>
    <div class="divblock " style="text-align: left">
        <p style="font-size: 15px;font-weight: bold">Invoiced to </p>
        <p>
            {{$invoice->client->name}} <br>

              {{ $invoice->client->address}}<br>

    @php

        echo nl2br  ($invoice->client->address);
    @endphp
    <br>
                  {{   $invoice->client->mobile}}<br>



        </p>
    </div>


    </div>


    </div>

    </div>
</header>
<article>


    <table>
        <thead>
        <tr>
            <th><span contenteditable>البند / Item</span></th>
            <th><span contenteditable>الكمية / Quantity</span></th>
            <th><span contenteditable> السعر / Price</span></th>
            <th><span contenteditable>  الإجمالي / Total  </span></th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0;
        $tax = 0;
        $total_all = 0;
        ?>
        @foreach($invoice->items as $item)
            <tr>
                <td><a class=""></a><span contenteditable>{{$item->item->name}}</span></td>
                <td><span data-prefix></span><span>{{number_format($item->quantity,2)}}</span></td>
                <td style="width:120px"><span data-prefix></span><span>SAR {{number_format($item->cost,2)}} </span></td>
                <td style="width:120px"><span data-prefix></span><span>SAR {{number_format($item->total,2)}} </span></td>
            </tr>
            <?php
            $total = $total + $item->total;
            $tax = $tax + $item->tax;
            $total_all = $total_all + ($item->total + $item->tax)
            ?>
        @endforeach
        </tbody>
    </table>
    <div class="divblock3 " style="text-align: left">
    <table class="balance" style='width: 100%; '>
        <tr>
            <th><span contenteditable>المجموع / Total  </span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{number_format($total,2) }} </span></td>
        </tr>
        <tr>
            <th><span contenteditable>الضريبة المضافة / Vat
            15%</span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{number_format($tax,2) }} </span></td>
        </tr>
        <tr>
            <th><span contenteditable>الإجمالي / Total with Vat</span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{number_format($total_all,2)}}</span></td>
        </tr>
    </table>
    </div>
</article>
<div style="margin-top: 10px;margin-bottom: 2px">

    @php

        echo nl2br  ($invoice->note);
    @endphp

</div>
    <div style="text-align: center">
        <img style="
   width: 20%;
     margin: 5px;

     display: block;" src="@php echo ${'displayQRCodeAsBase64'.$i}; @endphp" alt="QR Code"/>
    </div>
    @if(!$loop->last)
        <div class="page_break"></div>
    @endif

@endforeach

<htmlpagefooter name="page-footer" >
   <div style="text-align: left">{PAGENO}</div>
</htmlpagefooter>
</body>


</html>
