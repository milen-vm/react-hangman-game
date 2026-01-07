@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-5 text-center">Galleries list</h1>

    <div class="table-responsive">
        <table id="galleryTable" class="table table-hover data-table" data-url="{{ route('gallery.list') }}">
            <thead class="gall">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Count</th>
                    <th>Size</th>
                    <th>Modified</th>
                    <th>Actions</th>
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
        // let url = $('#galleryTable').data('url');
        // const galleryTable = new DataTable('.data-table', url);
    });
</script>
@endsection