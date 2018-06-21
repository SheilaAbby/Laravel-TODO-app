@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

{{--displaying the session error--}}
@if(Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning">{{Session::get('warning')}}</div>
@endif

            <div class="card">
               
                    <div class="card-header">Create your ToDo here</div>
                     <div class="card-body">
                    <form action="{{route('todo.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <input type="text" name="todo" value="{{old('todo')}}" class="form-control{{ $errors->has('todo') ? ' is-invalid' :''}}" placeholder="Enter your ToDo here">

                        @if($errors->has('todo'))
                        <span class="invalid-feedback">{{$errors->first('todo')}}</span>
                        @endif

                        </div>
                        <div>
                       <button type="submit" class="btn btn-secondary btn-block">Create ToDo</button>
                        
                        </div>
                    </form>
                </div>
            </div>
            <div class="card card-default mt-4">{{--margin top of 4--}}
                <div class="card-header">Your Todos</div>

                <div class="card-body">

                    @foreach($todos as $todo)
                    <p>{{ $todo->todo }}</p>
                <form action="{{route('todo.delete',$todo->id)}}" method="post">
                    <p>
                        <small>
                            {{$todo->created_at->diffForHumans()}}
                        </small>
                <a href="{{route('todo.edit',$todo->id)}}" class="btn btn-secondary btn-sm">Edit</a>

                  
                
                    {{csrf_field()}}
                    {{method_field("DELETE")}}
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

                    </p>
                     <hr>

                    @endforeach

                    @if(count($todos)==0) {{--Counts all elements in an array or object--}}
                    <p>There are no Todos for you.</p>

                    @endif
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
