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

    splice(nico_no) {
        let list = this.get();
        if (list) {
            let newList =  [];
            list.forEach(function(val,index){
                if(val !== nico_no){
                    newList.push(val);
                }
            });
            localStorage.setItem(localStorageKey, JSON.stringify(newList));
        }
        return;
    },
    destroy() {
        localStorage.removeItem(localStorageKey);
        return;
    },

}
