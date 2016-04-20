var Vue = require('vue');
Vue.use(require('vue-resource'));

var homepage = new Vue({
    el: '#app',

    data: {
        modalForm: '',
        modalTitle: '',
        user: null,
        parents: [],
        partner: null,
        children: [],
    },

    created: function() {
        this.$http.get($('a#tree_link').attr('href'), function (data) {
            this.user = data.user;
            this.parents = data.parents;
            this.partner = data.partner;
            this.children = data.children;
        }).error(function (data) {
            console.log("Error:" + JSON.stringify(data));
        });
    },

    methods: {
        popup: function(event) {
            event.preventDefault();
            this.$http.get(event.target.href, function (data) {
                this.modalTitle = data.title;
                this.modalForm = data.html;
                $('#myModal').modal();
            }).error(function (data) {
                console.log("Error:" + JSON.stringify(data));
            });
        },
        showTree: function(event) {
            event.preventDefault();
            this.$http.get(event.target.href, function (data) {
                this.user = data.user;
                this.parents = data.parents;
                this.partner = data.partner;
                this.children = data.children;
            }).error(function (data) {
                console.log("Error:" + JSON.stringify(data));
            });
        },
    }
});