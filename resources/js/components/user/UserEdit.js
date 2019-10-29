import React, {Component} from 'react';
import axios from 'axios';

const instance = axios.create({
    baseURL: "/api",
    timeout: 1e4,
});

import {Row, Col, Alert} from 'antd';
import {Form, Icon, Input, Button} from 'antd';

const log = console.log;

export default class UserEdit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            user: null,
            name: '',
            email: '',
            isLoading: true,
            errors: []
        };

        this.uid = this.props.match.params.id;
        this.changeValue = this.changeValue.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getErrorRequest(exception){
        const errors = exception.response.data.errors;
        const err = [];
        for(let key in errors){
            err.push(errors[key][0]);
        }
        return err;
    }

    getUser(id) {
        instance.get(`/users/${id}`)
            .then(result => result.data)
            .then(({success, data}) => {

                if(success){
                    this.setState({
                        user: data,
                        email: data.email,
                        name: data.name,
                        isLoading: false
                    });
                } else {
                    alert(data);
                }

            })
            .catch(exception => {
                console.log(exception);
            });
    }

    changeValue(e) {
        const target = e.target;
        this.setState({[target.name]: target.value});
    }

    handleSubmit() {
        const {name, email, user} = this.state;

        instance.put(`/users/${user.id}`, {name, email})
            .then(result => result.data)
            .then(({success, data}) => {
                if (success) {
                    this.props.history.goBack();
                } else {
                    console.log(data);
                }
            })
            .catch(exception => {
                const response = exception.response;
                log(response);

                if(response){
                    this.setState({
                        errors: this.getErrorRequest(exception)
                    });
                } else {
                    this.setState({
                        errors: ['Loi roi']
                    })
                }
            });
    }

    UNSAFE_componentWillMount() {
        this.getUser(this.uid);
    }

    setPageTitle (title){
        document.title = title;
    }

    render() {

        const {user, isLoading, name, email, errors} = this.state;

        if (isLoading) {
            return (
                <h1>Loading...</h1>
            );
        }

        let htmlError = '';
        if(errors.length){
            htmlError = <Alert message={<ul>{errors.map(item => <li>{item}</li>)}</ul>} type="error"/>
        }

        this.setPageTitle(name);

        return (
            <div className="">

                <Row type="flex" justify="center">

                    <Col span={12}>

                        <h1>{user.name}</h1>

                        {htmlError}

                        <Form layout="horizontal">

                            <Form.Item>
                                <Input
                                    prefix={<Icon type="user"/>}
                                    name="name"
                                    value={name}
                                    onChange={(e) => this.changeValue(e)}
                                    type="text"
                                    placeholder="Username"/>
                            </Form.Item>

                            <Form.Item>
                                <Input
                                    prefix={<Icon type="mail"/>}
                                    type="email"
                                    name="email"
                                    value={email}
                                    onChange={(e) => this.changeValue(e)}
                                    placeholder="email"/>
                            </Form.Item>

                            <Form.Item>
                                <Button
                                    type="primary"
                                    onClick={() => this.handleSubmit()}
                                    disabled={false}>
                                    Submit data
                                </Button>

                                <Button
                                    type="dashed"
                                    onClick={() => this.props.history.goBack()}
                                    disabled={false}>
                                    Back to list
                                </Button>
                            </Form.Item>

                        </Form>

                    </Col>

                </Row>

            </div>
        );
    }
}
