@extends('manager.layout.app')
@section('title', trans('app.create') . ' ' . trans('app.task'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('app.create') }} {{ trans('app.task') }}</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('manager.task.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal" id="storeForm">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.employee') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select id="text-input" name="employee_id" value="{{ old('employee_id') }}"
                                    placeholder="{{ trans('app.employee') }}"
                                    class="form-control {{ getInputError('employee_id', $errors) != null ? 'is-invalid' : '' }}">

                                    @foreach ($employees as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == old('employee_id') ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.subject') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="subject" value="{{ old('subject') }}"
                                    placeholder="{{ trans('app.subject') }}"
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
                                    class="form-control {{ getInputError('description', $errors) != null ? 'is-invalid' : '' }}" rows="6">{!! old('description') !!}</textarea>
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
            $('#gpass').on('click', function() {
                var tag = $('input[name=password]');
                tag.val(generateComplexPassword(8));
            });
        });
    </script>
@endpush
