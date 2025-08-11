@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Class</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Class</li>
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
              <h5 class="card-title">Edit Class</h5>


              <form class="row g-3" method="POST" action="{{ route('classes.update', $class->id) }}">
                @csrf
                @method('PUT')
                <x-alerts />

                <div class="col-12">
                    <label for="inputName4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName4"
                        value="{{ old('name', $class->name) }}">
                </div>

                <div class="col-12">
                    <label for="inputCode5" class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" id="inputCode5"
                        value="{{ old('code', $class->code) }}">
                </div>

                <div class="col-12">
                    <label for="inputCategory6" class="form-label">Category</label>
                    <select name="category" id="inputCategory6" class="form-control">
                        <option value="" disabled>Select Category</option>
                        <option value="junior" {{ old('category', $class->category) === 'junior' ? 'selected' : '' }}>Junior</option>
                        <option value="senior" {{ old('category', $class->category) === 'senior' ? 'selected' : '' }}>Senior</option>
                    </select>
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
