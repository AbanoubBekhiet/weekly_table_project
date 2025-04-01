<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="{{ asset('css/home.css') }} " rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }} " rel="stylesheet">
</head>
<body>
    @component('components.header-component')
    @if ($errors->any())
    <div class="error-message">
        <ul class="error-list">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    @endcomponent
    <div class="image_section">
        <img src="{{ asset('images/group-kids-studying-school.jpg') }}" 
             alt="students picture" 
             class="responsive-img">
    </div>

</body>
</html>