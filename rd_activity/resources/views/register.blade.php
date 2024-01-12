@extends('layout')
@section('title', 'register')
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
    <form action="{{route('register.post')}}" method="POST" style="width: 500px">
    @csrf
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="email" class="form-control" name="email">
  </div>

  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="password" name="confirmpassword" required>
      
      @if ($errors ->has('password'))
      <span class="text-danger">{{$errors->first('password')}}</span>
      @endif
  </div>
  
  <button type="submit" class="btn btn-primary">Register</button>
</form>
    </div>
@endsection