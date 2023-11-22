import React, { Component } from 'react';
import Word from './Word';

class Game extends Component {

    render() {
        return <>
            <div className="container">
                <div className="text-center pt-5">
                    <h2>The Hangman Game</h2>
                    <Word />
                </div>
            </div>
        </>
    }
}

export default Game;