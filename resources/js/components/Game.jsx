import React, { Component } from 'react';
import Word from './Word';
import Letter from './Letter'

class Game extends Component {

    constructor(props) {
        super(props);

        this.state = {
            miss: 10,
            win: false,
            userLeters: [],
            wordChars: [],
            openChars: []
        };
    }

    componentDidMount() {
        this.loadWord();
    }

    loadWord = () => {
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
            let state = { userLeters: prevState.userLeters }

            if(indexs.length > 0) {
                indexs.forEach((i) => {
                    prevState.openChars[i] = prevState.wordChars[i];
                });
                
                state.openChars = prevState.openChars;
                let isWin = wordChars.every(
                    (val, index) => val === state.openChars[index]
                );

                if(isWin) {
                    state.win = true;
                }
            } else {
                state.miss = --prevState.miss;
            }
            
            return state;
        });
    }
    // TODO save game result in history
    newGame = () => {
        this.setState({
            miss: 10,
            win: false,
            userLeters: []
        });

        this.loadWord();
    }

    gameStatus = () => {
        let button = <button className="btn btn-success" onClick={ this.newGame }>Try new one!</button>;
        if(this.state.miss < 1) {
            return <p className="mt-4">You failed to guess the word. { button }</p>;
        }

        if(this.state.win) {
            return <p className="mt-4">Congratulations! You guessed the word! { button }</p>
        }

        return <p className="mt-4">Suggest a new letter!</p>
    }

    render() {
        return <>
            <div className="container">
                <div className="text-center2 pt-5">
                    <h2>The Hangman Game</h2>
                    <Word chars={ this.state.openChars }/>
                    <Letter setLetter={ this.setNewMove } gameEnd={ this.state.win || (this.state.miss < 1) } />
                    <p className="mt-4">Already selected letters: <strong>{ this.state.userLeters.join(', ') }</strong></p>
                    <p className="mt-4">Remaining omissions: <strong>{ this.state.miss }</strong></p>
                    { this.gameStatus() }
                </div>
            </div>
        </>
    }
}

export default Game;