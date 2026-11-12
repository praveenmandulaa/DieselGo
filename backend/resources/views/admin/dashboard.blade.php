
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DieselGo | Admin Dashboard</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #172b4d;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

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
            margin-bottom: 40px;
            color: #fbbf24;
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

        .main {
            flex: 1;
            min-width: 0;
        }

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
            padding: 10px 18px;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
        }

        .content { padding: 30px; }

        .welcome {
            margin-bottom: 26px;
        }

        .welcome h1 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .welcome p {
            color: #64748b;
            margin: 0;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 14px;
            box-shadow: 0 3px 12px #00000008;
            border: 1px solid #e8edf4;
        }

        .stat-card .label {
            color: #64748b;
            font-size: 14px;
        }

        .stat-card .value {
            font-size: 34px;
            font-weight: 800;
            margin-top: 14px;
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
            box-shadow: 0 3px 12px #00000008;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .panel-heading h3 { margin: 0; }

        .view-all {
            background: #2563eb;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #edf2f7;
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .status.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status.confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status.delivered {
            background: #ede9fe;
            color: #5b21b6;
        }

        .status.out_for_delivery {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .pagination { margin-top: 20px; }

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
        }
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar">
        <div class="brand">⛽ DieselGo</div>

        <a class="nav-link active"
           href="{{ route('admin.dashboard') }}">
            Dashboard
        </a>

        <a class="nav-link"
           href="{{ route('admin.bookings.index') }}">
            Manage Bookings
        </a>
    </aside>

    <div class="main">
        <header class="topbar">
            <h2>Admin Dashboard</h2>

            <form method="POST"
                  action="{{ route('admin.logout') }}">
                @csrf
                <button class="logout-btn" type="submit">
                    Logout
                </button>
            </form>
        </header>

        <div class="content">
            <div class="welcome">
                <h1>Welcome, {{ auth()->user()->name }}!</h1>
                <p>Monitor diesel bookings and delivery operations.</p>
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
                <div class="panel-heading">
                    <h3>Recent Fuel Bookings</h3>

                    <a class="view-all"
                       href="{{ route('admin.bookings.index') }}">
                        View All Bookings
                    </a>
                </div>

                @if(session('success'))
                    <p style="color:green">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Customer</th>
                                <th>Fuel</th>
                                <th>Quantity</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>#{{ $booking->id }}</td>
                                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->fuelType->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->quantity_litres }} L</td>
                                    <td>
                                        ₹{{ number_format($booking->total_amount, 2) }}
                                    </td>
                                    <td>
                                        <span class="status {{ $booking->status }}">
                                            {{ ucwords(str_replace('_', ' ', $booking->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        No bookings available.
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
