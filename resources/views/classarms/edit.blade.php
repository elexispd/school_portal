@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Class</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Class Arm</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Class Arm</h5>

              <h4> {{ ucwords($classarm->schoolClass->name) }} </h4>

            <form class="row g-3" method="POST" action="{{ route('classarms.update', $classarm->id) }}">
                @csrf
                @method('PUT')
                <x-alerts />

                <div class="col-12">
                    <label for="inputName4" class="form-label">Class Arm</label>
                    <input type="text" name="name" class="form-control" id="inputName4"
                        value="{{ old('name', $classarm->name) }}">
                    <input type="hidden" name="school_class_id" class="form-control" id="inputName4"
                        value="{{  $classarm->school_class_id }}">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>


            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
