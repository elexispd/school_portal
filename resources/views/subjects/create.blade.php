@extends('layouts.portal')

@section('content')

<div class="pagetitle">
      <h1>Subject</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Subject</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->
    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Subject</h5>


              <form class="row g-3" method="POST" action="{{ route('subjects.store') }}" >
                @csrf
                <x-alerts />
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="inputNanme4">
                </div>

                <div class="col-12">
                  <label for="inputNanme5" class="form-label">Code</label>
                  <input type="text" name="code" class="form-control" id="inputNanme5">
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Create</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

@endsection
