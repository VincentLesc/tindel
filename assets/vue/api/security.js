import axios from 'axios';

export default {
    register(login, password) {
        return axios.post(
            '/api/users',
            {
                email: login,
                plainPassword: password
            }
        )
    }
}