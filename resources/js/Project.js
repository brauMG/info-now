const app = new Vue({
    el: '#app',
    data: {
        selected_area: '',
        selected_user: '',
        users: [],
    },
    mounted() {
        document.getElementById("user").disabled=true;

        this.selected_area = this.getOldData('area');
        if (this.selected_area != '') {
            this.loadUsers();
        }

        this.selected_user = this.getOldData('user');
    },
    methods: {
        loadUsers() {
            this.selected_user = '';
            document.getElementById("user").disabled=true;

            if (this.selected_area != '') {
                axios.get('/Admin/Area/Project/Users', {params: {area: this.selected_area} }).then((response) => {
                    this.users = response.data;
                    document.getElementById("user").disabled=false;
                });
            }
        },
        getOldData(type) {
            return document.getElementById(type).getAttribute('data-old');
        }
    }
});
