<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DieselGo Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .card {
            background: white;
            padding: 35px;
            border-radius: 14px;
            width: 350px;
            max-width: 85%;
            box-shadow: 0 4px 20px #0001;
        }
        h2 { color: #173a63; text-align: center; }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
        }
        button {
            background: #1769aa;
            color: white;
            padding: 13px;
            border: 0;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
        }
        .error { color: #dc2626; }
    </style>
</head>
<body>
    <div class="card">
        <h2>⛽ DieselGo Admin</h2>

        @if ($errors->any())
            <p class="error">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
            >

            <input
                type="password"
                name="password"
                placeholder="Password"
                required
            >

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
