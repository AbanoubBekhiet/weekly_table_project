<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table of Content</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/table.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script src="{{ asset('js/Sortable.min.js') }}"></script> 
    <script src="{{ asset('js/table.js') }}"></script> 
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script> --}}
</head>
<body class="body-bg text-color">

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
        <p class="success-title">Success!</p>
        <p class="success-text">{{ session('message') }}</p>
    </div>
@endif
    <div class="button-container">
        <button class="btn-download">Print PDF</button>
    </div>
    <div class="container card">
        <header class="header-section">
            <div class="logo-container">
                <img src="{{ asset('images/LOGO-ROYAL-AMERICAN-SCHOOL.png') }}" alt="School Logo" class="logo">
            </div>
            
            <div class="title-container">
                <h2 class="title">weekly plan {{ $gradeName }}</h2>
                <p class="subtitle"> {{ $week->week_number }}</p>
                <img src="{{ asset('images/myidenty.jpeg') }}" alt="Identity" class="logo">
            </div>
            
            <div class="date-container">
                <p class="label">Week Period:</p>
                <p class="date"> {{ $week->end_date }}  - {{ $week->start_date }}</p>
                <p class="label">Grade: <span class="highlight">{{ $gradeName }}</span></p>
            </div>
        </header>

        <table class="table-content">
            <tr>
                <th>{{ $week->top_left ?? "" }}</th>
                <th>{{ $week->top_right ?? "" }}</th>
            </tr>
            <tr>
                <td>{{ $week->bottom_left ?? "" }}</td>
                <td>{{ $week->bottom_right ?? "" }}</td>
            </tr>
        </table>
    </div>

    <div class="table-container" >
        <table class="table-content" id="table-content">
            <tbody>

                <tr>
                    <th colspan="2" style="font-size:23px;background-color:tomato;color:white">Assessments</th>
                    @php
                        $days = ['mon', 'tue', 'wen', 'thr', 'fri'];
                    @endphp
                    @foreach ($days as $day)
                        <th style="font-size:16px;background-color:tomato;color:white"> 
                            @if (!empty($assignments[$day]) && $assignments[$day]->count())
                                @foreach ($assignments[$day] as $quiz)
                                    -{{ $quiz->assignment }}<br> 
                                @endforeach
                            @else
                                No Quiz
                            @endif
                        </th>
                    @endforeach
                </tr>
                <tr style="font-size:23px">
                    <th rowspan="2">Subject</th>
                    <th rowspan="2">Type</th>
                    <th colspan="5">Days</th>
                </tr>
                <tr  style="font-size:23px">
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                </tr>
            @foreach ($tableOfContent as $subjectName => $subjectData)
            <tbody class="subject-group">

                @foreach ($subjectData as $data)
                
                    <tr>
                        <td style="font-size:23px" rowspan="5" class="subject-name">{{ wordwrap($subjectName, 20, "\n", true) }}</td>
                        <td style="background-color:#007bff;color:white;font-size:23px">Lessons/Topics</td>
                        <td>{{ wordwrap($data->monday_lesson ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->tuesday_lesson ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->wednesday_lesson ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->thursday_lesson ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->friday_lesson ?? '', 20, "\n", true) }}</td>
                    </tr>
                    <tr>
                        <td style="font-size:23px">Books and Pages</td>
                        <td>{{ wordwrap($data->monday_books_pages ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->tuesday_books_pages ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->wednesday_books_pages ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->thursday_books_pages ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->friday_books_pages ?? '', 20, "\n", true) }}</td>
                    </tr>
                    <tr>
                        <td style="font-size:23px">Homework</td>
                        <td>{{ wordwrap($data->monday_homework ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->tuesday_homework ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->wednesday_homework ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->thursday_homework ?? '', 20, "\n", true) }}</td>
                        <td>{{ wordwrap($data->friday_homework ?? '', 20, "\n", true) }}</td>
                    </tr>
                    @php
                    $remove_dates = ($data->monday_hw_due_date == null
                        && $data->tuesday_hw_due_date == null
                        && $data->wednesday_hw_due_date == null
                        && $data->thursday_hw_due_date == null
                        && $data->friday_hw_due_date == null);
                    @endphp
                
                @if (!$remove_dates)  {{-- Only display if notes exist --}}
                <tr>
                    <td style="font-size:23px">Hw due Date</td>
                    <td>{{ wordwrap($data->monday_hw_due_date ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->tuesday_hw_due_date ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->wednesday_hw_due_date ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->thursday_hw_due_date ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->friday_hw_due_date ?? '', 20, "\n", true) }}</td>
                </tr>
                @else
                <tr></tr>
                @endif
                    @php
                    $remove_notes = ($data->monday_notes == null
                        && $data->tuesday_notes == null
                        && $data->wednesday_notes == null
                        && $data->thursday_notes == null
                        && $data->friday_notes == null);
                    @endphp
                
                @if (!$remove_notes)  
                <tr style="color:tomato">
                    <td style="font-size:23px">Notes</td>
                    <td>{{ wordwrap($data->monday_notes ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->tuesday_notes ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->wednesday_notes ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->thursday_notes ?? '', 20, "\n", true) }}</td>
                    <td>{{ wordwrap($data->friday_notes ?? '', 20, "\n", true) }}</td>
                </tr>
                @else
                <tr></tr>
                @endif

                @endforeach
            </tbody>

                @endforeach
                
                
            </tbody>
        </table>
    </div>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            new Sortable(document.querySelector("#table-content"), {
                animation: 150,
                handle: ".subject-name", // Drag handle (only subject column)
                ghostClass: "sortable-ghost", // Add a class for visual feedback
                group: "subjects", // Ensures subjects move as a unit
            });
        });
    </script>
</body>
</html>
