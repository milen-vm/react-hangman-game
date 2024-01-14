import { Component } from 'react';
import withRouter from './withRouter';

class Review extends Component {

    render() {
        return <>Hi { this.props.params.id }</>;
    }
}

export default withRouter(Review);