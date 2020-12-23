import React, { useEffect } from 'react';
import { getMonto } from '../services/MontoService'
import {postPago} from '../services/PagoService'

export default function useMonto() {


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

    //Proceed with payment
    let doSubmit = false;
    function getCardToken() {
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
            document.getElementById('paymentForm').action = `${API_URL}/pagos/finalizar_pago`;
            card.setAttribute('name', 'token');
            card.setAttribute('type', 'hidden');
            card.setAttribute('value', response.id);
            form.appendChild(card);
            doSubmit = true;
            const pago = {
                token: form.token.value,
                installments: parseInt(form.installments.value),
                transaction_amount: parseFloat(form.transactionAmount.value),
                description: "Point Mini a maquininha que dá o dinheiro de suas vendas na hora",
                payment_method_id: form.paymentMethodId.value,
                payer: {
                    email: form.email.value,
                    identification: {
                        number: parseInt(form.docNumber.value),
                        type: form.docType.value
                    }
                }
            }
            console.log(pago)
            postPago(pago)
                .then(function ({ result }) {
                    console.log(result)
                })
            //form.submit(); //Submit form data to your backend
        } else {
            alert("Verify filled data!\n" + JSON.stringify(response, null, 4));
        }
    };

    return {
        guessPaymentMethod,
        getCardToken
    }
}