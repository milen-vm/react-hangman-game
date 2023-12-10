import { Component } from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

import Main from './Main';
import Laravel from './Laravel';
import Game from './Game';
import History from './History';

class Router extends Component {

    render() {
        return (
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Main />}>
                        <Route index element={ <Laravel /> } />
                        <Route path="/game" element={ <Game />} />
                        <Route path="/game/history" element={ <History /> } />
                    </Route>
                </Routes>
            </BrowserRouter>
        )
    }
}

export default Router;