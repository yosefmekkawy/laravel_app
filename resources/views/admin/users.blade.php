@extends('admin.admin_layout')
@section('title','Admin | Users')

@section('content')
    <div class="users_list">
        <div class="container">
            <h1 class="my-4">All Users</h1>
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                <tr>
                    <th>Image</th>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center">No users found.</td>
                    </tr>
                @else
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                @if($user->image?->name)
                                    <img src="{{ asset('images/'.$user->image->name) }}" alt="" style="border-radius: 5px;">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="" style="border-radius: 5px;">
                                @endif
                            </td>
                            <td>{{ $user->id }}</td>

                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->type }}</td>
                            <td>{{ $user -> created_at}}</td>
                            <td><a href="{{route('dashboard.edit.user',$user->id)}}" class="btn btn-primary">Edit</a> <a href="/delete?model_name=users&id={{$user->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
@endsection
