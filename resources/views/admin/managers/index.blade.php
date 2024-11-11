@extends('admin.layout.app')
@section('title', trans('app.manager'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/datatables.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="buttons">
                <a href="{{ route('admin.manager.create') }}" class="btn btn-primary">{{ trans('app.create') }}
                    {{ trans('app.manager') }}</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong> {{ trans('app.managers') }}</strong>
                </div>
                <div class="card-body card-block">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped  " id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('app.image') }}</th>
                                    <th>{{ trans('app.full_name') }}</th>
                                    <th>{{ trans('app.email') }}</th>
                                    <th>{{ trans('app.departments') }}</th>
                                    <th>{{ trans('app.employee_count') }}</th>
                                    {{-- <th>{{ trans('app.salary') }}</th> --}}
                                    <th>{{ trans('app.created_at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($managers as $index => $emp)
                                    <tr class="tr-shadow" id="row-{{ $emp->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if (!empty($emp->image))
                                                <div class="image-preview">
                                                    <img src="{{ asset($emp->image_path) }}" alt="">
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $emp->name }}</td>
                                        <td>
                                            <span class="block-email">{{ $emp->email }}</span>
                                        </td>


                                        <td>
                                            @foreach ($emp->departments as $item)
                                                <span class="badge badge-primary">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$emp->employees_count}}</td>
                                        {{-- <td>${{ $emp->salary }}</td> --}}
                                        <td>{{ date('Y-m-d h:i A', strtotime($emp->created_at)) }}</td>

                                        <td>
                                            <div class="table-data-feature">
                                                <a class="item" href="{{ route('admin.manager.login', $emp->id) }}"
                                                    target="_blank"
                                                    data-toggle="tooltip" data-placement="top" title="Login as manager">
                                                    <i class="zmdi zmdi-lock-open"></i>
                                                </a>
                                                <a class="item" href="{{ route('admin.manager.edit', $emp->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item delete-item" data-toggle="tooltip" data-placement="top"
                                                    data-url="{{ route('admin.manager.destroy', $emp->id) }}"
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
            table.on('draw', function () {
    console.log('Redraw occurred at: ' + new Date().getTime());
});
            $('table').on('click', '.delete-item', function() {
                var tag = $(this);
                var row = $(this).closest('tr');
                deleteItem(row, table, tag.data('url'));
            });
        });
    </script>
@endpush
