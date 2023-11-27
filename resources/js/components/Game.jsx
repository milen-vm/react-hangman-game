import React, { Component } from 'react';
import Word from './Word';
import Letter from './Letter'

class Game extends Component {

    constructor(props) {
        super(props);

        this.state = {
            letter: '',
            moves: 10,
            win: false,
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

    setNewMove = (lt) => {
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
            let state = { serLeters: prevState.userLeters }

            if(indexs.length > 0) {
                indexs.forEach((i) => {
                    prevState.openChars[i] = prevState.wordChars[i];
                });
                
                state.openChars = prevState.openChars;
            } else {
                state.moves = --prevState.moves;
                // TODO: count down wrong moves
            }
            
            return state;
        });


    }

    render() {
        return <>
            <div className="container">
                <div className="text-center2 pt-5">
                    <h2>The Hangman Game</h2>
                    <Word chars={ this.state.openChars }/>
                    <Letter setLetter={ this.setNewMove } gameEnd={ this.state.win || (this.state.moves < 1) } />
                    <p className="mt-4">Already selected letters: <strong>{ this.state.userLeters.join(', ') }</strong></p>
                    <p className="mt-4">Remaining moves: <strong>{ this.state.moves }</strong></p>
                </div>
            </div>
        </>
    }
}

export default Game;