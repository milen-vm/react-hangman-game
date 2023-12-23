class Record {

    #wordChars = [];

    #userLetters = [];

    #win;

    #dateTime;

    constructor(wordChars = [], userLetters = [], win = null, dateTime = null) {
        this.#wordChars = wordChars;
        this.#userLetters = userLetters;
        this.#win = win;
        this.#dateTime = dateTime;
    }

    get wordChars() {
        return this.#wordChars;
    }

    get userLetters() {
        return this.#userLetters
    }

    get win() {
        return this.#win;
    }

    get dateTime() {
        return this.#dateTime;
    }

    getData() {
        return {
            wordChars: this.#wordChars.join(''),
            userLetters: this.#userLetters.join(', '),
            win: this.#win,
            dateTime: this.#dateTime
        }
    }
}

export default Record;