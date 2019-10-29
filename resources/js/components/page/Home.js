import React, {Component} from 'react';
import {DatePicker} from 'antd';

export default class Home extends Component {

    setPageTitle (title){
        document.title = title;
    }

    render() {
        this.setPageTitle('Home page');

        return (
            <div className="">
                <h1>Home page</h1>
                <DatePicker/>
            </div>
        );
    }
}
