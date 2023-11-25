import React, { Component } from 'react';
import Letter from './Letter';

class Word extends Component {

    constructor(props) {
        super(props);

        // this.state = {
        //     userLeters: [],
        //     chars: [],
        //     win: false,
        //     end: false
        // }
    }

    // componentDidMount() {
    //     fetch('/game/word')
    //         .then((res) => res.json())
    //         .then((data) => {
    //             this.setState({ chars: data.chars });
    //         });
    // }

    // componentDidUpdate(prevProps) {
    //     if(prevProps.newLetter !== this.props.newLetter) {


    //     }
    // }

    renderBoxes = () => {
        const boxes = this.props.chars.map((char, index) => {
            return <span key={ index } className="inline-block border border-danger bg-light p-1 letter ch-box">{ char }</span>   
        })

        return <div className="mt-4">
            { boxes }
        </div>
    }

    render() {
        return <>
            { this.renderBoxes() }
        </>
    }
}

export default Word;