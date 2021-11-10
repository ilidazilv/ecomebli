import React from "react";
import {Table} from "reactstrap";

export const StyledTable = ({head, rows}) => {
    return(
        <>
            <Table>
                <thead>
                <tr>
                    {
                        Object.keys(head).map((item, key) => <th key={key}>{head[item].name}</th>)
                    }
                </tr>
                </thead>
                <tbody>
                {
                    rows && rows.map(item => {
                        return (
                            <tr>
                                {Object.keys(head).map((name, key) => <th key={key}>{item[head[name].data] || '-'}</th>)}
                            </tr>
                        )
                    })
                }
                </tbody>
            </Table>
        </>
    )
};
