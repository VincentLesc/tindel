import axios from 'axios';

export default {
    create (message) {
        return axios.post(
            '/api/profiles',
            {
                message: message,
            }
        );
    },
    getAll () {
        return axios.get('/api/profiles');
    },
}
