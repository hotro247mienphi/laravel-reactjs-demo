import React from 'react';

const HomePage = React.memo(() => {
    return <div>Home Page</div>
});

const OtherLayout = React.memo(({children, breadcrumbs = []}) => {
    return <div>
        Other layout
        <code>
            {breadcrumbs.map((v, i) => <span key={`br-${i}`}> {v.label} / </span>)}
        </code>
        {children}
    </div>
});

HomePage.layout = OtherLayout;

HomePage.breadcrumbs = [
    {label: 'Home page'},
    {label: 'Level 1'}
];

export default HomePage;
