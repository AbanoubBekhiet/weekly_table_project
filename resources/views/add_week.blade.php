<!DOCTYPE html>
<html lang="ar" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
   <link href="{{ asset('css/add_week.css') }}" rel="stylesheet"></link>
   <link href="{{ asset('css/normalize.css') }}" rel="stylesheet"></link>
   <script src="{{ asset('js/jquery.js') }}"></script> 
   <script src="{{ asset('js/add_week.js') }}"></script> 
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

<div class="form-container">
    <h2>Add Week</h2>
    <form id="teacherForm" action="{{ route('add_week') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="week_number">Week Title</label>
            <input type="text" id="week_number" name="week_number" placeholder="Enter week name" required>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" id="end_date" name="end_date" required readonly>
        </div>




        <div class="form-group">
            <label for="top_left">small table top left content</label>
            <input type="top_left" id="top_left" name="top_left" required >
        </div>
        <div class="form-group">
            <label for="top_right">small table top right content</label>
            <input type="top_right" id="top_right" name="top_right" required >
        </div>
        <div class="form-group">
            <label for="bottom_left">small table bottom left content</label>
            <input type="bottom_left" id="bottom_left" name="bottom_left" required >
        </div>
        <div class="form-group">
            <label for="bottom_right">small table bottom left content</label>
            <input type="bottom_right" id="bottom_right" name="bottom_right" required >
        </div>

        <button type="submit">Add Week</button>
    </form>
</div>

</body>
</html>