<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="containerr my-5">
    <h2 class="mb-4 text-center">{{ $className }} {{ $classArmName }} Class List</h2>

    <div class="card shadow-lg rounded-3">
        <div class="card-body">
            @if($students->isEmpty())
                <div class="alert alert-warning text-center">
                    No students found for this class and arm.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>SN</th>
                            <th>Full Name</th>
                            <th>Admission No</th>
                            <th>Result Pin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $student->getFullNameAttribute() }}</td>
                                <td>{{ $student->admission_number }}</td>
                                <td>{{ $student->result_pin }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

</body>
</html>
