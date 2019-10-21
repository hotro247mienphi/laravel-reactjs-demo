import React, {Component} from 'react';
import axios from 'axios';

const instance = axios.create({
    baseURL: "/api",
    timeout: 1e4,
});

export default class UserEdit extends Component {
    constructor(props) {
        super(props);

        this.state = {
            user: null,
            name: '',
            email: '',
            isLoading: true,
        };

        this.uid = this.props.match.params.id;
        this.changeValue = this.changeValue.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
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
                    this.props.history.push(`/users`);
                } else {
                    console.log(data);
                }
            })
            .catch(exception => {
                console.log(exception);
            });
    }

    UNSAFE_componentWillMount() {
        this.getUser(this.uid);
    }

    setPageTitle (title){
        document.title = title;
    }

    render() {
        const {user, isLoading, name, email} = this.state;

        if (isLoading) {
            return (
                <h1>Loading...</h1>
            );
        }

        this.setPageTitle(name);

        return (
            <div className="">

                <h1>{user.name}</h1>

                <div className="form-group">
                    <label>Name</label>
                    <input
                        type="text"
                        name="name"
                        value={name}
                        onChange={(e) => this.changeValue(e)}
                        className="form-control"
                        placeholder="Enter Name"
                    />
                </div>

                <div className="form-group">
                    <label>Email address</label>
                    <input
                        type="email"
                        name="email"
                        value={email}
                        onChange={(e) => this.changeValue(e)}
                        className="form-control"
                        placeholder="Enter email"
                    />
                </div>

                <button
                    type="button"
                    className="btn btn-primary"
                    onClick={() => this.handleSubmit()}
                > Submit
                </button>

            </div>
        );
    }
}
