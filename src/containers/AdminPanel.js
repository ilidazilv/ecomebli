import React from "react";
import {StyledTable} from "../components/Table";
import {useOrders} from "../hooks/useOrders";

const columns = {
    order_num: {
        name: 'Номер замовлення',
        data: 'order_id'
    },
    order_items: {
        name: 'Замовлення',
        data: 'order_item_name'
    },
    name: {
        name: 'Ім\'я',
        data: 'name'
    },
    email: {
        name: 'Пошта',
        data: 'email'
    },
    tel: {
        name: 'Номер телефону',
        data: 'tel'
    },
    date: {
        name: 'Дата замовлення',
        data: 'date'
    }
}

export const AdminPanel = () => {
    const {orders, fetchOrders} = useOrders();
    React.useEffect(() => {
        fetchOrders()
    }, [])
    return <StyledTable head={columns} rows={orders}/>
}
