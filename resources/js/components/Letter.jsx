import React, { Component, createRef } from 'react';

class Letter extends Component {

    leterRef = createRef();

    constructor(props) {
        super(props);

        this.state = {
            btnDisabled: true
        };
    }

    componentDidMount() {
        this.leterRef.current.focus();
    }

    addLetter = () => {
        let letter = this.leterRef.current.value;
        this.leterRef.current.focus();
        this.leterRef.current.value = '';

        this.props.setLetter(letter);
        this.toggleButton();
    }

    toggleButton = () => {
        let value =  this.props.gameEnd || (this.leterRef.current.value.replace(/\s/g, '') === '');
        this.setState({ btnDisabled: value });
    }

    render() {
        return (
            <div className="row mt-4">
                <div className="col-auto">
                    <div className="">
                        <input 
                            ref={ this.leterRef }
                            type="text" 
                            className="form-control" 
                            placeholder="Enter letter" 
                            onChange={ this.toggleButton }
                        />
                    </div>
                </div>

                <div className="col-auto">
                    <button 
                        onClick={ () => { this.addLetter() }} 
                        type="button" 
                        className="btn btn-secondary"
                        disabled={ this.state.btnDisabled }
                    >
                        Submit
                    </button>
                </div>
            </div>
        );
    }
}

export default Letter;