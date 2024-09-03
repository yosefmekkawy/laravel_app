@extends('layout')
@section('title', 'Edit User')
@section('content')
    <div class="contact_us">
        <div class="container">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p class="alert alert-success">{{session('success')}}</p>
            @endif
                <form action="{{route('dashboard.update.user', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                <div class="mb-3">
                    <label>Username</label>
                    <input class="form-control" name="username" value="{{ $user->username }}">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input class="form-control" name="email" value="{{ $user->email }}">
                </div>
                <div class="mb-3">
                    <label>Phone</label>
                    <input class="form-control" name="phone" value="{{ $user->phone }}">
                </div>
                <div class="mb-3">
                    <label>Password (leave blank if you don't want to change it)</label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div class="mb-3">
                    <label>Personal Image (leave blank if you don't want to change it)</label>
                    <input class="form-control" name="image" type="file">
                </div>
                @if($user->image)
                    <img src="{{ asset('images/' . $user->image->name) }}" alt="Profile Picture" width="100" class="mx-auto d-block">
                @endif


                <input type="submit" class="btn btn-success mx-auto d-block my-3" value="Update User">
            </form>
        </div>
    </div>
@endsection
