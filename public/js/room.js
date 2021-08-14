Vue.use(VueMask.VueMaskPlugin);
let app = new Vue({
    el: "#app",
    data() {
        return {
            showModal: false,
            id: 0,
            sections: [],
            newSections: [],
            newSectionsStatus: true,
            sectionTemplate: {
                name: '',
                status: 'ENABLED',
            }
        }
    },
    created() {
        this.setOrganizationId();
        this.getSections();
    },
    methods: {
        saveRooms: function() {
            if (this.newSectionsStatus) {
                let index   =   0;
                let focus   =   [];
                this.newSections.forEach(section => {
                    if (section.name.trim() === '') {
                        focus.push(index);
                    }
                    index++;
                });
                if (focus.length > 0) {
                    focus.forEach(item => {
                        return this.$refs.newSection[item].focus();
                    });
                } else {
                    this.newSectionsStatus  =   false;
                }
            }
        },
        removeRoom: function(key) {
            this.newSections.splice(key,1);
        },
        addRoom: function() {
            this.newSections.push(JSON.parse(JSON.stringify(this.sectionTemplate)));
        },
        newRooms: function() {
            this.newSections    =   [];
            this.newSections.push(JSON.parse(JSON.stringify(this.sectionTemplate)));
            this.showModal = true;
        },
        getSections: function() {
            axios.get('/api/section/organization/'+this.id)
                .then(response => {
                    this.sections   =   response.data.data;
                });
        },
        setOrganizationId: function() {
            let organization    =   document.getElementById('organization');
            this.id =   organization.value;
        },
    }
});
