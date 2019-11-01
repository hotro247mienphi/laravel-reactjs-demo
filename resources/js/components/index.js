import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import RootRouter from "./routes";

const App = React.memo(() => {
    return <div>
        <RootRouter/>
    </div>
});

if (document.getElementById('example')) {
    ReactDOM.render(<App/>, document.getElementById('example'));
}
