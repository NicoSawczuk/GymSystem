import React from 'react';

export default function PriceBox({ monto }) {

    return (

        <div className="info-box bg-light" style={{borderRadius: '30px'}}>
            <div className="info-box-content">
                <span className="info-box-text text-center ">
                    <h4 style={{ 'color': '#25A17E' }}>
                        Plan básico
                    </h4>
                </span>
                <span className="info-box-number text-center mb-0 text-bold">
                    <p >
                        <span style={{ 'color': '#25A17E', fontSize: '30px' }}>${monto}</span>
                        <span style={{ 'color': '#34E3B1' }}> por mes</span>

                    </p>
                </span>
            </div>
        </div>
    )
}