
import axios from 'axios'

export async function getMonto(){
    //const res = await axios.get(`${API_URL}/wallet`);
    const res = await axios({
        method: 'get',
        url: `${API_URL}/pagos/monto`,
      })
    return {
        monto: res.data[0]['monto']
    }
}