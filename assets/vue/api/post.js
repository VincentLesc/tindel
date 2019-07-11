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
        console.log(axios.get('/api/posts'));
        return axios.get('/api/posts');
    },
    deleteOne (id) {
        return axios.delete('/api/posts/'+id)
    }
}
