<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>فاتورة</title>

    <link href="{{asset('style/css/customInvoice.css?v=302')}}" rel="stylesheet" type="text/css"/>


    <style>

    </style>

</head>
<body dir="rtl">
<header>

    <div class="imgdiv">
        <img class="img_logo" alt="" src="{{asset('img/'.$title->img)}}" style="
                                                      "/>

    </div>


    <div>
        <div class="divblock1 ">
            <table class="meta">


                <tr>
                    <th><span contenteditable> فاتورةرقم/Invoice  #</span></th>
                    <td><span contenteditable>{{$invoice->id}}</span></td>
                </tr>
                <tr>
                    <th><span contenteditable>الحالة/Status:</span></th>
                    <td><span contenteditable> @if($invoice->status==1)
                                مدفوعة
                            @else
                                غير مدفوعة
            @endif
        </div>
        </span></td>
        </tr>
        <tr>
            <th><span contenteditable>  تاريخ/Date:</span></th>
            <td><span contenteditable>{{$invoice->sdate}}</span></td>
        </tr>
        <tr>
            <th><span contenteditable style=""> العميل/Client </span></th>
            <td><span contenteditable style=""> {{$invoice->client->name}}</span></td>
        </tr>


        </table>

    </div>
    <div class="divblock " style="text-align: left">
        <p>
            {{$invoice->user->company_name}} <br>
            @php
                echo nl2br  ($invoice->user->address);
            @endphp


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
            <th><span contenteditable>البند/Item</span></th>
            <th><span contenteditable>Quantity/الكمية</span></th>
            <th><span contenteditable>السعر/Price</span></th>
            <th><span contenteditable>Total/الاجمالي</span></th>
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
                <td><span data-prefix></span><span>{{$item->quantity}}</span></td>
                <td><span data-prefix></span><span>SAR {{$item->cost}} </span></td>
                <td><span data-prefix></span><span>SAR {{$item->total}} </span></td>
            </tr>
            <?php
            $total = $total + $item->total;
            $tax = $tax + $item->tax;
            $total_all = $total_all + ($item->total + $item->tax)
            ?>
        @endforeach
        </tbody>
    </table>

    <table class="balance" style='width: 100%; '>
        <tr>
            <th><span contenteditable>المجموع/Total   </span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{$total }} </span></td>
        </tr>
        <tr>
            <th><span contenteditable>الضريبة المضافة/Vat    </span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{$tax }} </span></td>
        </tr>
        <tr>
            <th><span contenteditable>الإجمالي /Total with Vat</span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{$total_all }}</span></td>
        </tr>
    </table>
</article>
<div style="text-align: center">
    <img style="
   width: 20%;
     margin: 5px;

     display: block;" src="{{$displayQRCodeAsBase64}}" alt="QR Code"/>
</div>

<footer style="display: none">
    <h1>{{$invoice->user->company_name}}  </h1>

</footer>
</body>


</html>
