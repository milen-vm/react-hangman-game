import React, { Component } from 'react';

class Binary extends Component {

    constructor(props) {
        super(props);
        this.state = {
            binary: null,
            decimal: null
        }
    }

    getBinary = (e) => {
        const floor = Math.floor;
        let str = e.target.value.trim();

        if(str === '') {
            this.setState({binary: null});

            return;
        }

        let decimal = floor(str),
            binary = '';

        if(isNaN(decimal)) {
            this.setState({binary: <span className="text-danger">Invalid integer!</span>});

            return;
        }

        do {
            let quotient = floor(decimal / 2),
                remainder = decimal % 2;

            binary = `${remainder}${binary}`;
            decimal = quotient;
        }
        while(decimal > 0);

        this.setState({binary: binary});;
    }

    getDecimal = (e) => {
        let binary = e.target.value.trim();

        if(binary === '') {
            this.setState({decimal: null});

            return;
        }

        let decimal = null;
        for(let i = 0, p = binary.length - 1; i < binary.length, p >= 0; i++, p--) {
            let bit = parseInt(binary[i], 2);

            if(isNaN(bit)) {
                this.setState({decimal: <span className="text-danger">Invalid binary!</span>});

                return;
            }

            decimal += bit * Math.pow(2, p);
        }

        this.setState({decimal: decimal});
    }

    render() {
        return <>
            <div className="row mt-4">
                <div className="col-auto">
                    <h2>Decimal to binary</h2>
                    <input 
                        type="text" 
                        className="form-control" 
                        placeholder="Enter decimal number" 
                        onChange={ this.getBinary }
                    />
                    <p className="mt-4">Binary: <strong>{ this.state.binary }</strong></p>
                </div>
                <div className="col-auto">
                    <h2>Binary to decimal</h2>
                    <input
                        type="text" 
                        className="form-control" 
                        placeholder="Enter binary number" 
                        onChange={ this.getDecimal }
                    />
                    <p className="mt-4">Decimal: <strong className="text-danger">{ this.state.decimal }</strong></p>
                </div>
            </div>
        </>;
    }
}

export default Binary;