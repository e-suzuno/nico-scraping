import Repository from './Repository'


const resource = "auth";

export default {
    me() {
        return Repository.get(`${resource}/me`);
    },

    authenticate(data) {
        return Repository.post(`${resource}/authenticate`, data);
    },

    register(data) {
        return Repository.post(`${resource}/register`, data);
    }

}
