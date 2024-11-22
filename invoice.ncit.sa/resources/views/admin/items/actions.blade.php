<a class="btn btn-info" href="javascript:void(0)"  data-id="{{$id }}"
   value="{{route('items.show',$id)}}" id="show-info"><i class="fa fa-eye"></i></a>


<a href="javascript:void(0)" id="edit-info" d
                      ata-id="{{$id }}" class="btn btn-primary "  value="{{route('items.edit',$id)}}">
    <i class="fa fa-edit"></i></a>


        <a	href="#"  value="{{route('items.destroy',['item' =>$id])}}" data-token="{{ csrf_token() }}"
         data-id="{{$id}}" class="delete-post-link btn btn-danger " ><i class="fa fa-trash"></i></a>




