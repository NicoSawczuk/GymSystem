import React from 'react';
import logo from '../static/images/logo.png'

export default function PaymentForm({ monto, code, handleChangeCardNumber, handleSubmit }) {


    return (
        <>
            <section className="payment-form dark">
                <div className="container_payment">
                    <div className="block-heading">
                        <h2>Realizar Pago</h2>
                        <p>Pago realizado a través de MercadoPago</p>
                    </div>
                    <div className="form-payment">
                        <div className="products">
                            <h2 className="title">Total del pago <span className="float-right">${monto}</span></h2>
                        </div>
                        <div className="payment-details">
                            <form method="post" id="paymentForm" onSubmit={handleSubmit}>
                                <h3 className="title">Detalles del cliente</h3>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="email">E-Mail</label>
                                        <input id="email" name="email" type="email" class="form-control" />
                                    </div>
                                </div>
                                <div className="row">
                                    <div className="form-group col-sm-5">
                                        <label for="docType">Tipo de documento</label>
                                        <select id="docType" name="docType" className="form-control" data-checkout="docType" type="text"></select>
                                    </div>
                                    <div className="form-group col-sm-7">
                                        <label for="docNumber">Número de documento</label>
                                        <input id="docNumber" name="docNumber" data-checkout="docNumber" type="text" className="form-control" />
                                    </div>
                                </div>
                                <br></br>
                                <h3 className="title">Detalles de la tarjeta</h3>
                                <div className="row">
                                    <div className="form-group col-sm-8">
                                        <label for="cardholderName">Titular de la tarjeta</label>
                                        <input id="cardholderName" data-checkout="cardholderName" type="text" className="form-control" />
                                    </div>
                                    <div className="form-group col-sm-4">
                                        <label for="">Fecha de vencimiento</label>
                                        <div className="input-group expiration-date">
                                            <input type="text" className="form-control" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
                                                onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" />
                                            <span className="date-separator">/</span>
                                            <input type="text" className="form-control" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
                                                onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div className="form-group col-sm-8">
                                        <label for="cardNumber">Número de la tarjeta</label>
                                        <input onChange={handleChangeCardNumber} type="text" className="form-control input-background" id="cardNumber" data-checkout="cardNumber"
                                            onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" />
                                    </div>
                                    <div className="form-group col-sm-4">
                                        <label for="securityCode">Código de seguridad</label>
                                        <input id="securityCode" data-checkout="securityCode" type="text" className="form-control"
                                            onselectstart="return false" onpaste="return false" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete="off" />
                                    </div>
                                    <div id="issuerInput" className="form-group col-sm-12 hidden">
                                        <label for="issuer">Banco emisor</label>
                                        <select id="issuer" name="issuer" data-checkout="issuer" className="form-control"></select>
                                    </div>
                                    <div className="form-group col-sm-12" style={{ display: 'none' }}>
                                        <label for="installments">Cuotas</label>
                                        <select type="text" id="installments" name="installments" className="form-control"></select>
                                    </div>
                                    <div className="form-group col-sm-12">
                                        <input type="hidden" name="user_id" id="user_id" />
                                        <input type="hidden" name="transactionAmount" id="amount" value="10" />
                                        <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                                        <input type="hidden" name="discount_code" id="discount_code" value={code} />
                                        <button type="submit" className="btn btn-primary btn-block">Finalizar pago</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <footer >
                <div className="footer_logo"><img id="horizontal_logo" src={logo}></img></div>
            </footer>
        </>
    )
}