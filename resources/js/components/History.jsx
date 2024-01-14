import { Component } from 'react';
import { Link } from 'react-router-dom';
import { Table } from 'antd';

import Storage from '../utils/Storage';

const columns = [
    {
        title: 'Word to guess',
        dataIndex: 'wordChars',
        key: 'wordChars'
    },
    {
        title: 'Selected letters',
        dataIndex: 'userLetters',
        key: 'userLetters'
    },
    {
        title: 'Win',
        dataIndex: 'win',
        key: 'win'
    },
    {
        title: 'Date time',
        dataIndex: 'dateTime',
        key: 'dateTime'
    },
    {
        title: 'Action',
        dataIndex: 'action',
        key: 'action'
    },
];

class History extends Component {

    constructor(props) {
        super(props);

        this.state = {
            data: []
        };
    }

    componentDidMount() {
        let data = Storage.getData('games');
        data.forEach((element, index) => {
            element.action = <Link title='Show game' to={'/game/review/' + index }>Review</Link>;
            element.key = index;

            let win = '';
            if (element.win) {
                win = <span className='text-success'>Yes</span>;
            } else {
                win = <span className='text-danger'>No</span>;
            }

            element.win = win;
        });

        this.setState({ data: data });
    }

    render() {
        return <>
            <h1>Game History</h1>
            <Table dataSource={ this.state.data } columns={ columns }/>
        </>
    }
}

export default History;