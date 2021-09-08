import {Col, Row} from "reactstrap";
import {FaDatabase} from "react-icons/all";

export const NotFoundData = () => {
    return(
        <Row>
            <Col className='d-flex w-100 justify-content-center align-items-center'>
                <div className='d-flex flex-column text-center m-5 font-weight-bold not-found-data'>
                    <FaDatabase className='align-self-center'/>
                    <span className='p-3'>Данные не найдено</span>
                </div>
            </Col>
        </Row>
    )
}