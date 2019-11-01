import Repository from './Repository'


const resource = "tag";

export default {


    get(conditions) {
        return Repository.get(`${resource}`, {params: conditions});
    },

    show(id) {
        return Repository.get(`${resource}/${id}`);
    },

    store(data) {
        return Repository.post(`${resource}`, data);
    },

    update(id, data) {
        return Repository.put(`${resource}/${id}`, data);
    },

    destroy(id) {
        return Repository.delete(`${resource}/${id}`);
    }


}
