<a class="btn btn-info" href="{{route('roles.show',$id)}}"  data-id="{{$id }}"
   value="{{route('roles.show',$id)}}" id="show-info"><i class="fa fa-eye"></i></a>

@can('role-edit')
<a href="{{route('roles.edit',$id)}}" id="edit-info" d
                      ata-id="{{$id }}" class="btn btn-primary "  value="{{route('roles.edit',$id)}}">
    <i class="fa fa-edit"></i></a>
@endcan
@can('role-delete')
        <a	href="#"  value="{{route('roles.destroy',$id)}}" data-token="{{ csrf_token() }}"
         data-id="{{$id}}" class="delete-post-link btn btn-danger " ><i class="fa fa-trash"></i>
           </a>
@endcan



