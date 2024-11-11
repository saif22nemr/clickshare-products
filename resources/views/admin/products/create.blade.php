@extends('admin.layout.app')
@section('title', trans('app.create') . ' ' . trans('app.product'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{ trans('app.create') }} {{ trans('app.product') }}</strong>
                </div>
                <div class="card-body card-block">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data"
                        class="form-horizontal" id="storeForm">
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.name') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name" value="{{ old('name') }}"
                                    placeholder="{{ trans('app.name') }}"
                                    class="form-control {{ getInputError('name', $errors) != null ? 'is-invalid' : '' }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.quantity') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="quantity" value="{{ old('quantity') }}"
                                    placeholder="{{ trans('app.quantity') }}"
                                    class="form-control {{ getInputError('quantity', $errors) != null ? 'is-invalid' : '' }}">
                                @error('quantity')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">{{ trans('app.description') }}</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea type="text" id="text-input" name="description"
                                    placeholder="{{ trans('app.description') }}"
                                    class="form-control {{ getInputError('description', $errors) != null ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
                                @error('description')
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
