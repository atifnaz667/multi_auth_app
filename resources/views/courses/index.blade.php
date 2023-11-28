@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Courses') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert" id="dismiss">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ ucFirst($course->title) }}</td>
                                    <td>{{ ucFirst($course->description) }}</td>
                                    <td>
                                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                            <a href="#" class="btn btn-info edit-btn" data-course-id="{{ $course->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                                            <form action="{{ route('course.destroy', $course->id) }}" method="POST" style="display: inline-block ">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content p-2">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm" action=" {{ route('course.update') }} " method="post">
                                        @csrf
                                        @method('PATCH')

                                        <div class="mb-3">
                                            <label for="editTitle" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="editTitle" name="title" required minlength="5">
                                        </div>

                                        <div class="mb-3">
                                            <label for="editDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="editDescription" name="description" rows="4" required></textarea>
                                        </div>
                                        <input type="hidden" name="id" id="updateCourse">
                                        <button type="submit" class="btn btn-primary">Update Course</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.edit-btn').click(function () {
                var courseId = $(this).data('course-id');
                $.ajax({
                    url: '/courses/' + courseId + '/edit',
                    method: 'GET',
                    success: function (data) {
                        $('#editTitle').val(data.title);
                        $('#editDescription').val(data.description);
                        $('#updateCourse').val(data.id);
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
