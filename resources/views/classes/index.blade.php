@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Classes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Class</li>
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
              <h5 class="card-title">Class List</h5>

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->code }}</td>
                        <td>{{ $class->category }}</td>
                        <td>
                            <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('classes.updateStatus', $class->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ $class->status === 'active' ? 'btn-warning' : 'btn-success' }}">
                                    {{ $class->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($classes->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No classes found.</td>
                    </tr>
                    @endif
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
