export default {
    state: {
        key: "exclusion-list",
    },


    getExclusionList() {
        let list = localStorage.getItem(this.state.key);
        if (list) {
            return JSON.parse(list);
        }
        return [];
    },

    addExclusionList(nico_no) {
        let list = this.getExclusionList();
        list.push(nico_no);
        localStorage.setItem(this.state.key, JSON.stringify(list));
        return;
    },
    remove() {
        localStorage.removeItem(this.state.key);
        return;
    },

}
