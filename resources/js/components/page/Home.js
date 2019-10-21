import React, {Component} from 'react';

export default class Home extends Component {

    setPageTitle (title){
        document.title = title;
    }

    render() {
        this.setPageTitle('Home page');

        return (
            <div className="">
                <h1>Home page</h1>
            </div>
        );
    }
}
