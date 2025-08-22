<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <title>Result Sheet</title>
    <style>
        :root {
            --primary-color: #3e4095;
            --secondary-color: #3e4095;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 794px;
            height: 1140px;
            border: 1px solid rgb(227, 217, 217);
            margin: 10px auto;
            text-align: center;
            padding: 10px;
            page-break-after: always; /* ✅ Each student on a new page */
        }

        .header {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background-color: var(--primary-color);
            color: white;
        }

        .header i {
            font-size: 80px;
            border: 1px solid gray;
            border-radius: 4px;
        }

        .header img {
            width: 65px;
        }

        .school-name {
            line-height: 8px;
            padding: 5px;
        }

        .school-name h1 {
            font-size: 24px;
        }

        .school-name h2 {
            font-size: 20px;
        }

        .school-name p {
            font-size: 12px;
        }

        .main {
            padding: 10px;
        }

        .contacts {
            text-align: center;
            line-height: 10px;
        }

        .section {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .section p {
            text-align: start;
        }

        .records {
            position: relative;
        }

        .records img {
            position: absolute;
            width: 500px;
            z-index: -1;
            top: 10%;
            left: 20%;
            opacity: 0.1;
        }

        .records table {
            border-collapse: collapse;
            border-color: rgb(147, 144, 144);
            font-size: 12px;
            width: 100%;
        }

        .records table tr:nth-child(1) {
            background-color: var(--primary-color);
            color: white;
        }

        .records table tr th {
            padding: 10px 0;
        }

        .records table tr td {
            padding: 0.25rem;
            text-align: center;
            font-weight: bold;
        }

        .records table tr td:first-child {
            text-align: start;
            width: 160px;
        }

        .grade table {
            border-collapse: collapse;
            border-color: rgb(147, 144, 144);
            font-size: 14px;
            width: 100%;
        }

        .grade table th,
        .grade table td {
            padding: 5px 0;
        }

        .summary {
            display: flex;
            justify-content: space-between;

        }

        .summary table {
            border-collapse: collapse;
            border-color: rgb(147, 144, 144);
            width: 75%;
        }

        .summary table td {
            padding: 5px;
            text-align: start;
            font-size: 12px;
        }

        .summary-title {
            text-align: start;
        }

        .summary table td p {
            font-size: 12px;
            padding: 1px;
        }

        .summary .stamp img {
            width: 110px;
        }

        .summary .stamp p {
            font-size: 14px;
            line-height: 5px;
        }

        .footer {
            text-align: start;
            font-size: 10px;
        }
    </style>
</head>

<body>


    @foreach ($studentResults as $data)
    <div class="container">
        <div class="main">
            <div class="header">
                <div class="logo">
                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="">
                </div>
                <div class="school-name">
                    <h1>{{ config('app.school_name') }}</h1>
                    <p><b>Motto:</b> Love, Service and Sacrifice |
                       <b>Email:</b> info@exampleschool.com |
                       <b>Phone:</b> xxxxxxx</p>
                    <h2>**BASIC PUPILS <b>TERMLY</b> REPORT**</h2>
                </div>
                <div class="profile-image">
                    <i class="ri-user-3-fill"></i>
                </div>
            </div>

            <div class="contacts">
                <h2>{{ $data['student']->getFullNameAttribute() }}</h2>
                <p><b>Admission Number:</b> {{ $data['student']->admission_number }} |
                   <b>Portal Code:</b> {{ $data['student']->result_pin }} |
                   <b>Status:</b> Active</p>
            </div>

            <div class="section">
                <div class="first-section">
                    <p>
                        <b>Term:</b> {{ $data['results'][0]->term($data['results'][0]->term) }} <br>
                        <b>Session:</b> {{ $data['results'][0]->getSessionName() }} <br>
                        <b>Gender:</b> {{ ucwords($data['student']->gender) }} <br>
                    </p>
                </div>
                <div class="second-section">
                    <p>
                        <b>Class:</b> {{ $data['results'][0]->getClassName() }} <br>
                        <b>No in Class:</b> {{ $totalStudentsInClass }} <br>
                        <b>No. in Clas Arm:</b> {{ $totalStudentsInClassArm }}
                    </p>
                </div>
                <div class="third-section">
                    <p>
                        <b>Performance Average (PA):</b> {{ number_format($data['average'], 2) }} <br>
                        <b>Position:</b> {{ getOrdinal($data['position']) }} <br>
                        <b>Vacation Date:</b> {{ $vacation->date->format('jS F, Y') }} <br>
                    </p>
                </div>
            </div>

            <div class="records">
                <img src="udoka_ps_logo.jpg" alt="">
                <table border="1">
                    <tr>
                        <th>SUBJECTS</th>
                        <th>Test (40%)</th>
                        <th>Exam (60%)</th>
                        <th>Total (100%)</th>
                        <th>Grade</th>
                        <th>Remark</th>
                        <th>Pos.</th>
                        <th>Max. Score</th>
                    </tr>

                    @foreach ($data['results'] as $result)
                    <tr>
                        <td>{{ $result->subject->name }}</td>
                        <td>{{ $result->ca }}</td>
                        <td>{{ $result->exam }}</td>
                        <td>{{ $result->total }}</td>
                        <td>{{ $result->grade }}</td>
                        <td>{{ $result->getRemark($result->total) }}</td>
                        <td>{{ $result->ordinate($result->position) }}</td>
                        <td>{{ $result->class_highest_score }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="grade">
                <h3>Grading System</h3>
                <table border="1">
                    <tr>
                        <th>A - Distinction</th>
                        <th>B - Lower Distinction</th>
                        <th>C - Credit</th>
                        <th>D - Pass</th>
                        <th>F - Fail</th>
                    </tr>
                    <tr>
                        <td>80 - 100</td>
                        <td>70 - 80</td>
                        <td>60 - 70</td>
                        <td>50 - 60</td>
                        <td>0 - 50</td>
                    </tr>
                </table>
            </div>

            <h3 class="summary-title">Summary</h3>
            <div class="summary">

                <table border="1">
                    <tr>
                        <td><b>TOTAL SCORE:</b></td>
                        <td>{{ $data['total_score'] }}</td>
                        <td><b>AVG SCORE:</b></td>
                        <td>{{ number_format($data['average'], 2) }}%</td>
                        <td><b>REMARK:</b></td>
                        <td><b>STATUS:</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <p> <b>Form Teacher's Comment:</b> My Dear, Outstanding achievement! Your hard work and
                                skills have truly shone through, Keep aiming high and breaking new ground!</p>
                        </td>
                    </tr>
                </table>
                <div class="stamp">
                    <img src="{{ asset('assets/img/stamp.png') }}" alt="">
                    <p>Name of Principal</p>
                </div>

            </div>
            <div class="footer" sty>
                <p><b>Resumption Date: {{ $resumption->date->format('jS F, Y') }}</b></p>
            </div>
        </div>
    </div>
    @endforeach

</body>
</html>
