class Image {
    constructor() {
        this.#addEvents();
    }

    #addEvents() {
        this.#leftImageChange();
        this.#rightImageChange();
    }

    #leftImageChange() {
        const leftBtn = document.getElementById('left-btn');
        if(!leftBtn) {
            return;
        }
        
        document.addEventListener('keydown', (e) => {
            if(e.key !== 'ArrowRight') {
                return;
            }

            leftBtn.click();
        });
    }

    #rightImageChange() {
        const rightBtn = document.getElementById('right-btn');
        if(!rightBtn) {
            return;
        }
        
        document.addEventListener('keydown', (e) => {
            if(e.key !== 'ArrowLeft') {
                return;
            }

            rightBtn.click();
        });
    }
}

export default Image;