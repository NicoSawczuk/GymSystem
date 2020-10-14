import React, { useEffect } from 'react';
import { Button, Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap';
import logo from '../static/images/logo.png'

export default function ModalPayment({ modal, toggle, className, monto }) {


  useEffect(() => {
    const timer = setTimeout(() => {
      window.Mercadopago.setPublishableKey("TEST-68ad2718-9f77-4a1e-939e-167517b30160");
      window.Mercadopago.getIdentificationTypes();
    }, 50);
    return () => clearTimeout(timer);
  }, [toggle]);

  //Funciones
  function guessPaymentMethod() {

    let cardnumber = document.getElementById("cardNumber").value;
    if (cardnumber.length >= 6) {
      let bin = cardnumber.substring(0, 6);
      window.Mercadopago.getPaymentMethod({
        "bin": bin
      }, setPaymentMethod);
    }
  };

  function setPaymentMethod(status, response) {
    if (status == 200) {
      let paymentMethod = response[0];

      document.getElementById('paymentMethodId').value = paymentMethod.id;
      document.getElementById('cardNumber').style.backgroundImage = 'url(' + paymentMethod.thumbnail + ')';

      if (paymentMethod.additional_info_needed.includes("issuer_id")) {
        getIssuers(paymentMethod.id);

      } else {
        document.getElementById('issuerInput').classList.add("hidden");

        getInstallments(
          paymentMethod.id,
          document.getElementById('amount').value
        );
      }

    } else {
      alert(`payment method info error: ${response}`);
    }
  }

  function getIssuers(paymentMethodId) {
    window.Mercadopago.getIssuers(
      paymentMethodId,
      setIssuers
    );
  }

  function setIssuers(status, response) {
    if (status == 200) {
      let issuerSelect = document.getElementById('issuer');

      response.forEach(issuer => {
        let opt = document.createElement('option');
        opt.text = issuer.name;
        opt.value = issuer.id;
        issuerSelect.appendChild(opt);
      });

      if (issuerSelect.options.length <= 1) {
        document.getElementById('issuerInput').classList.add("hidden");
      } else {
        document.getElementById('issuerInput').classList.remove("hidden");
      }

      getInstallments(
        document.getElementById('paymentMethodId').value,
        document.getElementById('amount').value,
        issuerSelect.value
      );

    } else {
      alert(`issuers method info error: ${response}`);
    }
  }

  function getInstallments(paymentMethodId, amount, issuerId) {
    window.Mercadopago.getInstallments({
      "payment_method_id": paymentMethodId,
      "amount": parseFloat(amount),
      "issuer_id": issuerId ? parseInt(issuerId) : undefined
    }, setInstallments);
  }

  function setInstallments(status, response) {
    if (status == 200) {
      document.getElementById('installments').options.length = 0;
      response[0].payer_costs.forEach(payerCost => {
        let opt = document.createElement('option');
        opt.text = payerCost.recommended_message;
        opt.value = payerCost.installments;
        document.getElementById('installments').appendChild(opt);
      });
    } else {
      alert(`installments method info error: ${response}`);
    }
  }

  //Update offered installments when issuer changes
  function updateInstallmentsForIssuer(event) {
    window.Mercadopago.getInstallments({
      "payment_method_id": document.getElementById('paymentMethodId').value,
      "amount": parseFloat(document.getElementById('amount').value),
      "issuer_id": parseInt(document.getElementById('issuer').value)
    }, setInstallments);
  }

  //Proceed with payment
  function getCardToken() {
    doSubmit = false;
    if (!doSubmit) {
      let $form = document.getElementById('paymentForm');
      window.Mercadopago.createToken($form, setCardTokenAndPay);

      return false;
    }
  };

  function setCardTokenAndPay(status, response) {
    if (status == 200 || status == 201) {
      let form = document.getElementById('paymentForm');
      let card = document.createElement('input');
      card.setAttribute('name', 'token');
      card.setAttribute('type', 'hidden');
      card.setAttribute('value', response.id);
      form.appendChild(card);
      doSubmit = true;
      form.submit(); //Submit form data to your backend
    } else {
      alert("Verify filled data!\n" + JSON.stringify(response, null, 4));
    }
  };





  const handleChangeCardNumber = (event) => {
    guessPaymentMethod()
  }

  const handleSubmit = (event) => {
    getCardToken()
  }



  return (
    <div>
      <Modal isOpen={modal} toggle={toggle} className={className} style={{ maxWidth: '800px' }}>
        <ModalBody>
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
                  <form action="/process_payment" method="post" id="paymentForm" onSubmit={handleSubmit}>
                    <h3 className="title">Detalles del cliente</h3>
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
                        <input type="hidden" name="transactionAmount" id="amount" value="10" />
                        <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
                        <input type="hidden" name="description" id="description" />
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
        </ModalBody>
        <ModalFooter>
          <button className="btn btn-secondary" onClick={toggle}>Cancelar</button>
        </ModalFooter>
      </Modal>
    </div>
  );
}

