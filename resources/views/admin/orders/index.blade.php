@extends('layouts.layoutAdmin')

@section('title', 'Orders Management')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin1/css/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('admin1/css/head.css') }}">
@endsection

@section('content')
<header class="navbar">
    <div class="navbar-content">
        <h1>Orders Management</h1>
        <div class="user-info">
            <span>Welcome, {{ Auth::user()->name ?? 'Admin User' }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</header>

<main>
    <div class="table-container">
        <div class="table-header">
            <h2>Daftar Pesanan</h2>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Total Harga</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $loop->iteration }}</td>

                            {{-- fullname dari form checkout --}}
                            <td>{{ $order->fullname }}</td>

                            {{-- created_at dari database --}}
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>

                            {{-- total harga --}}
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

                            <td class="action-btns">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-view">🔍 View Detail</a>

                                {{-- Edit Status - akan diarahkan ke halaman detail --}}
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-delete">⚙️ Edit Status</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top: 10px;">
            {{ $orders->links() }}
        </div>

    </div>
</main>
@endsection
