
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DieselGo | Manage Bookings</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #172b4d;
        }

        .layout { display: flex; min-height: 100vh; }

        .sidebar {
            width: 245px;
            background: #14283f;
            color: white;
            padding: 26px 18px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            color: #fbbf24;
            margin-bottom: 40px;
        }

        .nav-link {
            display: block;
            padding: 14px 16px;
            margin-bottom: 9px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 9px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #24517a;
            color: white;
        }

        .main { flex: 1; min-width: 0; }

        .topbar {
            background: white;
            padding: 20px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }

        .topbar h2 { margin: 0; }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: 0;
            border-radius: 8px;
            padding: 10px 18px;
            cursor: pointer;
        }

        .content { padding: 30px; }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-title h1 { margin: 0 0 8px; }
        .page-title p { margin: 0; color: #64748b; }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #e8edf4;
            box-shadow: 0 3px 12px #00000008;
        }

        .stat-card .label { color: #64748b; font-size: 14px; }
        .stat-card .value {
            font-size: 32px;
            font-weight: 800;
            margin-top: 12px;
        }

        .stat-card.total { border-top: 4px solid #2563eb; }
        .stat-card.pending { border-top: 4px solid #f59e0b; }
        .stat-card.confirmed { border-top: 4px solid #10b981; }
        .stat-card.delivered { border-top: 4px solid #8b5cf6; }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #e8edf4;
        }

        .filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .filters input,
        .filters select {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        .filters input { flex: 1; min-width: 190px; }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 11px 16px;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-secondary { background: #64748b; }

        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            color: #64748b;
            white-space: nowrap;
        }

        .customer-name { font-weight: 700; }
        .customer-email {
            color: #64748b;
            font-size: 12px;
            margin-top: 4px;
        }

        .status {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.pending { background: #fef3c7; color: #92400e; }
        .status.confirmed { background: #d1fae5; color: #065f46; }
        .status.out_for_delivery { background: #dbeafe; color: #1d4ed8; }
        .status.delivered { background: #ede9fe; color: #5b21b6; }
        .status.cancelled { background: #fee2e2; color: #991b1b; }

        .update-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .update-form select {
            padding: 9px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
        }

        .update-form button {
            background: #1769aa;
            color: white;
            border: 0;
            border-radius: 7px;
            padding: 10px 13px;
            cursor: pointer;
        }

        .alert {
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 18px;
        }

        .alert-success { background: #dcfce7; color: #166534; }
        .alert-error { background: #fee2e2; color: #991b1b; }

        .pagination { margin-top: 22px; }

        @media (max-width: 1000px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 700px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 15px; }
            .brand { margin-bottom: 12px; }
            .nav-link { display: inline-block; }
            .topbar { padding: 16px; }
            .content { padding: 16px; }
            .stats { gap: 12px; }
            .stat-card { padding: 16px; }
            .stat-card .value { font-size: 26px; }
            .panel { padding: 14px; }
        }
    </style>
</head>
<body>

<div class="layout">

    <aside class="sidebar">
        <div class="brand">⛽ DieselGo</div>

        <a class="nav-link"
           href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <a class="nav-link active"
           href="{{ route('admin.bookings.index') }}">
            Manage Bookings
        </a>
    </aside>

    <div class="main">

        <header class="topbar">
            <h2>Booking Management</h2>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </header>

        <div class="content">

            <div class="page-title">
                <div>
                    <h1>Manage Fuel Bookings</h1>
                    <p>View, search and manage customer diesel orders.</p>
                </div>
            </div>

            <div class="stats">
                @foreach([
                    'total' => 'Total Bookings',
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'delivered' => 'Delivered'
                ] as $key => $label)
                    <div class="stat-card {{ $key }}">
                        <div class="label">{{ $label }}</div>
                        <div class="value">{{ $stats[$key] ?? 0 }}</div>
                    </div>
                @endforeach
            </div>

            <div class="panel">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="GET"
                      action="{{ route('admin.bookings.index') }}"
                      class="filters">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search booking ID, customer name or email"
                        value="{{ $search }}"
                    >

                    <select name="status">
                        <option value="">All Statuses</option>

                        @foreach([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'out_for_delivery' => 'Out for Delivery',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled'
                        ] as $value => $label)
                            <option value="{{ $value }}"
                                @selected($status === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn">
                        Search
                    </button>

                    <a href="{{ route('admin.bookings.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </form>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer</th>
                                <th>Fuel</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Delivery Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bookings as $booking)
                                @php
                                    $transitions = [
                                        'pending' => ['confirmed', 'cancelled'],
                                        'confirmed' => ['out_for_delivery', 'cancelled'],
                                        'out_for_delivery' => ['delivered'],
                                    ];

                                    $allowed = $transitions[$booking->status] ?? [];
                                @endphp

                                <tr>
                                    <td><strong>#{{ $booking->id }}</strong></td>

                                    <td>
                                        <div class="customer-name">
                                            {{ $booking->user->name ?? 'N/A' }}
                                        </div>

                                        <div class="customer-email">
                                            {{ $booking->user->email ?? '' }}
                                        </div>
                                    </td>

                                    <td>{{ $booking->fuelType->name ?? 'N/A' }}</td>

                                    <td>{{ $booking->quantity_litres }} L</td>

                                    <td>
                                        <strong>
                                            ₹{{ number_format($booking->total_amount, 2) }}
                                        </strong>
                                    </td>

                                    <td>{{ $booking->delivery_address }}</td>

                                    <td>
                                        <span class="status {{ $booking->status }}">
                                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if(count($allowed))
                                            <form
                                                class="update-form"
                                                method="POST"
                                                action="{{ route('admin.bookings.status', $booking->id) }}"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <select name="status" required>
                                                    <option value="">Select Status</option>

                                                    @foreach($allowed as $nextStatus)
                                                        <option value="{{ $nextStatus }}">
                                                            {{ ucwords(str_replace('_', ' ', $nextStatus)) }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit">
                                                    Update
                                                </button>
                                            </form>
                                        @else
                                            <span style="color:#64748b">
                                                No further actions
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center;padding:35px">
                                        No bookings found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    {{ $bookings->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>
