import React, { Component } from "react";

class Game extends Component {

    render() {
        console.log('game');
        return <>
            <div className="container">
                <div className="text-center pt-5">
                    <h2>The Hangman Game</h2>
                </div>
            </div>
        </>
    }
}

export default Game;