import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import {Menu, Icon} from 'antd';
import 'antd/dist/antd.css';
const {SubMenu} = Menu;

export default class Nav extends Component {
    render() {
        return (

            <Menu mode="horizontal" theme="dark">
                <Menu.Item key="mail">
                    <Link to="/" className="nav-link"><Icon type="mail"/> Home</Link>
                </Menu.Item>

                <Menu.Item key="app">
                    <Link to="/users/" className="nav-link"><Icon type="appstore"/>Users</Link>
                </Menu.Item>

                <SubMenu title={<span className="submenu-title-wrapper"><Icon type="setting"/> Options</span>}>
                    <Menu.ItemGroup >
                        <Menu.Item key="setting:1">Option 2</Menu.Item>
                        <Menu.Item key="setting:2">Option 2</Menu.Item>
                    </Menu.ItemGroup>
                </SubMenu>

                <SubMenu title={<span className="submenu-title-wrapper"><Icon type="setting"/> Sub Title</span>}>
                    <Menu.ItemGroup title="Group 1">
                        <Menu.Item key="setting:3">Option 3</Menu.Item>
                        <Menu.Item key="setting:4">Option 4</Menu.Item>
                    </Menu.ItemGroup>
                </SubMenu>

            </Menu>

        );
    }
}
