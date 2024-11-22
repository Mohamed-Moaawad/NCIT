<a class="btn btn-info hide" href="{{route('invoices.show',$id)}}"  target="_blank" data-id="{{$id }}"
   value="" id="show-info"><i class="fa fa-eye"></i></a>

<a href="{{route('pdf',$id)}}" target="_blank"  class="btn btn-primary " >
    <i class="fa fa-file-pdf"></i></a>

<a href="{{route('invoices.edit',$id)}}" id="edit-info" d
                      ata-id="{{$id }}" class="btn btn-primary " >
    <i class="fa fa-edit"></i></a>


        <a	href="#"  value="{{route('invoices.destroy',['invoice' =>$id])}}" data-token="{{ csrf_token() }}"
         data-id="{{$id}}" class="delete-post-link btn btn-danger " ><i class="fa fa-trash"></i></a>


<a href="#" value="{{route('send_pdf',['id' =>$id])}}"   class=" send_pdf btn btn-primary " >
  <i class=" flaticon-email"></i>

    </a>


@if ($reminder_date==null)
    <a href="#" value="{{route('reminder',['id' =>$id])}}" class="reminder-post-link btn btn-danger ">
        {{__('text.reminder')}}

    </a>
    <input type="date" class=" m-input m-input--air m-input--pill rdate"
           name="reminder_date" placeholder="{{__('text.reminder')}} "
           value="{{$reminder_date}}">
@else
    <a href="#" value="{{route('reminder_cancel',['id' =>$id])}}" class="cancel-reminder-post-link btn btn-danger ">
        {{__('text.reminder_cancel_msg')}}

    </a>
    <input type="date" class=" m-input m-input--air m-input--pill rdate"
           name="reminder_date" disabled placeholder="{{__('text.reminder')}} "
           value="{{$reminder_date}}">
@endif
