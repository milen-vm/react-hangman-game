import React, { Component, createRef } from 'react';

class Letter extends Component {

    leterRef = createRef();

    constructor(props) {
        super(props);

        this.state = {
            letter: ''
        };
    }

    addLetter = () => {
        let letter = this.leterRef.current.value;
        this.leterRef.current.focus();
        this.leterRef.current.value = '';
    }

    render() {
        return (
            <div className="row d-flex justify-content-center mt-4">
                <div className="col-auto">
                    <div className="">
                        <input ref={ this.leterRef } type="text" className="form-control" placeholder="Enter letter" />
                    </div>
                </div>

                <div className="col-auto">
                    <button onClick={ () => { this.addLetter() }} type="button" className="btn btn-secondary">Submit</button>
                </div>
            </div>
        );
    }
}

export default Letter;