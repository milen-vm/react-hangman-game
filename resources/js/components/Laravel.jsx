import { Component } from 'react';

class Laravel extends Component {

    constructor(props) {
        super(props);

        this.state = {
            htmlContent: '5'
        };
    }

    // componentWillMount() {

    // }

    render() {
        return <>{ this.state.htmlContent }</>;
    }
}

export default Laravel;