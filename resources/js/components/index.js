import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Link, Route} from 'react-router-dom';
import route from "../route/route";
import Nav from "./partial/Nav";

export default class Index extends Component {

    render() {

        return (
            <BrowserRouter>

                <Nav/>

                {route.map((rt, index) => <Route {...rt} key={`rt-${index}`}/>)}

            </BrowserRouter>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Index/>, document.getElementById('example'));
}
