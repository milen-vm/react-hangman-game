class DataTable {
    #dataTable = {};

    constructor(elementId) {
        this.#init(elementId);
        this.#events();
    }

    #init(elementId) {
        alert(elementId);
    }

    #events() {
    }
}

export default DataTable;
