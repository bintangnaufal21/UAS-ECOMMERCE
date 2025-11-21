@extends('layouts.layoutAdmin')

@section('title', 'Admin Dashboard - Book Sales System')

{{-- CSS khusus halaman --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/dash.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
@endsection

@section('content')
    <!-- Navbar -->
    <header class="navbar">
        <div class="navbar-content">
            <h1>Dashboard</h1>
            <div class="user-info">
                <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Summary Cards -->
        <div class="summary-grid">
            <div class="card">
                <div class="card-content">
                    <div class="card-icon blue">📚</div>
                    <div>
                        <h3>Total Books</h3>
                        <p>{{ $totalBooks }}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-icon green">📦</div>
                    <div>
                        <h3>Total Orders</h3>
                        <p>{{ $totalOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-icon purple">👥</div>
                    <div>
                        <h3>Total Customers</h3>
                        <p>{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders Table -->
        <div class="table-container">
            <div class="table-header">
                <h2>Recent Orders</h2>
            </div>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>#{{ $loop->iteration }}</td>

                                {{-- nama pemesan dari form checkout (fullname) --}}
                                <td>{{ $order->fullname }}</td>

                                <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                {{-- total dalam Rupiah --}}
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>

                                <td>
                                    @php
                                        $statusClass = match (strtolower($order->status)) {
                                            'pending' => 'status-pending',
                                            'shipped' => 'status-shipped',
                                            'completed' => 'status-completed',
                                            'canceled' => 'status-canceled',
                                            default => '',
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;">Belum ada order.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
