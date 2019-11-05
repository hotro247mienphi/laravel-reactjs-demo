import React from 'react';
import Navigator from "../navigator";

const HomePage = React.memo(() => {
    return <div>Home Page</div>
});

const OtherLayout = React.memo(({children, breadcrumbs = []}) => {
    return <div>

        <Navigator/>

        <hr/>
        Other layout: <code>{breadcrumbs.map((v, i) => <span key={`br-${i}`}> {v.label} / </span>)}</code>
        <hr/>

        {children}

    </div>
});

HomePage.layout = OtherLayout;

HomePage.breadcrumbs = [
    {label: 'Home page'},
    {label: 'Level 1'}
];

export default HomePage;
