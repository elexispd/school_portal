<table class="table table-bordered">
    <thead>
        <tr>
            <th>Student</th>
            <th>Admission No</th>
            <th>CA</th>
            <th>Exam</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <input type="hidden" value="{{ $student->id }}" name="students[{{ $student->id }}][student_id]">
            <tr>
                <td>{{ $student->getFullNameAttribute() }}</td>
                <td>{{ $student->admission_number }}</td>
                <td>
                    <!-- Check if the student has a result. If so, pre-fill the result and disable the input field -->
                    @if($student->result)
                        <input type="number" name="students[{{ $student->id }}][ca]" value="{{ $student->result->ca }}" max="40" class="form-control" disabled />
                    @else
                        <input type="number" name="students[{{ $student->id }}][ca]" max="40" class="form-control" required />
                    @endif
                </td>
                <td>
                    @if($student->result)
                        <input type="number" name="students[{{ $student->id }}][exam]" value="{{ $student->result->exam }}" max="60" class="form-control" disabled />
                    @else
                        <input type="number" name="students[{{ $student->id }}][exam]" max="60" class="form-control" required />
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<button type="submit" class="btn btn-success">Save Results</button>
