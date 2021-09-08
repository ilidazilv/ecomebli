import {combineReducers} from "redux";
import {productsReducer as products} from "../products/reducer";

export const rootReducer = combineReducers({
    products
})
