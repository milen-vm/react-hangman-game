class Storage {

    static setData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
    }

    static addData(key, data) {
        let items = JSON.parse(localStorage.getItem(key));
        if (items === null) {
            localStorage.setItem(key, JSON.stringify([data]));
        } else if (Array.isArray(items)) {
            items.push(data);
            localStorage.setItem(key, JSON.stringify(items));
        } else {
            console.error('Invalid data.');
        }
    }

    static getData(key) {
        return JSON.parse(localStorage.getItem(key));
    }

    static removeData(key) {
        localStorage.removeItem(key);
    }
}

export default Storage;