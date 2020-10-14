import React, { useState } from 'react';
import { Spinner } from 'react-bootstrap';
import { checkCode } from '../services/CodeService'

export default function CodeForm({ handleChangeMont }) {
    const [loading, setLoading] = useState(false)
    const [codeSuccess, setCodeSuccess] = useState(false)
    const [enterCode, setEnterCode] = useState(false)
    const [form, setForm] = useState({ codigo: '' })
    const [inputDisable, setInputDisable] = useState(false)
    const [stateInfo, setStateInfo] = useState('')
    const [stateColor, setStateColor] = useState('')

    const changeMonto = (value) => {
        handleChangeMont(value)
    }

    const validarCodigo = (code) => {
        const codeDate = new Date(code.fecha_expiracion.slice(0, 4), parseInt(code.fecha_expiracion.slice(5, 7)) - 1, code.fecha_expiracion.slice(8, 10))
        if (code.usado === 0 && new Date() <= codeDate) {
            setLoading(false)
            setEnterCode(true)
            setCodeSuccess(true)
            changeMonto(code.porcentaje_descuento)
            setInputDisable(true)
            setStateInfo('Código canjeado')
            setStateColor('#25A17E')
        } else if (code.usado != 0) {
            setLoading(false)
            setEnterCode(true)
            setCodeSuccess(false)
            setStateInfo('Código utilizado anteriormente')
            setStateColor('#dc3545')
        } else if (!(new Date() <= codeDate)) {
            setLoading(false)
            setEnterCode(true)
            setCodeSuccess(false)
            setStateInfo('Código vencido')
            setStateColor('#dc3545')
        }
    }

    const handleChange = e => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        })
        if (e.target.value.length >= 5) {
            setLoading(true)
            setEnterCode(true)
            checkCode(form)
                .then(function ({ code }) {
                    validarCodigo(code)
                })
                .catch(function ({ error }) {
                    setLoading(false)
                    setCodeSuccess(false)
                    setEnterCode(true)
                    setStateInfo('Error al verificar el código')
                    setStateColor('#dc3545')
                })
        } else {
            setLoading(false)
            setCodeSuccess(false)
            setEnterCode(false)
            setStateInfo('')
            setStateColor('')
        }
    }

    return (
        <>
            <form className="form-inline ">
                <label className="col-form-label text-md-left text-muted">Introducir código de descuento</label>
                <div className="input-group mb-8" >
                    <input className="form-control" type="text" name="codigo" value={form.codigo} placeholder="Codigo de descuento" style={
                        enterCode && codeSuccess && !loading
                            ?
                            { borderColor: "#28a745" }
                            :
                            enterCode && !codeSuccess && !loading
                                ?
                                { borderColor: "#dc3545" }
                                :
                                null}
                        onChange={handleChange}
                        disabled={inputDisable ? true : false} />
                    <div className="input-group-append" style={{ minWidth: '48px', alignText: 'center' }}>
                        <span className="input-group-text" style={
                            enterCode && codeSuccess && !loading
                                ?
                                { borderColor: "#28a745" }
                                :
                                enterCode && !codeSuccess && !loading
                                    ?
                                    { borderColor: "#dc3545" }
                                    :
                                    null}>
                            {loading
                                ?
                                (<Spinner animation="border" size="sm" />)
                                : !loading && enterCode && codeSuccess
                                    ? (<i className="fas fa-check" style={{ minWidth: '16px', maxWidth: '16px', alignText: 'center' }}></i>)
                                    : !loading && enterCode && !codeSuccess
                                        ? (<i className="fas fa-times" style={{ minWidth: '16px', maxWidth: '16px', alignText: 'center' }}></i>)
                                        :
                                        (<i className="fas fa-code" style={{ minWidth: '16px', maxWidth: '16px', alignText: 'center' }}></i>)}
                        </span>
                    </div>

                </div>
                <small className="form-text" style={{ color: stateColor }}>{stateInfo}</small>
            </form>
        </>

    )
}