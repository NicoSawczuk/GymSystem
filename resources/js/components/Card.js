import React, { useState, useEffect } from 'react';
import PriceBox from './PriceBox';
import CodeForm from './CodeForm';
import Loading from '../components/Loading'
import { getMonto } from '../services/MontoService'

export default function Card() {
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

    const handleChangeMont = (value) => {
        setMonto(monto - monto / parseInt(value))
    }

    return (
        <>
            {loading ? <Loading /> :
                <>
                    <div className="container-fluid">
                        <div className="mt-4 row justify-content-center">
                            <div className="col-md-4">

                                <div className="card card-teal card-outline" style={{borderRadius: '30px'}}>
                                    <div className="card-body">
                                        <div className="row">
                                            <div className="col-md-3"></div>
                                            <div className="col-md-6">
                                                <PriceBox monto={monto} />
                                            </div>
                                            <div className="col-md-3"></div>
                                        </div>
                                        <div className="row mt-2">
                                            <div className="col-md-3"></div>
                                            <div className="col-md-6">
                                                <CodeForm handleChangeMont={handleChangeMont} />
                                            </div>
                                            <div className="col-md-3"></div>
                                        </div>
                                        <div className="row mt-4">
                                            <div className="col-md-2"></div>
                                            <div className="col-md-8">
                                                <h5 className="text-left ml-4" style={{ 'color': '#25A17E' }}>Beneficios</h5>
                                                <center className="text-left">
                                                    <ul style={{ listStyle: 'none', fontSize: '18px', color: '#999' }} className="text-muted ">
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Administración de gimnasios</li>
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Administración de clientes</li>
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Administración de cuotas de clientes</li>
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Contacto con los clientes vía WhatsApp y correo</li>
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Reportes parametrizados para cada gimnasio</li>
                                                        <li style={{ padding: '6px 0px', color: '#999' }}><i className="fas fa-check" style={{ color: '#34E3B1' }}></i> Gráficos para cada gimnasio</li>
                                                    </ul>
                                                </center>
                                            </div>
                                            <div className="col-md-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </>
            }
        </>

    )
}