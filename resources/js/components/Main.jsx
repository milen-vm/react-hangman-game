import { Component } from 'react';
import { Outlet } from "react-router-dom";
import Navbar from './Navbar';

class Main extends Component {

    render() {
        return <>
            <Navbar />
            <div className="container">
                <Outlet />
            </div>
        </>;
    }
}

export default Main;