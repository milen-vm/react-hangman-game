import { Component } from 'react';
import withRouter from './withRouter';
import Word from './Word';

import Storage from '../utils/Storage';

import LettersList from './LettersList';

class Review extends Component {
    
    constructor(props) {
        super(props);

        this.state = {
            openChars: [],
            userLetters: [],
            win: null
        };
    }

    componentDidMount() {
        let id = this.props.params.id,
            game = Storage.getData('games')[id];

        this.setState({
            openChars: game.openChars,
            userLetters: game.userLetters,
            win: game.win
        });
    }

    render() {
        return <>
            <h2>The Hangman Game - history game review</h2>
            <Word chars={ this.state.openChars }/>
            <p className="mt-4">Already selected letters: <strong>{ <LettersList list={ this.state.userLetters } /> }</strong></p>
        </>;
    }
}

export default withRouter(Review);