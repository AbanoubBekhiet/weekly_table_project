<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
   <link href="{{ asset('css/admin_dashboard.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
</head>
<body>
    @component('components.header-component')@endcomponent
    @component('components.teacher_links')@endcomponent
    @if ($errors->any())
    <div class="error-message">
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('message'))
    <div class="success-message">
        <p class="success-text">{{ session('message') }}</p>
    </div>
@endif
</body>
</html>