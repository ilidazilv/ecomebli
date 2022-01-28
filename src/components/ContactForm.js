import React, {useState} from 'react';
import { Formik, Form as FormikForm, Field } from 'formik';
import "../styles/form.scss";
import {useOrders} from "../hooks/useOrders";

export const ContactForm = ({
                                setStatus,
                                product_id,
                                product,
                                isHome,
                                price,
                                calc1Locale,
                                calc2Locale,
                                calc3Locale,
                                calc1,
                                calc2,
                                calc3,
                            }) => {
    const {saveOrder} = useOrders();
    const onSubmit = ({tel, fullName}) => {
        if(!isHome){
            saveOrder({
                tel: tel,
                name: fullName,
                product_id: product_id,
                product: product,
                price: price,
                calc1Locale: calc1Locale,
                calc1: calc1,
                calc2Locale: calc2Locale,
                calc2: calc2,
                calc3Locale: calc3Locale,
                calc3: calc3,
            }, setStatus);
        } else {
            saveOrder({ tel: tel, name: fullName }, setStatus);
        }
    }
    const initialValues = {tel: '', fullName: ''}
    return(
            <Formik initialValues={initialValues} onSubmit={onSubmit}>
                <FormikForm id="formEmail" className='w-100'>
                    <div>
                        <div className="input-wrapper">
                            <Field id="fullName" type="text" placeholder="Ім'я Прізвище" name="fullName"
                                   className={isHome ? 'name-input-home' : 'name-input'} required={true}/>
                        </div>
                        <div className="input-wrapper">
                            <Field id="tel" type="tel" placeholder="+(380) ___ ___ ___"
                                   className={isHome ? 'tel-input-home' : 'tel-input'} name="tel" required={true}/>
                        </div>
                    </div>
                    <div>
                        <button type="submit" className="submit-input">Залишити контакти</button>
                    </div>
                </FormikForm>
            </Formik>
    )
}
