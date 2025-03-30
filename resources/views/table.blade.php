<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table of Content</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script src="{{ asset('js/table.js') }}"></script> 
</head>
<body class="body-bg text-color">
   

    <button class="btn-download ">
        Print PDF
    </button>
    <!-- Header Section -->
    <div class="container card">
        <div class="header-section">
            <!-- Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/LOGO-ROYAL-AMERICAN-SCHOOL.png') }}" alt="School Logo" class="logo">
            </div>

            <!-- Title -->
            <div class="title-container">
                <h2 class="title">Table of Content</h2>
                <p class="subtitle">{{ $week->week_number }}</p>
                <img src="{{ asset('images/myidenty.jpeg') }}" alt="School Logo" class="logo">
            </div>

            <!-- Date -->
            <div class="date-container">
                <p class="label">Week Period:</p>
                <p class="date">{{ $week->start_date }} - {{ $week->end_date }}</p>
                <p class="label">Grade: <span class="highlight">{{ $gradeName }}</span></p>
            </div>
        </div>
        <table class="table-content"> 
            <tr>
                <th>{{$week->top_left ?? ""}}</th>
                <th>{{$week->top_right ?? ""}}</th>
            </tr>
            <tr>
                <td>{{$week->bottom_left ?? ""}}</td>
                <td>{{$week->bottom_right ?? ""}}</td>
            </tr>
        </table>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <table class="table-content">
            <tr class="Assessments">
                <th colspan="2">Assessments</th>
                <th>Assessments</th>
                <th>Assessments</th>
                <th>Assessments</th>
                <th>Assessments</th>
                <th>Assessments</th>
            </tr>
            <div class="container">
                <a href="#" class="btn-download">Download PDF</a>
                
                <div class="table-container">
                    <table class="table-content">
                        <tr>
                            <th rowspan="2">Subject</th>
                            <th rowspan="2">Type</th>
                            <th colspan="5">Days</th>
                        </tr>
                        <tr>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                        <tr>
                            <td rowspan="5" class="subject-name">Subject Name</td>
                            <td>Lessons</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Reads/Pages</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Homework</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Due Date HM</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                        <tr>
                            <td>Notes</td>
                            <td></td><td></td><td></td><td></td><td></td>
                        </tr>
                    </table>
                </div>
            </div>

</body>
</html>  