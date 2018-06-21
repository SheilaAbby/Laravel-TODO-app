@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">



            <div class="card">
               
                    <div class="card-header">Edit todo</div>
                     <div class="card-body">
                    <form action="{{route('todo.update',$todo->id)}}" method="post">

                        {{ csrf_field() }}
                        {{method_field('PUT')}} {{--Update the record--}}

                        <div class="form-group">
                           <input type="text" name="todo" value="{{old('todo',$todo->todo)}}" class="form-control{{ $errors->has('todo') ? ' is-invalid' :''}}" >

                          @if($errors->has('todo'))
                           <span class="invalid-feedback">{{$errors->first('todo')}}</span>
                              @endif
                      </div>    
                        
                       <button type="submit" class="btn btn-secondary btn-block">Edit ToDo</button>
                        
                    </form>
                </div>
                </div>
    
            </div>
            
            
        </div>
</div>
             
</div>
@endsection