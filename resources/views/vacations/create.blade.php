@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Upload Vacation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">School</li>
          <li class="breadcrumb-item active">Vacation</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Upload Vacation</h5>

              <form class="row g-3" method="POST" action="{{ route('vacations.store') }}">
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


                <!-- Class Arm -->
                <div class="col-6">
                    <label for="" class="form-label">Enter Date</label>
                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" required>
                </div>



                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>


            </form>

            </div>
          </div>

        </div>
      </div>
    </section>



@endsection


