import { Component } from 'react';
import withRouter from './withRouter';

import Storage from '../utils/Storage';

class Review extends Component {

    componentDidMount() {
        let id = this.props.params.id,
            game = Storage.getData('games')[id];

        console.log(game);

    }

    render() {
        return <>Hi { this.props.params.id }</>;
    }
}

export default withRouter(Review);