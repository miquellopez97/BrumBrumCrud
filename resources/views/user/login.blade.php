@extends('user.layout')

@section('content')
    <h1>Login</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('auth.check') }}" method="post">
        @csrf
        <div>
            @if (Session::get('fail'))
                <div>
                    {{Session::get('fail')}}
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email" class="form-control" placeholder="email" value="{{ old ('email') }}">
                    <span>@error('email') {{ $message }} @enderror</span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input type="password" name="password" class="form-control" placeholder="password">
                    <span>@error('password') {{ $message }} @enderror</span>
                </div>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div> 
    </form>

@endsection