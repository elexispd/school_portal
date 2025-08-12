@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Sessions</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Session</li>
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
              <h5 class="card-title">Session List</h5>

              <table class="table datatable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $session)
                    <tr>
                        <td>{{ $session->id }}</td>
                        <td>{{ $session->name }}</td>
                        <td>{{ $session->code }}</td>
                        <td>
                            <a href="{{ route('sessions.edit', $session->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('sessions.updateStatus', $session->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm {{ $session->status === 'active' ? 'btn-warning' : 'btn-success' }}">
                                    {{ $session->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($sessions->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">No Sessions found.</td>
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
