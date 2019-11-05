import React from 'react'
import {Link} from 'react-router-dom';

export const Navigator = () => {
    return <div>
        <Link to="/">Home</Link> --- &nbsp;
        <Link to="/about">About</Link>
    </div>
};

export default Navigator;
