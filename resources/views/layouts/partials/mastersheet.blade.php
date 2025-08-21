<table class="table table-bordered">
    <thead>
        <tr>
            <th>Student Name</th>
            <th>Admission No</th>
            @foreach($subjectResults as $subjectResult)
                <th>{{ $subjectResult['subject']->name }}</th>
            @endforeach
            <th>Average</th>
            <th>Position</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <!-- Student Info -->
                <td>{{ $student->getFullNameAttribute() }}</td>
                <td>{{ $student->admission_number }}</td>

                @foreach($subjectResults as $subjectResult)
                    @php
                        // Find the result for the current student and subject
                        $result = $subjectResult['results']->firstWhere('student_id', $student->id);
                    @endphp
                    <td>
                        {{ $result ? $result->total : 'N/A' }} <!-- If result exists, display score -->
                    </td>
                @endforeach

                <!-- Average Score -->
                <td>
                    @php
                        // Calculate average score across all subjects
                        $totalSubjects = count($subjectResults);
                        $totalScore = $student->results->sum('total');
                        $averageScore = $totalSubjects > 0 ? $totalScore / $totalSubjects : 0;
                    @endphp
                    {{ number_format($averageScore, 2) }}
                </td>

                <!-- Position -->
                <td>
                    {{ $student->position }}
                </td>

                <!-- Action (Edit/Delete) -->
                <td>
                    <a href="{{ route('results.edit', ['result' => $student->id]) }}" class="btn btn-primary btn-sm">Print</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
