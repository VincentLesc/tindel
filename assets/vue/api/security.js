import axios from 'axios';

export default {
    register(login, password) {
        return axios.post(
            '/api/security/register',
            {
                email: login,
                plainPassword: password
            }
        )
    }
}
