import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom';
import Loading from '../components/Loading'
import Card from '../components/Card'
import {getMonto} from '../services/MontoService'

export default function RealizarPago(){
    const [monto, setMonto] = useState(0);
    const [descuento, setDescuento] = useState('');
    const [loading, setLoading] = useState(true)


    useEffect(function(){
        getMonto()
            .then(function({monto}){
                console.log(monto)
                setMonto(monto)
                setLoading(false)
            })
            .catch(function(error){
                console.log(error)
            })

    }, [])

    return (
        <>
            {loading ? <Loading /> :
                <>
                    <Card monto={monto}/>
                </>
            }
        </>
    )
    
}

if (document.getElementById('root')) {

    ReactDOM.render(<RealizarPago />, document.getElementById('root'));
}