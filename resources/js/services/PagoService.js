
import axios from 'axios'


export async function postPago(pago) {
    const res = await axios({
        method: 'post',
        url: `https://api.mercadopago.com/v1/payments`,
        headers:{
            'Authorization': `Bearer ${PUBLIC_KEY}`,
        },
        data:pago
    });
    return {
        result: res,
    }
}   