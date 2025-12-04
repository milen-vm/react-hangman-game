import { Component } from 'react';
import { Link } from 'react-router-dom';
import { Table } from 'antd';

import Storage from '../utils/Storage';

import LettersList from './LettersList';

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

        this.clear = this.clear.bind(this);
    }

    componentDidMount() {
        let data = Storage.getData('games') || [];
        console.log(data);
        data.forEach((element, index) => {
            element.action = <Link title='Show game' to={'/game/review/' + index }>Review</Link>;
            element.key = index;
            element.wordChars = element.wordChars.join('');
            element.userLetters = <LettersList list={ element.userLetters } />;

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

    clear() {
        Storage.removeData('games');
        this.setState({ data: [] });
    }

    render() {
        return <>
            <h1 className='d-inline-block' >Game History</h1>
            <Link className='float-end' 
                  title='Clear history' 
                  onClick={ this.clear } 
            >
                clear history
            </Link>
            <Table dataSource={ this.state.data } columns={ columns }/>
        </>
    }
}

export default History;