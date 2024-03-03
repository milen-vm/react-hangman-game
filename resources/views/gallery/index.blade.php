@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-5 text-center">Galleries list</h1>

    <div class="table-responsive">
        <table class="table table-hover data-table">
            <thead class="gall">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Count</th>
                    <th>Size</th>
                    <th>Modified At</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        let table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            // responsive: true,
            ajax: "{{ route('gallery.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'rel_path', name: 'rel_path'},
                {data: 'count', name: 'count'},
                {data: 'size', name: 'size'},
                {data: 'created_at', name: 'created_at'}
            ],
            columnDefs: [
                {targets: 0, searchable: false, orderable: false},
                {
                    targets: -1,
                    data: 'modifiedAt',
                    render: {
                        _: 'timestamp',
                        filter: 'display',
                        display: 'display'
                    }
                }
            ]
        });
    });
</script>
@endsection