import React from 'react';
import { Spinner } from 'react-bootstrap';

export default function Card({monto}) {
    
    return (
        <div className="container-fluid">
            <div className=" mt-4 row justify-content-center">
                <div className="col-md-7">

                    <div className="card card-teal card-outline">
                        <div className="card-body">
                            <center>
                                ${monto}
                            </center>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}