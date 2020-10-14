import { API_URL } from './settings'
import axios from 'axios'


export async function checkCode(form){
    //const res = await axios.get(`${API_URL}/wallet`);
    const res = await axios({
        method: 'get',
        url: `${API_URL}/codigos/check`,
        params: {
            codigo: form.codigo
          }
      })
    if (res.data != 0){
        return{
            code: res.data
        }
    }else{
        throw new Error(msg);
    }
}