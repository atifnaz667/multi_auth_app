@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Course') }}</div>

                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert" id="dismiss">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('course.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" class="form-control " id="title" name="title" value="{{ old('title') }}" required minlength="5" />
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea class="form-control " id="description" name="description" rows="4" >{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Add Course') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
