<a class="btn btn-info" href="javascript:void(0)"  data-id="{{$id }}"
   value="{{route('clients.show',$id)}}" id="show-info"><i class="fa fa-eye"></i></a>


<a href="javascript:void(0)" id="edit-info" d
                      ata-id="{{$id }}" class="btn btn-primary "  value="{{route('clients.edit',$id)}}">
    <i class="fa fa-edit"></i></a>

<a href="{{route('pdf_Rep',$id)}}"  class="btn btn-primary hide " target='_blank'>
   كشف حساب</a>

<a href="#"  class="rep  btn btn-primary " value="{{url('pdf_Rep_date'.'/'.$id)}}"  data-id="{{$id}}" >
    كشف حساب</a>

        <a	href="#"  value="{{route('clients.destroy',['client' =>$id])}}" data-token="{{ csrf_token() }}"
         data-id="{{$id}}" class="delete-post-link btn btn-danger " ><i class="fa fa-trash"></i></a>




