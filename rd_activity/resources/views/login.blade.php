@extends('layout')
@section('title', 'login')
@section('content')

    <div  class="container">
    <div class ="mt-5">
        @if($errors->any())
          <div class="col-12">
            @foreach($errors->all() as $error)
              <div class="alert alert-danger">{{$error}}</div>
            @endforeach
          </div>
        @endif

        @if(session()->has('error'))
          <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
          <div class="alert alert-success">{{session('success')}}</div>
        @endif
      </div>
    <form action="{{route('login.post')}}" method="POST" style="width: 500px">
    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div>
    <a href="{{route("forgot.password")}}">Forgot your password?</a>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
    </div>
@endsection