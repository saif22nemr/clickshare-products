@extends('admin.layout.app')
@section('title', trans('app.create') . ' ' . trans('app.admin'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('app.create') }} {{ trans('app.admin') }}</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.admin.store') }}" method="post" enctype="multipart/form-data"
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

                    </form>
                </div>
                <div class="card-footer">
                    <button type="submit" form="storeForm" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> {{trans('app.submit')}}
                    </button>
                    <button type="reset" form="storeForm" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i> {{trans('app.reset')}}
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
