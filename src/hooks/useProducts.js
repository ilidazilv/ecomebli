import {productsActions as actions} from "../redux/products/actions";
import {useDispatch, useSelector} from "react-redux";
import {baseUrl} from "../constants/baseUrl";


export const useProducts = () => {
    const selector = (state) => state.products;
    const products = useSelector(selector);
    const dispatch = useDispatch();
    const fetchProducts = () => {
        dispatch(actions.loadingProducts());
        fetch(baseUrl + '/api/database/products.php')
            .then(response => {
                    if(response.ok){
                        return response;
                    } else {
                        let error = new Error('Error ' + response.status + ': ' + response.statusText);
                        error.response = response;
                        throw error;
                    }
                },
                error => {
                    throw new Error(error.message);
                })
            .then(response => response.json())
            .then(response => dispatch(actions.saveProducts(response.map(item => ({
                    name: item.name,
                    price: item.price ? parseInt(item.price, 10) : undefined,
                    types: item.types,
                    currency: item.currency,
                    id: parseInt(item.product_id, 10),
            })))))
            .catch(e => dispatch(actions.failedProducts(new Error(e).message)))
    }
    return {
        products: products.products,
        fetchProducts,
        loading: products.isLoading,
        error: !Boolean(products.products) || !!products.error,
    };
}