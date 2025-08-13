@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Student Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Students</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->


    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
              <h2>{{ $student->getFullNameAttribute() }}</h2>
              <h3>Student</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>


              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <x-alerts />

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ $student->getFullNameAttribute() }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Admission Number</div>
                    <div class="col-lg-9 col-md-8">{{ $student->admission_number }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Current Class</div>
                    <div class="col-lg-9 col-md-8">{{ $student->schoolClass->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class Arm</div>
                    <div class="col-lg-9 col-md-8">{{ $student->classArm->name }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ ucwords($student->gender) }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date Of Birth</div>
                    <div class="col-lg-9 col-md-8">{{ $student->date_of_birth }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ $student->phone }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ $student->address }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State Of Origin</div>
                    <div class="col-lg-9 col-md-8">{{ $student->state_of_origin }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">LGA</div>
                    <div class="col-lg-9 col-md-8">{{ $student->state_of_origin }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Result Pin</div>
                    <div class="col-lg-9 col-md-8">{{ $student->result_pin }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="fullName" value="{{ ($student->first_name) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Middle Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="middle_name" type="text" class="form-control" id="fullName" value="{{ ($student->middle_name) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="fullName" value="{{ ($student->last_name) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Class</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="school_class_id" id="class" class="form-control @error('school_class_id') is-invalid @enderror" required>
                            <option value="" disabled selected></option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id', $student->school_class_id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('school_class_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Class Arm  </label>
                        <div class="col-md-8 col-lg-9">
                            <select name="class_arm_id" id="classarm" class="form-control @error('class_arm_id') is-invalid @enderror" required>
                                <option value="{{ $student->class_arm }}" selected>{{ $student->classArm->name }}</option>
                            </select>
                            @error('class_arm_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="gender" class="form-control">
                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date_of_birth" type="text" class="form-control" id="Job" value="{{ ($student->date_of_birth) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">State Of Origin</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state_of_origin" type="text" class="form-control" id="Country" value="{{ ($student->state_of_orign) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="{{ ($student->address) }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="{{ ($student->phone) }}">
                      </div>
                    </div>



                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>



              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

    @include('layouts.partials.class-arm')


@endsection
