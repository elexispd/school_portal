@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>View Result</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Result</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Result for {{ $result->student->getFullNameAttribute() }} - {{ $result->subject->name }}</h5>
                <div class="row  g-3">
                    <x-alerts />

                    <form method="POST" action="{{ route('results.update', $result->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="ca">CA</label>
                            <input type="number" id="ca" name="ca" class="form-control" value="{{ $result->ca }}" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="exam">Exam</label>
                            <input type="number" id="exam" name="exam" class="form-control" value="{{ $result->exam }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Update Result</button>
                        </div>
                        <input type="hidden" id="" name="school_class_id" class="form-control" value="{{ $result->school_class_id }}" required>
                        <input type="hidden" id="" name="class_arm_id" class="form-control" value="{{ $result->school_class_id }}" required>
                        <input type="hidden" id="" name="subject_id" class="form-control" value="{{ $result->school_class_id }}" required>
                        <input type="hidden" id="" name="term" class="form-control" value="{{ $result->term }}" required>
                        <input type="hidden" id="" name="session_id" class="form-control" value="{{ $result->session_id }}" required>
                    </form>

                </div>
            </div>
          </div>

        </div>
      </div>
    </section>


@endsection


