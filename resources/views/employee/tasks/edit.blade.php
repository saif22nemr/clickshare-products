@extends('employee.layout.app')
@section('title', trans('app.edit') . ' ' . trans('app.task'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('app.edit') }} {{ trans('app.task') }}</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('employee.task.update', $task->id) }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal" id="storeForm">
                        @csrf
                        @method('PUT')

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.subject') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="subject"
                                    value="{{ old('subject', $task->subject) }}" placeholder="{{ trans('app.subject') }}"
                                    class="form-control {{ getInputError('subject', $errors) != null ? 'is-invalid' : '' }}">
                                @error('subject')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.description') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea type="text" name="description" placeholder="{{ trans('app.description') }}"
                                    class="form-control {{ getInputError('description', $errors) != null ? 'is-invalid' : '' }}" rows="6">{!! old('description', $task->description) !!}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="storeForm" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button type="reset" form="storeForm" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> Reset
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {

        });
    </script>
@endpush
