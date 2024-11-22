<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>كشف حساب عميل</title>

    <link href="{{asset('style/css/customInvoice.css?v=599')}}" rel="stylesheet" type="text/css"/>


<style>
    @page {
        footer: page-footer;
    }
</style>

</head>
<body dir="rtl">

<header>
    <div style="margin-bottom: 20px;margin-top: 3px">
    <div class="divblock1 " style="width: 47%">
        <img class="img_logo" alt="" src="{{asset('img/'.$user->company_img)}}" style="
                                                  "/>
        <br>
        <p>
        {{$user->company_name}} <br>
        @php

            echo nl2br  ($user->address);
        @endphp
        <br>
        الرقم الضريبي:{{$user->tax_number}}
        </p>
    </div>
        <h4 style="margin-top: 120px"> {{$titel_rep}}</h4>
           <div class="divblock"  style="text-align: left">

    <p style="font-size: 15px;font-weight: bold">العميل</p>
        <p>
            {{$client[0]->name}} <br>


    @php

        echo nl2br  ($client[0]->address);
    @endphp <br>
                  {{ $client[0]->email}}<br>
                  {{   $client[0]->mobile}}<br>



        </p>
    </div>

    </div>

    </div>
</header>
<article>

    <h2 style="margin-top:20px">الفواتير</h2>
    <table>
        <thead>
        <tr>
            <th>فاتورة رقم</th>
            <th>التاريخ</th>
             <th  style="width:125px">الحالة</th>
           <th>الاجمالي</th>

        </tr>
        </thead>
        <tbody>
               <?php
                         $total_sum = 0;?>
        @foreach($invoices as $invoice)
            <tr>
                <td>#{{$invoice->serial}} </td>
                <td>{{$invoice->sdate}}</td>
                 <td>

                       @if($invoice->status==1)
                       مدفوعة
                       @else
                       غير مدفوعة
                       @endif
                   </td>
                   <td>
                       <?php
                         $total_all = 0;
                    foreach($invoice->items as $item){
                     $total_all = $total_all + ($item->total + $item->tax);
                    }
                           $total_sum=$total_sum+$total_all;
                       ?>
                      SAR {{number_format($total_all,2) }}
                      </td>

            </tr>
         @endforeach
        </tbody>
    </table>

     <div class="divblock3 " style="text-align: left ;width: 100%;">

    <table class="balance" style='width: 100%; '>
        <tr>
           <th  style="width:34%;"><span contenteditable> المجموع  </span></th>
            <td style="font-weight: bold"><span data-prefix></span><span>SAR {{number_format($total_sum,2) }}
            </span></td>
        </tr>


    </table>
    </div>
</article>


<htmlpagefooter name="page-footer" >
    <div style="text-align: left">{PAGENO}</div>
</htmlpagefooter>

</body>


</html>
