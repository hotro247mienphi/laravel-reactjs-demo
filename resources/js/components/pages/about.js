import React from 'react';

const AboutPage = React.memo(() => {
    return <div>About Page</div>
});

AboutPage.breadcrumbs = [
    {label: 'Home'},
    {label: 'About'}
];

export default AboutPage;
