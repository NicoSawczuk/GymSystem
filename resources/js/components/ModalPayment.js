import React, { useEffect } from 'react';
import { Modal, ModalBody, ModalFooter } from 'reactstrap';


import PaymentForm from './PaymentForm';

import useMercadoPago from '../hooks/useMercadoPago'

const user_prueba = '{"id":662275169,"nickname":"TETE7271386","password":"qatest969","site_status":"active","email":"test_user_14153567@testuser.com"}'
const user_prueba2 = '{"id":662287016,"nickname":"TT685497","password":"qatest1184","site_status":"active","email":"test_user_36638794@testuser.com"}' 

export default function ModalPayment({ modal, toggle, className, monto, code }) {

  const { guessPaymentMethod, getCardToken } = useMercadoPago()


  useEffect(() => {
    const timer = setTimeout(() => {
      //Guardo en el form el id del user
      const user_id_blade = document.getElementById('user_id_blade').value;
      let user_id = document.getElementById('user_id');

      //Obtenemos el id del usuario (del archivo .blade.php del pago) autenticado y lo guardamos en la variable user_id
      { user_id_blade ? user_id.setAttribute('value', user_id_blade) : null }

      //Agregamos el codigo de descuento que ingreso el usuario
      { code ? document.getElementById('discount_code').value = code : null }

      //Obtenemos la clave publica para MP y obtenemos los tipos de identificación para el formulario de MP
      window.Mercadopago.setPublishableKey(PUBLIC_KEY);
      window.Mercadopago.getIdentificationTypes();
    }, 50);
    return () => clearTimeout(timer);
  }, [toggle]);




  const handleChangeCardNumber = (event) => {
    guessPaymentMethod()
  }

  const handleSubmit = (event) => {
    event.preventDefault();
    getCardToken()
  }



  return (
    <div>
      <Modal isOpen={modal} toggle={toggle} className={className} style={{ maxWidth: '800px' }}>
        <ModalBody>
          <PaymentForm monto={monto} code={code} handleChangeCardNumber={handleChangeCardNumber} handleSubmit={handleSubmit} />
        </ModalBody>
        <ModalFooter>
          <button className="btn btn-secondary" onClick={toggle}>Cancelar</button>
        </ModalFooter>
      </Modal>
    </div>
  );
}

