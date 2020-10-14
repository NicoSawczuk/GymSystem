import React, { useState, useEffect, useCallback } from 'react';
import { getMonto } from '../services/MontoService'

export default function useMonto(){
    const [loading, setLoading] = useState(true)
    const [monto, setMonto] = useState(0);

    useEffect(function () {
        getMonto()
            .then(function ({ monto }) {
                setMonto(monto) 
                setLoading(false)
            })
            .catch(function (error) {
                console.log(error)
            })

    }, [])

    const updateMonto = useCallback(function(value) {
        setMonto(monto - monto / parseInt(value))
    })

    return {
        loading,
        monto,
        updateMonto
    }
}