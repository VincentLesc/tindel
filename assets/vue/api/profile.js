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
    fetchUserConnectedProfile () {
        return axios.get('/api/user/profile')
    },
    updateUserConnectedProfile(payload) {
        return axios.post(
            '/api/user/profile/update',
            {
                title : payload.title,
                description: payload.description
            }
        )
    }
}
