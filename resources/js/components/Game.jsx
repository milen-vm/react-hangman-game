import React, { Component } from 'react';
import Word from './Word';
import Letter from './Letter'
import Storage from '../utils/Storage';
import Record from '../utils/Record';

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
    // Save game history in local storage
    componentDidUpdate(prevProps, prevState) {
        if(this.state.win || (this.state.miss < 1)) {
            let date = new Date(),
                    dateTime = date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
// TODO refactor to save in sotorage some new class with game result and static properties of fields/colums title and dataidex
            let record = new Record(
                this.state.wordChars,
                this.state.userLeters,
                this.state.win,
                dateTime
            );
            console.log(record);
            Storage.addData('games', record.getData());
        }
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
                <h2>The Hangman Game</h2>
                <Word chars={ this.state.openChars }/>
                <Letter setLetter={ this.setNewMove } gameEnd={ this.state.win || (this.state.miss < 1) } />
                <p className="mt-4">Already selected letters: <strong>{ this.state.userLeters.join(', ') }</strong></p>
                <p className="mt-4">Remaining omissions: <strong>{ this.state.miss }</strong></p>
                { this.gameStatus() }
        </>
    }
}

export default Game;