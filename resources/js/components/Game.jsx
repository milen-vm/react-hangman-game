import React, { Component } from 'react';
import Word from './Word';
import Letter from './Letter'

class Game extends Component {

    render() {
        return <>
            <div className="container">
                <div className="text-center pt-5">
                    <h2>The Hangman Game</h2>
                    <Word />
                    <Letter />
                </div>
            </div>
        </>
    }
}

export default Game;