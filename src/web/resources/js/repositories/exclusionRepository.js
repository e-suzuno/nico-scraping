const localStorageKey = "exclusion-list";

export default {
    get() {
        let list = localStorage.getItem(localStorageKey);
        if (list) {
            return JSON.parse(list);
        }
        return [];
    },

    add(id) {
        let list = this.get();
        list.push(id);
        localStorage.setItem(localStorageKey, JSON.stringify(list));
        return;
    },

    destroy() {
        localStorage.removeItem(localStorageKey);
        return;
    },

}
