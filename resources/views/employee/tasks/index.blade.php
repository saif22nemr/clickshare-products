@extends('employee.layout.app')
@section('title', trans('app.task'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/datatables.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="buttons">
                
            </div>
            <div class="card">
                <div class="card-header">
                    <strong> {{ trans('app.tasks') }}</strong>
                </div>
                <div class="card-body card-block">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped  " id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('app.subject') }}</th>
                                    <th style="min-width: 180px">{{ trans('app.status') }}</th>
                                    <th>{{ trans('app.description') }}</th>
                                    <th>{{ trans('app.created_at') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($tasks as $index => $emp)
                                    <tr class="tr-shadow" id="row-{{ $emp->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $emp->subject }}</td>
                                        <td>

                                            <select name="status" class="form-control task-status"
                                                data-id="{{ $emp->id }}" data-oldStatus="{{ $emp->status }}">
                                                <option value="new" {{ $emp->status == 'new' ? 'selected' : '' }}>
                                                    {{ trans('app.new') }}</option>
                                                <option value="in_progress"
                                                    {{ $emp->status == 'in_progress' ? 'selected' : '' }}>
                                                    {{ trans('app.in_progress') }}</option>
                                                <option value="complete"
                                                    {{ $emp->status == 'complete' ? 'selected' : '' }}>
                                                    {{ trans('app.complete') }}</option>
                                                <option value="canceled"
                                                    {{ $emp->status == 'canceled' ? 'selected' : '' }}>
                                                    {{ trans('app.canceled') }}</option>
                                            </select>
                                        </td>


                                        <td>
                                            {!! $emp->description !!}
                                        </td>
                                        <td>{{ date('Y-m-d h:i A', strtotime($emp->created_at)) }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a class="item" href="{{ route('employee.task.edit', $emp->id) }}"
                                                    data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <button class="item delete-item" data-toggle="tooltip" data-placement="top"
                                                    data-url="{{ route('employee.task.destroy', $emp->id) }}"
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
            $('table').on('change', '.task-status', function() {
                var tag = $(this);
                $.ajax({
                    url: "{{ route('employee.task.updateStatus') }}",
                    method: "POST",
                    headers: {
                        Accept: 'application/json'
                    },
                    data: {
                        _token: csrfToken,
                        task_id: tag.data('id'),
                        status: tag.val(),
                    },
                    success: function(json) {
                        if (json.status == true) {
                            toastr.success(json.message);
                            tag.data('oldStatus', tag.val());
                        } else {
                            toastr.error(json.message);
                            tag.val(tag.data('oldStatus'));
                        }

                    },
                    error: function(xhr) {

                        var json = xhr.responseJSON;
                        tag.val(tag.data('oldStatus'));
                        if (json.message) {
                            toastr.error(json.message);
                        } else {
                            toastr.error('Fail to update status');
                        }
                    }
                });
            });
        });
    </script>
@endpush
