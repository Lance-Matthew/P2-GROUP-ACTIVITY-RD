@extends("layout")
@section('content')
<main>
    <div class="ms-auto me-auto mt-5" style="width: 500px">
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
        <form action="{{route('reset.password.post')}}" method="POST">
            @csrf
            <input type="text" name="token" hidden value="{{$token}}">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter new password</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Confirm new password</label>
                <input type="password" name= "confirmpassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
@endsection