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
    @component('components.admin_links')@endcomponent

</body>
</html>