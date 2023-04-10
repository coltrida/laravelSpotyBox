@extends('layouts.style2')

@section('content')
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="my-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name" required autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select id="type" name="role" class="form-select" aria-label="Default select example">
                <option selected></option>
                <option value="user">Simple User</option>
                <option value="artist">Artist</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password"
                   required autocomplete="current-password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">password confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                   required autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
