@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Student Search List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Students</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Student List</h5>

                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Reg Number</th>
                        <th>Class</th>
                        <th>Class Arm</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="class-arms-body">
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->getFullNameAttribute() }}</td>
                            <td>{{ $student->admission_number }}</td>
                            <td>{{ $student->schoolClass->name }}</td>
                            <td>{{ $student->classArm->name }}</td>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm text-light">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>




@endsection
