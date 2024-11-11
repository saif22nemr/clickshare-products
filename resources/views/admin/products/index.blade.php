@extends('admin.layout.app')
@section('title', trans('app.product'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/datatables.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="buttons">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">{{ trans('app.create') }}
                    {{ trans('app.product') }}</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong> {{ trans('app.products') }}</strong>
                </div>
                <div class="card-body card-block">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped  " id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>{{ trans('app.name') }}</th>
                                    <th>{{ trans('app.description') }}</th>
                                    <th>{{ trans('app.quantity') }}</th>
                                    <th>{{ trans('app.created_by') }}</th>
                                    <th>{{ trans('app.created_at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $index => $emp)
                                    <tr class="tr-shadow" id="row-{{ $emp->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $emp->name }}</td>
                                        <td>{{$emp->description}}</td>
                                        <td>{{$emp->quantity}}</td>
                                        <td>{{@$emp->user->name}}</td>
                                        <td>{{ date('Y-m-d h:i A', strtotime($emp->created_at)) }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a class="item" href="{{ route('admin.product.edit', $emp->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item delete-item" data-toggle="tooltip" data-placement="top"
                                                    data-url="{{ route('admin.product.destroy', $emp->id) }}"
                                                    data-row="#row-{{ $emp->id }}" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/datatable/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            var table = $('#datatable').DataTable();
            $('table').on('click', '.delete-item', function() {
                var tag = $(this);
                var row = $(this).closest('tr');
                deleteItem(row, table, tag.data('url'));
            });
        });
    </script>
@endpush
