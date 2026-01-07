class DataTable {
    #table = {};

    constructor(elementId, route) {
        this.#setTable(elementId, route);
        this.#events();
    }

    #setTable(elementId) {
        let table = $(elementId),
            url = table.data('url');
        this.#table = table.DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false},
                {data: 'name', name: 'name'},
                {data: 'rel_path', name: 'rel_path'},
                {data: 'count', name: 'count'},
                {data: 'size', name: 'size', searchable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions', searchable: false}
            ],
            columnDefs: [
                {targets: 0, searchable: false, orderable: false},
                {targets: -1, searchable: false, orderable: false},
                {
                    targets: -2,
                    data: 'modifiedAt',
                    render: {
                        _: 'timestamp',
                        filter: 'display',
                        display: 'display'
                    }
                }
            ]
        });
    }

    getTable() {
        return this.#table;
    }

    #events() {
    }
}

export default DataTable;
