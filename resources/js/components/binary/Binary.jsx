import React, { Component, createRef } from 'react';

class Binary extends Component {

    decimalRef = createRef();

    constructor(props) {
        super(props);
        this.state = {
            binary: null
        }
    }

    getBinary = (e) => {
        const floor = Math.floor;
        let decimal = floor(e.target.value),
            binary = '';

        while(true) {
            let quotient = floor(decimal / 2),
                remainder = decimal % 2;

            binary = `${remainder}${binary}`;
            decimal = quotient;

            if(decimal === 0) {
                break;
            }
        }

        this.setState({binary: binary});;
    }

    render() {
        return <>
            <h2>Convert decimal to binary</h2>
            <div className="row mt-4">
                <div className="col-auto">
                    <input 
                        ref={ this.decimalRef }
                        type="text" 
                        className="form-control" 
                        placeholder="Enter decimal number" 
                        onChange={ this.getBinary }
                    />
                    <p className="mt-4">Binary: <strong>{ this.state.binary }</strong></p>
                </div>
            </div>
        </>;
    }
}

export default Binary;