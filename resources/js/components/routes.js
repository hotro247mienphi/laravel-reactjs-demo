import React from 'react'
import {HashRouter as Router, Switch, Route} from 'react-router-dom';
import config from "./config";
import Navigator from "./navigator";

const Layout = React.memo(({children, breadcrumbs = []}) => {
    return <div>

        <Navigator/>

        <hr/>
        Default layout: <code>{breadcrumbs.map((v, i) => <span key={`br-${i}`}> {v.label} / </span>)}</code>
        <hr/>

        <div> {children} </div>
    </div>
});

const CustomRouter = ({component: Component, ...props}) => {

    const {layout: MainLayout = Layout, breadcrumbs} = Component;

    return <Route {...props} render={({...rest}) => {

        return <MainLayout breadcrumbs={breadcrumbs}>

            <Component {...rest} />

        </MainLayout>

    }}/>
};

export const RootRouter = () => {
    return <Router>
        <Switch>
            {config.map((cf, i) => <CustomRouter {...cf} key={`cf-${i}`}/>)}
        </Switch>
    </Router>
};

export default RootRouter;
