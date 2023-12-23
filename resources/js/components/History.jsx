import { Component } from 'react';
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
        let data = Storage.getData('games');
        console.log(data);
// TODO get saved games from storage in type some class with game result and static prop of fields/colums title and dataidex
        this.state = {
            data: []
        };
    }

    // componentWillMount() {

    // }

    render() {
        return <>
            <h1>Game History</h1>
            <Table dataSource={ this.state.data } columns={ columns }/>
        </>
    }
}

export default History;