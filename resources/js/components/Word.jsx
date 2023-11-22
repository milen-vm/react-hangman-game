import React, { Component } from "react";

class Word extends Component {

    constructor(props) {
        super(props);

        this.state = {
            userLeters: [],
            chars: [],
            win: false,
            end: false
        }
    }

    componentDidMount() {
        fetch('/game/word')
            .then((res) => res.json())
            .then((data) => {
                console.log(data.chars);
                this.setState({ chars: data.chars });
            });
    }

    render() {
        return <>
            Word: { this.state.chars.join('') }
        </>
    }
}

export default Word;