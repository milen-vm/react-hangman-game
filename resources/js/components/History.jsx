import { Component } from 'react';
import { Table } from 'antd';

const columns = [
    {
        title: 'Word to guess',
        dataIndex: 'wordToGuess',
        key: 'wordToGuess'
    },
    {
        title: 'Selected letters',
        dataIndex: 'sectedLetters',
        key: 'sectedLetters'
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
// TODO get saved games from storage in type some class with game result and static prop of fields/colums title and dataidex
        // this.state = {
        //     data: 
        // }
    }

    // componentWillMount() {

    // }

    render() {
        return <>
            <h1>Game History</h1>
            <Table dataSource={ [] } columns={ columns }/>
        </>
    }
}

export default History;