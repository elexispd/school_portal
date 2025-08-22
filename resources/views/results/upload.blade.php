@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Result Upload</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Result</li>
          <li class="breadcrumb-item active">Upload</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Upload Result</h5>

              <form class="row g-3" method="POST" action="{{ route('results.store') }}">
                @csrf
                <x-alerts />

                <!-- First Name -->
                <div class="col-6">
                    <label for="session" class="form-label">Session</label>
                    <select name="session_id" class="form-control" required>
                        <option value="" selected disable>Select Session</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}">{{ $session->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    <label for="term" class="form-label">Term</label>
                    <select name="term" id="term" class="form-control" required>
                        <option value="1">First Term</option>
                        <option value="2">Second Term</option>
                        <option value="3">Third Term</option>
                    </select>
                </div>

                <!-- Class -->
                <div class="col-6">
                    <label for="class" class="form-label">Class</label>
                    <select name="school_class_id" id="class" class="form-control @error('school_class_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Class</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->id }}" {{ old('class') == $class->name ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('school_class_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Class Arm -->
                <div class="col-6">
                    <label for="class_arm_id" class="form-label">Class Arm</label>
                    <select name="class_arm_id" id="classarm" class="form-control @error('class_arm_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Select Class Arm</option>
                        <!-- Options will be populated via JavaScript based on class selection -->
                    </select>
                    @error('class_arm_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="subject_id" class="form-label">Subject</label>
                    <select name="subject_id" class="form-control" required>
                        <option value="" selected disable>Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="text-center">
                    <button type="button" id="generateBtn" class="btn btn-primary">Generate</button>
                </div>

                <!-- Student Table for Result Input -->
                <div id="studentResults" style="display: none;">
                    <!-- The student table will be injected here by the AJAX request -->
                </div>

            </form>

            </div>
          </div>

        </div>
      </div>
    </section>

 @include('layouts.partials.class-arm')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    $(document).ready(function() {
        $('#generateBtn').click(function() {
            const classId = $('#class').val();
            const classArmId = $('#classarm').val();
            const term = $('#term').val();
            const subjectId = $('select[name="subject_id"]').val();

            if (!classId || !classArmId || !subjectId) {
                alert("Please select class, class arm, and subject before generating.");
                return;
            }

            $.ajax({
                url: "{{ route('results.fetch') }}",
                method: "POST",
                dataType: "html",
                data: {
                    _token: "{{ csrf_token() }}",
                    school_class_id: classId,  // Changed class_id to school_class_id
                    class_arm_id: classArmId,  // Kept class_arm_id as it is correct
                    subject_id: subjectId,
                    term: term,
                },
                success: function(response) {
                    // Insert the HTML table into the page
                    $('#studentResults').html(response); // Inject the returned HTML table
                    $('#studentResults').show(); // Display the results section
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching students:", error);
                    alert("There was an error fetching students.");
                }
            });

        });
    });
</script>

@endsection


