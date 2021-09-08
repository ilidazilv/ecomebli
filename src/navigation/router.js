import {Route, Switch} from "react-router";
import {Homepage} from "../containers/pages/Homepage";
import {ProductsPage} from "../containers/pages/ProductsPage";
import {ProductDetailsPage} from "../containers/pages/ProductDetailsPage";

export const Router = () => {
    return(
        <Switch>
            <Route exact path='/' component={Homepage}/>
            <Route exact path='/products' component={ProductsPage}/>
            <Route exact path='/product/:id' component={ProductDetailsPage}/>
        </Switch>
    )
}