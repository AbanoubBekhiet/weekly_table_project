<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <link href="{{ asset('css/admin_all_tables.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/admin_all_tables.js') }}"></script> 
</head>
<body>
    @component('components.header-component')@endcomponent
    @component('components.admin_links')@endcomponent

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

<div class="container">
    <form id="form_of_data" method="post" action="{{route("create_week_grade_subject_part")}}">
        @csrf
        <h2>All Weeks Tables</h2>
            <div class="form-group">
                <label for="year">Year</label>
                <select id="year" name="year">
                    <option>select year</option>
                    @foreach ($years as $year)
                        <option>{{ $year->year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group hide">
                <label for="week">Week Name</label>
                <select name="week" id="week">

                </select>
            </div>


            <div class="grades" style="display:flex;">

            </div>
    </form>
</div>
    

</body>
</html>