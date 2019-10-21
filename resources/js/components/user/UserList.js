import React, {Component} from 'react';
import axios from 'axios';
import {Link} from "react-router-dom";

const instance = axios.create({
    baseURL: "/api",
    timeout: 1e4,
});

const log = console.log;

export default class UserList extends Component {
    constructor(props) {
        super(props);

        this.state = {
            users: [],
            isLoading: true,
            errors: []
        };

        this.handleClickEdit = this.handleClickEdit.bind(this);
        this.handleClickDelete = this.handleClickDelete.bind(this);
    }

    getUserList() {
        instance.get('/users').then(result => result.data)
            .then(({data}) => {
                this.setState({
                    users: data.data,
                    isLoading: false
                });
            }).catch(({response}) => {

            const {errors} = response.data;

            if (errors) {
                const err = [];
                for (let key in errors) {
                    err.push(errors[key].join(''));
                }
                this.setState({errors: err});
            }

        });
    }

    handleClickEdit(id) {
        this.props.history.push(`/users/${id}`);
    }

    handleClickDelete(id) {
        instance.delete(`/users/${id}`)
            .then(result => result.data)
            .then(res => {
                this.setState({
                    isLoading: true
                }, this.getUserList);
            })
            .catch(exception => {
                log(exception);
            })
    }

    setPageTitle(title) {
        document.title = title;
    }

    UNSAFE_componentWillMount() {
        this.getUserList();
    }

    render() {
        const {users, isLoading} = this.state;

        const tbodyData = users.map(item => {
            return (
                <tr key={`ukey-${item.id}`}>
                    <td>{item.id}</td>
                    <td>
                        <Link to={`/users/${item.id}`}>{item.name}</Link>
                    </td>
                    <td>{item.email}</td>
                    <td>
                        <button className="btn btn-warning btn-sm" onClick={() => this.handleClickEdit(item.id)}>Edit
                        </button>
                        <button className="btn btn-danger btn-sm ml-1"
                                onClick={() => this.handleClickDelete(item.id)}>Delete
                        </button>
                    </td>
                </tr>
            );
        });

        if (isLoading) {
            return (
                <h1>Loading...</h1>
            );
        }

        this.setPageTitle('Users List');
        return (
            <div className="">
                <table className="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>{tbodyData}</tbody>
                </table>
            </div>
        );
    }
}
