import React, { Component } from 'react';
import Letter from './Letter';

class Word extends Component {

    constructor(props) {
        super(props);

        this.state = {
            userLeters: ['p', 'j'],
            chars: [],
            win: false,
            end: false
        }
    }

    componentDidMount() {
        fetch('/game/word')
            .then((res) => res.json())
            .then((data) => {
                this.setState({ chars: data.chars });
            });
    }

    renderBoxes = () => {
        let chars = this.state.chars;
        let userLeters = this.state.userLeters;

        const boxes = chars.map((char, index) => {
            let ch = userLeters.includes(char) ? char : <>&nbsp;&nbsp;</>;

            return <span key={ index } className="inline-block border border-danger bg-light p-1 letter ch-box">{ ch }</span>   
        })

        return <div className="mt-4">
            { boxes }
        </div>
    }

    render() {
        return <>
            Word: { this.state.chars.join('') }
            { this.renderBoxes() }
        </>
    }
}

export default Word;