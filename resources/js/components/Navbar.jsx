import { Component } from 'react';
import { Link } from 'react-router-dom';
import { Menu, Layout } from "antd";

const { Header } = Layout;

class Navbar extends Component {

    // render() {
    //     return(
    //         <nav className="navbar navbar-expand-lg navbar-light bg-light">
    //             <div className="container-fluid">
    //                 <a className="navbar-brand" href="/">Laravel</a>
    //                 <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    //                 <span className="navbar-toggler-icon"></span>
    //                 </button>
    //                 <div className="collapse navbar-collapse" id="navbarNav">
    //                     <ul className="navbar-nav">
    //                         <li className="nav-item">
    //                             <a className="nav-link active" aria-current="page" href="/game">Game</a>
    //                         </li>
    //                         <li className="nav-item">
    //                             <a className="nav-link" href="/game/history">History</a>
    //                         </li>
    //                     </ul>
    //                 </div>
    //             </div>
    //         </nav>
    //     )
    // }

    render() {
        return (
            <Header style={{ display: 'flex', alignItems: 'center' }}>
                <Menu
                    theme="dark"
                    mode="horizontal"
                    defaultSelectedKeys={[ window.location.pathname ]}
                    items={
                        new Array(
                            ['/', 'Laravel'],
                            ['/game', 'Game'],
                            ['/game/history', 'History'],
                            ['/binary', 'To Binary']
                        ).map((val, index) => {
                            return {
                                key: val[0],
                                label: <Link to={ val[0] }>{ val[1] }</Link>
                            }
                        })
                    }
                />
            </Header>
        )
    }
}

export default  Navbar;