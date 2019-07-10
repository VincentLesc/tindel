import axios from 'axios';

export default {
    create (message) {
        return axios.post(
            '/api/posts',
            {
                message: message,
            }
        );
    },
    getAll () {
        return axios.get('/api/posts');
    },
}
