@extends('manager.layout.app')
@section('title', trans('app.department'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/datatables.min.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    <strong> {{ trans('app.departments') }}</strong>
                </div>
                <div class="card-body card-block">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped  " id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>{{ trans('app.name') }}</th>
                                    <th>{{ trans('app.employee_count') }}</th>
                                    <th>{{ trans('app.employee_salary') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($departments as $index => $emp)
                                    <tr class="tr-shadow" id="row-{{ $emp->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $emp->name }}</td>
                                        <td>{{$emp->employees_count}}</td>
                                        <td>${{$emp->employees()->where('manager_id' , auth('manager')->Id())->sum('salary') ?? 0}}</td>

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
