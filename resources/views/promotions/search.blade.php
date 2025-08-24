@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Students </h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Student</li>
          <li class="breadcrumb-item active">Search</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <x-alerts />



        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Search Class Arm</h5>

                <form class="row g-3" method="GET" action="{{ route('promotions.result') }}">
                    <!-- First Name -->
                    <div class="col-12">
                        <label for="first_name" class="form-label">Search By Class</label>
                        <select name="class" id="class" class="form-control @error('class') is-invalid @enderror" required>
                            <option value="" disabled selected></option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class') == $class->name ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="first_name" class="form-label">Search By Class Arm</label>
                        <select name="classarm" id="classarm" class="form-control @error('classarm') is-invalid @enderror" required>
                            <!-- Options will be populated via JavaScript based on class selection -->
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                </div>
            </div>
        </div>



      </div>
    </section>

    @include('layouts.partials.class-arm')

@endsection
