<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form - Simple Style</title>
    <link href="{{ asset('css/login.css') }} " rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }} " rel="stylesheet"></head>
<body>
    @component('components.header-component')
    @endcomponent

    <div class="login-container">
        <h2>Admin login</h2>
        <form action="{{ route('admin_login_back') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Your password" required>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>