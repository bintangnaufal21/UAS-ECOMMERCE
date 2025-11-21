@extends('layouts.layoutAdmin')

@section('title', 'Users Management')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/users.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
@endsection

@section('content')
    <header class="navbar">
        <div class="navbar-content">
            <h1>User</h1>
            <div class="user-info">
                <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->username }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
