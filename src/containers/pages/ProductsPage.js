import {Container, Row} from "reactstrap";
import {Product} from "../../components/Product";
import {useProducts} from "../../hooks/useProducts";
import {productsImages} from "../../constants/productsImages";

export const ProductsPage = () => {
    const {products, loading, error} = useProducts();
    return(
        <Container>
            <Row className='justify-content-center'>
                {!loading && !error && products.map((item, key) => {
                    return(
                        <Product
                            key={key}
                            types={item.types}
                            id={item.id}
                            currency={item.currency}
                            name={item.name}
                            price={item.price}
                            img={productsImages
                                    .find((item) =>
                                        item.id === parseInt(item.id, 10)
                                    ).img}
                        />
                    )
                })}
            </Row>
        </Container>
    )
}