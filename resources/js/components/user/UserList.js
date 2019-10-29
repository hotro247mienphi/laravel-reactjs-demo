import React, {Component} from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';

const instance = axios.create({
    baseURL: "/api",
    timeout: 1e4,
});

import {Spin} from 'antd';
import {Table, Button, Popconfirm, Modal} from 'antd';

const {confirm} = Modal;

const log = console.log;

export default class UserList extends Component {

    constructor(props) {
        super(props);

        this.state = {
            users: [],
            isLoading: true,
            tablePaginate: {
                current: 1,
                pageSize: 7,
            },
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
        const {history} = this.props;
        confirm({
            title: 'Do you want update these item?',
            content: 'when clicked the OK button, this dialog will be close',
            onOk() {
                log(history, id);
                history.push(`/users/${id}`);
            },
            onCancel(){
                log('your clicked to Cancel');
            }
        });
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

    generateColumns() {

        const {tablePaginate} = this.state;

        return [
            {
                title: '#',
                dataIndex: 'id',
                key: '#',
                render: (text, row, index) => ((tablePaginate.current - 1) * tablePaginate.pageSize) + index + 1
            }, {
                title: 'Name',
                dataIndex: 'name',
                key: 'name',
                render: (text, row) => <Link to={`/users/${row.id}`}>{text}</Link>
            }, {
                title: 'Email',
                dataIndex: 'email',
                key: 'email',
            }, {
                title: 'Created At',
                dataIndex: 'created_at',
                key: 'created_at',
            }, {
                title: 'Status',
                dataIndex: 'status',
                key: 'status',
                render: status => {
                    return (status === 1 ? 'Activate' : 'Deactivate');
                }
            }, {
                title: ' ',
                dataIndex: 'id',
                key: 'actions',
                className: 'text-right',
                style: {
                    textAlign: 'right'
                },
                render: (id) => {
                    return (
                        <div>
                            <Button type="dashed" onClick={() => this.handleClickEdit(id)}> Edit </Button>

                            <Popconfirm
                                title="Are you sure?"
                                onConfirm={() => this.handleClickDelete(id)}
                                onCancel={() => log('no no no')}
                                okText="Yes"
                                cancelText="No"
                            >
                                <Button type="danger"> Delete </Button>
                            </Popconfirm>
                        </div>
                    );
                }
            },
        ];
    };

    tablePageOnchange(pagination) {
        this.setState({
            tablePaginate: pagination
        })
    }

    render() {

        this.setPageTitle('Users List');

        const {users, isLoading, tablePaginate} = this.state;

        const data = users.map(item => {
            item.key = item.id;
            return item;
        });

        if (isLoading) {
            return (<div style={style.loading}><Spin size="large"/></div>);
        }

        const columns = this.generateColumns();

        const rowSelection = {
            onChange: (selectRowKeys, selectedRows) => {
                log(`select row keys: ${selectRowKeys}, select ${selectedRows.length} rows`);
            },
            getCheckboxProps: record => ({
                disabled: record.name === 'Meaghan Witting',
                name: record.name
            })
        };

        return (<Table
            rowSelection={rowSelection}
            columns={columns}
            dataSource={data}
            onChange={(pagination) => this.tablePageOnchange(pagination)}
            pagination={{pageSize: tablePaginate.pageSize}}
        />);
    }
}

const style = {
    loading: {
        position: 'fixed',
        top: '0',
        left: '0',
        bottom: '0',
        right: '0',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
        background: 'rgba(0,0,0,0.1)',
    }
};
