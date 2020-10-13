import React from 'react';
import { Spinner } from 'react-bootstrap';

export default function Loading () {
    return (
        <div style={{position: "absolute", top: "50%", left: "50%"}}>
            <Spinner animation="grow" variant="success" />
        </div>
    )
}

