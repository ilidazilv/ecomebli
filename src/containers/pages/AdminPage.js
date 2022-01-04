import React from "react";
import {LoginForm} from "../../components/LoginForm";
import {useCookies} from "react-cookie";
import {AdminPanel} from "../AdminPanel";

export const AdminPage = () => {
    const [cookies, setCookies] = useCookies(['login']);
    return(
        <div className='form-wrapper-admin'>
            {
                !cookies.login && <LoginForm setCookies={setCookies}/>
            }
            {
                cookies.login && <AdminPanel/>
            }
        </div>
    )
}
