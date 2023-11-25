import React, { Component } from 'react';
import Word from './Word';
import Letter from './Letter'

class Game extends Component {

    constructor(props) {
        super(props);

        this.state = {
            letter: '',
            userLeters: [],
            wordChars: [],
            openChars: []
        };
    }

    componentDidMount() {
        fetch('/game/word')
            .then((res) => res.json())
            .then((data) => {
                this.setState({ wordChars: data.chars });

                let length = data.chars.length,
                    open = Array(length).fill(<>&nbsp;&nbsp;</>);

                this.setState({ openChars: open });
                
            });
    }

    setNewLetter = (lt) => {
        let indexs = [],
            letter = lt.toLowerCase(),
            wordChars = this.state.wordChars;

        wordChars.forEach((val, i) => {
            if(val.toLowerCase() === letter) {
                indexs.push(i);
            }
        });

        this.setState((prevState) => {
            prevState.userLeters.push(lt);
            let state = { userLeters: prevState.userLeters }

            if(indexs.length > 0) {
                // TODO
                prevState.openChars[index] = prevState.wordChars[index];
                state.openChars = prevState.openChars;
            }
            
            return state;
        });


    }

    render() {
        return <>
            <div className="container">
                <div className="text-center pt-5">
                    <h2>The Hangman Game</h2>
                    <Word chars={ this.state.openChars }/>
                    <Letter setLetter={ this.setNewLetter } />
                </div>
            </div>
        </>
    }
}

export default Game;