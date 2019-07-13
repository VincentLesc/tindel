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
    },
    login(login, password) {
        return axios.post(
            '/api/security/login',
            {
                "security": {
                    "credentials": {
                        "login": login,
                        "password": password
                    }
                }
            }
        )
    }
}
