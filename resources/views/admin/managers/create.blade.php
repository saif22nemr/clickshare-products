@extends('admin.layout.app')
@section('title', trans('app.create') . ' ' . trans('app.manager'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('app.create') }} {{ trans('app.manager') }}</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.manager.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal" id="storeForm">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.first_name') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="first_name" value="{{ old('first_name') }}"
                                    placeholder="{{ trans('app.first_name') }}"
                                    class="form-control {{ getInputError('first_name', $errors) != null ? 'is-invalid' : '' }}">
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.last_name') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="last_name" value="{{ old('last_name') }}"
                                    placeholder="{{ trans('app.last_name') }}"
                                    class="form-control {{ getInputError('last_name', $errors) != null ? 'is-invalid' : '' }}">
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.email') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="email" value="{{ old('email') }}"
                                    placeholder="{{ trans('app.email') }}"
                                    class="form-control {{ getInputError('email', $errors) != null ? 'is-invalid' : '' }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.salary') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="salary" value="{{ old('salary') }}"
                                    placeholder="{{ trans('app.salary') }}"
                                    class="form-control {{ getInputError('salary', $errors) != null ? 'is-invalid' : '' }}">
                                @error('salary')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">{{ trans('app.departments') }}</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check-inline form-check">
                                    @php
                                        $selectedDepartments =
                                            (!empty(old('departments')) and is_array(old('departments')))
                                                ? old('departments')
                                                : [];
                                    @endphp
                                    @foreach ($departments as $dep)
                                        <label for="inline-checkbox{{ $dep->id }}" class="form-check-label ">
                                            <input type="checkbox" id="inline-checkbox{{ $dep->id }}"
                                                name="departments[]" value="{{ $dep->id }}" class="form-check-input"
                                                {{ in_array($dep->id, $selectedDepartments) ? 'checked' : '' }}>
                                            {{ $dep->name }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('departments')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                @error('departments.*')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.password') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="password" value="{{ old('password') }}"
                                    placeholder="{{ trans('app.password') }}"
                                    class="form-control {{ getInputError('password', $errors) != null ? 'is-invalid' : '' }}">
                                <small class="form-text text-muted mb-3">{{ trans('app.password_hint') }} <span class="a-herf"
                                         id="gpass">{{ trans('app.generage_password') }}</span></small>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.image') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="" name="image"
                                    placeholder="{{ trans('app.image') }}"
                                    class="form-control {{ getInputError('image', $errors) != null ? 'is-invalid' : '' }}" accept="image/*">
                                @error('image')
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
            $('#gpass').on('click' , function(){
                var tag = $('input[name=password]');
                tag.val(generateComplexPassword(8));
            });
        });
    </script>
@endpush
