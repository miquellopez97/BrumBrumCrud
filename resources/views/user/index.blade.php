@extends('user.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>BRUM BRUM CRUD</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a href="logout">Logout</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Password</th>
            <th>Rol</th>
            <th>Detail</th>
            <th>Other Info</th>
            <th>Photo</th>
            <th>Google ID</th>
        </tr>
        @foreach ($users as $users)
        <tr>
            <td>{{ $users->id }}</td>
            <td>{{ $users->username }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->surname }}</td>
            <td>{{ $users->password }}</td>
            <td>{{ $users->rol }}</td>
            <td>{{ $users->detail }}</td>
            <td>{{ $users->otherInformation }}</td>
            <td>{{ $users->photo }}</td>
            <td>{{ $users->googleID }}</td>
            <td>
                <form action="{{ route('user.destroy',$users->id) }}" method="POST">   
                    <a class="btn btn-info" href="{{ route('user.show',$users->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('user.edit',$users->id) }}">Edit</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection
