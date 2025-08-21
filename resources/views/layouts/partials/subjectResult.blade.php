

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Admission No</th>
                                <th>CA</th>
                                <th>Exam</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->student->getFullNameAttribute() }}</td>
                                <td>{{ $result->student->admission_number }}</td>
                                <td>{{ $result->ca }}</td>
                                <td>{{ $result->exam }}</td>
                                <td>{{ $result->total }}</td>
                                <td>
                                    <a href="{{ route('results.edit', $result->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger delete-result" data-id="{{ $result->id }}">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).on('click', '.delete-result', function(e) {
        e.preventDefault();

        // Show a confirmation dialog before deletion
        if (confirm("Are you sure you want to delete this result?")) {
            var resultId = $(this).data('id');  // Get the result ID from the button
            var row = $(this).closest('tr');    // Get the row to remove after deletion

            // Send AJAX request to delete the result
            $.ajax({
                url: '/results/' + resultId,  // URL to the delete route
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',  // CSRF Token
                },
                success: function(response) {
                    // On success, remove the row from the DOM
                    row.fadeOut(500, function() {
                        $(this).remove();  // Remove the row from the table
                    });
                    alert("Result deleted successfully!");
                },
                error: function(xhr, status, error) {
                    alert("An error occurred. Please try again.");
                }
            });
        }
    });

</script>

