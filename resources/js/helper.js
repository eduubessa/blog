import CryptoJS from 'crypto-js'
import Base64 from 'crypto-js/enc-base64'

export function data_decrypt(data)
{
    let key = import.meta.env.
        data = JSON.parse(Base64.decode(data))

    let decrypted = CryptoJS.AES.decrypt(data, key, {
        iv: data.iv
    });

    console.log(decrypted.toString(CryptoJS.enc.Utf8));
}
