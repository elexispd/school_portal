<div style="overflow-x: auto; max-width: 100%;">
    <table class="table table-bordered" style="min-width: 800px;">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Admission No</th>
                @foreach($subjectResults as $subjectResult)
                    <th>{{ $subjectResult['subject']->name }}</th>
                @endforeach
                <th>Average</th>
                <th>Position</th>
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
                            {{ $result ? $result->total : 'N/A' }}
                        </td>
                    @endforeach

                    <!-- Average Score -->
                    <td>
                        @php
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<form action="{{ route('results.print') }}" method="post" target="_blank">
    @csrf
    <input type="hidden" name="school_class_id" value="{{ $school_class_id }}">
    <input type="hidden" name="session_id" value="{{ $session_id }}">
    <input type="hidden" name="class_arm_id" value="{{ $class_arm_id }}">
    <input type="hidden" name="term" value="{{ $term }}">
    <button type="submit" class="btn btn-primary btn-sm">Print All</button>
</form>
