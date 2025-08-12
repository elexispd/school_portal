@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Staff</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Staff</li>
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
              <h5 class="card-title">Edit Staff</h5>


              <form class="row g-3" method="POST" action="{{ route('staff.update', $staff->id) }}">
                @csrf
                @method('PUT')
                <x-alerts />

                <div class="col-12">
                    <label for="inputName4" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="inputName4"
                        value="{{ old('name', $staff->name) }}">
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
