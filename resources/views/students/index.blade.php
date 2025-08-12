@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Staff</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Staff</li>
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
              <h5 class="card-title">Staff List</h5>

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($staffMembers as $staff)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $staff->name }}</td>
                        <td>{{ ucwords($staff->role) }}</td>
                        <td>
                            <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('staff.updateStatus', $staff->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ $staff->status === 'active' ? 'btn-warning' : 'btn-success' }}">
                                    {{ $staff->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($staffMembers->isEmpty())
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
