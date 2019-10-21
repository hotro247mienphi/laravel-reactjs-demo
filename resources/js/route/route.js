import Home from "../components/page/Home";
import UserList from "../components/user/UserList";
import UserEdit from "../components/user/UserEdit";

export default [
    {
        path: '/',
        component: Home,
        exact: true,
    },
    {
        path: '/users',
        component: UserList,
        exact: true,
    },
    {
        path: '/users/:id([0-9]+)',
        component: UserEdit,
        exact: false,
    }
];
