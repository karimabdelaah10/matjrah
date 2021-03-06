<div class="row mg-t-20">


    <label class="col-sm-4 form-control-label">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }} {{ (@$attributes['stared'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <div class="custom-file">
            {!! Form::file($name,$attributes)!!}
            <label class="custom-file-label" for="{{ @$id }}">{{ trans('app.Choose') }}</label>
            @if(!$errors->isEmpty())
            @foreach($errors->get($name) as $message)
            <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach

            @if (str_contains($name,'[]') )
               
                @foreach($errors->get(str_replace("[]",'',$name)."*") as $index => $message)
                    <span class='help-inline text-danger'>{{ $message[0] }}</span>
                @endforeach
            @endif

            <br>
            @endif
            
            @php
            $value=(@$attributes['value'])?:$row->$name;
            @endphp
            @if(@$attributes['file_type'] == 'attachment' )
                {!! viewFile($value) !!}
            @else
               {!! viewImage($value,'small') !!}
            @endif
            

        </div>

    </div>
</div>
