@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Class Arm</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Class Arm,</li>
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
              <h5 class="card-title">Class Arm List</h5>

                <x-alerts />
                <div>
                    <select name="class" id="classm" class="form-control mb-3">
                        <option value="" disabled selected>Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Class</th>
                        <th>Class Arm</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="class-arms-body">
                        <tr>
                            <td colspan="4" class="text-center">Select a class to view arms</td>
                        </tr>
                    </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#classm').on('change', function() {
            var classId = $(this).val();

            if (classId) {
                $.get("{{ url('/classarms/by-class') }}/" + classId, function(data) {
                    var rows = '';

                    if (data.length > 0) {
                        $.each(data, function(index, arm) {
                            let toggleText = arm.status === 'active' ? 'Deactivate' : 'Activate';
                            let toggleClass = arm.status === 'active' ? 'btn-danger' : 'btn-success';

                            rows += `
                                <tr>
                                    <td>${arm.id} </td>
                                    <td>${$('#classm option:selected').text()}</td>
                                    <td>${arm.name}</td>
                                    <td>
                                        <a href="{{ url('/class_arm') }}/${arm.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                                        <form method="POST" action="{{ url('/classarms') }}/${arm.id}/status" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm ${toggleClass}">${toggleText}</button>
                                        </form>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        rows = `<tr><td colspan="4" class="text-center">No class arms found</td></tr>`;
                    }

                    $('#class-arms-body').html(rows);
                });
            }
        });
    });
    </script>



@endsection
