@extends('admin.layout.app')
@section('title', __('text.add_invoice'))
@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"> {{__('text.add_invoice')}}</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">{{__('text.home')}}</span>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text"> {{__('text.add_invoice')}} </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div>

            </div>
        </div>
    </div>

    <!-- END: Subheader -->
    <div class="m-content">

        <!--begin::Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{__('text.add_invoice')}}
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            <form class="m-form m-form--fit m-form--label-align-right" method="post" id="m_form_1"
                enctype="multipart/form-data" action="{{route('invoices.store')}}" role="form">
                <div class="m-form__content">
                    <br>
                    <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                        <div class="m-alert__icon">
                            <i class="la la-warning"></i>
                        </div>
                        <div class="m-alert__text">
                            {{__('text.alert__text')}}
                        </div>
                        <div class="m-alert__close">
                            <button type="button" class="close" data-close="alert" aria-label="Close">
                                <i class="la la-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @csrf
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </p>

                    @endif
                    @endforeach
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">

                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="m-portlet__body">


                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12"> {{__('text.client')}}

                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <select class="form-control m-input m-input--air m-input--pill client_id" id="client_id"
                                name='client_id' style="height: 50px;" data-show-subtext="true" data-live-search="true"
                                required="">
                                <option value="-1"> {{__('text.select')}}</option>
                                @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>


                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12"> {{__('text.sdate')}}
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <input type="datetime-local" class="form-control m-input m-input--air m-input--pill"
                                name="sdate" placeholder="{{__('text.sdate')}} " required="">
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12"> {{__('text.status')}}
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <select class="form-control  status" id="status" name='status' style="height: 50px;"
                                data-show-subtext="true" data-live-search="true" required="">
                                <option value="1">مدفوع</option>
                                <option value="2">غير مدفوع </option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-form-label col-lg-3 col-sm-12"> {{__('text.note')}}
                        </label>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <textarea class="form-control m-input m-input--air m-input--pill note" rows="7" name="note"
                                placeholder=" {{__('text.note')}}  "></textarea>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center" style="width: 50%">
                                                {{__('text.item')}}
                                            </th>
                                            <th class="text-center">
                                                {{__('text.quantity')}}
                                            </th>
                                            <th class="text-center">
                                                {{__('text.cost')}}
                                            </th>
                                            <th class="text-center">
                                                {{__('text.total')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>
                                                1
                                            </td>
                                            <td>

                                                <select class="form-control  item" id="item" name='item[]'
                                                    style="height: 50px;" data-show-subtext="true"
                                                    data-live-search="true" required="" onchange="getTotal(this)">
                                                    <option value="-1"> {{__('text.select')}}</option>
                                                    @foreach ($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name='quantity[]'
                                                    placeholder="{{__('text.quantity')}}" class="form-control"
                                                    onchange="getTotal(this)" required />
                                            </td>
                                            <td>
                                                <input type="number" name='cost[]' placeholder="{{__('text.cost')}}"
                                                    class="form-control" onchange="getTotal(this)" required />
                                            </td>
                                            <td>
                                                <input type="number" disabled name='total[]'
                                                    placeholder="{{__('text.total')}}" class="form-control" required />
                                            </td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                                <div class="form-group" style="float: left">
                                    <label for="job_ref"> المجموع</label>
                                    <input type="text" id="sub_total" style="width: 180px"
                                        class="form-control sub_total" name="sub_total" placeholder="0" value="0"
                                        readonly />
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" style="float: left">
                                    <label for="job_ref"> الضريبة</label>
                                    <input type="text" id="sub_tax" style="width: 180px" class="form-control sub_tax"
                                        name="sub_tax" placeholder="0" value="0" readonly />
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group" style="float: left">
                                    <label for="job_ref"> الإجمالي مع الضريبة</label>
                                    <input type="text" id="sub-total_all" style="width: 180px"
                                        class="form-control total_all" name="sub-total_all" placeholder="0" value="0"
                                        readonly />
                                </div>
                            </div>
                        </div>
                        <a id="add_row" class="btn btn-default pull-left">{{__('text.add')}} </a><a id='delete_row'
                            class="pull-right btn btn-default">
                            {{__('text.de')}}</a>
                    </div>
                    <br>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit ">
                    <div class="m-form__actions m-form__actions">
                        <div class="row">
                            <div class="col-lg-9 ml-lg-auto">
                                <button type="submit" class="btn btn-warning"> {{__('text.add')}}</button>
                                <button type="reset" class="btn btn-secondary"> {{__('text.cancel')}}</button>
                                <div id="loading" style="display: none">
                                    <p><img src="{{asset('img/ajax-loader.gif')}}" /></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->
    </div>
</div>


@endsection
@section('js')


<script>
    function calcSub() {

            var totalPrice = 0;
            var tax = 0;
            var total_all = 0;
            $("input[name='total[]']").each(function () {
                totalPrice += parseInt($(this).val());
                tax=totalPrice*{{$title->tax}};
                total_all=totalPrice+tax
                $(".sub_total").val(totalPrice);
                $(".sub_tax").val( tax);
                $(".total_all").val(total_all);
            })
        }
        $.validator.messages.required = '{{__('text.required')}}';
        $(document).ready(function () {
            $("#add_row").click(function () {
                var i = 1;
                $('#addr' + i).html("<td>" + (i + 1) + `</td><td><select class="form-control item" name='item[]' style='height: 50px;' data-show-subtext='true' data-live-search='true' required=''>
                    @foreach ($items as $item)
                    <option value='{{$item->id}}'>{{$item->name}}</option>
                    @endforeach
                    </select></td><td><input  name="quantity[]"
                        type='text' placeholder="{{__('text.quantity')}}" onchange='getTotal(this)' required class='form-control input-md'></td><td><input name='cost[]' type='text' placeholder="{{__('text.cost')}}" onchange='getTotal(this)' required class='form-control input-md'></td><td><input name='total[]' type='text' placeholder="{{__('text.total')}}" disabled class='form-control input-md'></td>`
                );
            });

            $("#delete_row").click(function () {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calcSub();

            });

        });

        $('.client_id').select2();
        $('.item').select2();

        function getTotal(el) {

            var value1 = $(el).closest("tr").find("input[name='quantity[]']").val();
            var value2 =    $(el).closest("tr").find("input[name='cost[]']").val();
            var sum = parseFloat(value1) * parseFloat(value2);
            $(el).closest("tr").find("input[name='total[]']").val(sum.toFixed(2));
            calcSub();
        }
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");
        $('#m_form_1').validate({

            rules: {
                client_id: {
                    valueNotEquals: '-1',


                },
                "item[]": {
                    valueNotEquals: '-1',
                },
                "cost[]": {
                    required: true,
                    number: true
                },
                "total[]": {
                    required: true,
                    number: true
                }




            },
            messages: {// custom messages for radio buttons and checkboxes
               client_id: {
                    valueNotEquals: '{{__('text.select')}}',


                },
                "item[]": {
                    valueNotEquals: '{{__('text.select')}}',


                },
                "cost[]": {

                    number: "{{__('text.number_msg')}}"

                },
                "quantity[]": {

                    number: "{{__('text.number_msg')}}"

                },



            },
            invalidHandler: function (e, r) {
                $("#m_form_1_msg").removeClass("m--hide").show(), mUtil.scrollTop()
            },
            submitHandler: function (form) {

                var _token = $("input[name='_token']").val();
                var client_id = $(".client_id").val();
                var item = $.map($('.item'), function (e) {
                    return $('option:selected', e).val();
                });
                var quantity = $('input[name="quantity[]"]').map(function () {
                    return this.value;
                }).get();
                var cost = $('input[name="cost[]"]').map(function () {
                    return this.value;
                }).get();
                var sdate = $("input[name='sdate']").val();
                var note = $('.note').val();
                var status = $(".status").val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('invoices.store')}}",
                    type: 'post',
                    data: {
                        _token: _token,
                        client_id: client_id,
                        item: item,
                        sdate: sdate,
                        cost: cost,
                        status: status,
                        note: note,
                        quantity: quantity,
                    },
                    beforeSend: function () {
                        $('#loading').show();
                    },
                    success: function (data) {

                        $('#loading').hide();
                        toastr.info("{{__('text.add_ajax')}}");
                        $('#m_form_1')[0].reset();
                         window.location.href = "{{route('invoices.index')}}";

                    },
                    error: function (data) {
                        $('#loading').hide();
                        console.log(data);
                        var dt = '';
                        $.each(data.responseJSON.errors, function (key, value) {
                            dt = dt + '<li>' + value + '</li>';
                        });
                        toastr.error(dt);
                    }
                });
             //   form.submit();

            }

        });


</script>
@endsection
