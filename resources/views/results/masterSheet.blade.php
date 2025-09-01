@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Result Mastersheet</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Result</li>
          <li class="breadcrumb-item active">Mastersheet</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Result Mastersheet</h5>
              <div class="row  g-3">
                <x-alerts />

                <!-- First Name -->
                <div class="col-6">
                    <label for="session" class="form-label">Session</label>
                    <select name="session" id="session" class="form-control" required>
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
                        <option value="4">Annual</option>
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



                <div class="text-center">
                    <button type="button" id="generateBtn" class="btn btn-primary">Generate</button>
                </div>

                <div id="mastersheetResults" style="display: none;">
                    <!-- The student table will be injected here by the AJAX request -->
                </div>


                </div>
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
            const sessionId = $('#session').val();
            const term = $('#term').val();


            if (!classId || !classArmId  || !sessionId || !term) {
                alert("Please select class, class arm, session and term before generating.");
                return;
            }

            $.ajax({
                url: "{{ route('results.fetch.mastersheet') }}",
                method: "POST",
                dataType: "html",
                data: {
                    _token: "{{ csrf_token() }}",
                    school_class_id: classId,  // Changed class_id to school_class_id
                    class_arm_id: classArmId,  // Kept class_arm_id as it is correct
                    term: term,
                    session_id: sessionId,
                },
                success: function(response) {
                    // Insert the HTML table into the page
                    $('#mastersheetResults').html(response); // Inject the returned HTML table
                    $('#mastersheetResults').show(); // Display the results section
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


