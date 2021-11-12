
@if(in_array('view' , $actions))
    <a id="view-button" class="btn btn-custom-primary btn-xs custom-table-action" href="{{$module}}/view/{{$row->id}}" title="{{trans('options.View')}}">
        <i class="fa fa-eye"></i>
    </a>
@endif

@if(in_array('edit' , $actions))
    <a id="edit-button" class="btn btn-custom-success btn-xs custom-table-action" href="{{$module}}/edit/{{$row->id}}" title="{{trans('options.Edit')}}">
        <i class="fa fa-edit"></i>
    </a>
@endif

@if(in_array('delete' , $actions))
    <a id="delete-button" class="btn btn-danger btn-xs custom-table-action" href="{{$module}}/delete/{{$row->id}}" style="color: #fff" title="{{trans('options.Delete')}}"
            data-confirm="{{trans('partners.DeleteMsg')}}">
        <i class="fas fa-trash-alt"></i>
    </a>
@endif