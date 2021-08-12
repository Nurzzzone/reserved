Vue.use(VueMask.VueMaskPlugin);

let app = new Vue({
    el: "#app",
    data() {
        return {
            id: 0,
            organization: '',
            categories: [],
            cities: [],
        };
    },
    created() {
        this.setOrganizationId();
        this.getCountries();
        this.getCategories();
        this.getOrganization();
    },
    methods: {
        saveOrganization: function() {
            if (this.organization.title.trim() === '') {
                return this.$refs.organization_title.focus();
            } else if (this.timeCheck(this.organization.monday.start)) {
                return this.$refs.organization_monday_start.focus();
            } else if (this.timeCheck(this.organization.monday.end)) {
                return this.$refs.organization_monday_end.focus();
            } else if (this.timeCheck(this.organization.tuesday.start)) {
                return this.$refs.organization_tuesday_start.focus();
            } else if (this.timeCheck(this.organization.tuesday.end)) {
                return this.$refs.organization_tuesday_end.focus();
            } else if (this.timeCheck(this.organization.wednesday.start)) {
                return this.$refs.organization_wednesday_start.focus();
            } else if (this.timeCheck(this.organization.wednesday.end)) {
                return this.$refs.organization_wednesday_end.focus();
            } else if (this.timeCheck(this.organization.thursday.start)) {
                return this.$refs.organization_thursday_start.focus();
            } else if (this.timeCheck(this.organization.thursday.end)) {
                return this.$refs.organization_thursday_end.focus();
            } else if (this.timeCheck(this.organization.friday.start)) {
                return this.$refs.organization_friday_start.focus();
            } else if (this.timeCheck(this.organization.friday.end)) {
                return this.$refs.organization_friday_end.focus();
            } else if (this.timeCheck(this.organization.saturday.start)) {
                return this.$refs.organization_saturday_start.focus();
            } else if (this.timeCheck(this.organization.saturday.end)) {
                return this.$refs.organization_saturday_end.focus();
            } else if (this.timeCheck(this.organization.sunday.start)) {
                return this.$refs.organization_sunday_start.focus();
            } else if (this.timeCheck(this.organization.sunday.end)) {
                return this.$refs.organization_sunday_end.focus();
            }
            console.log(this.organization);
            axios.post('/api/organization/update/'+this.id,{
                title: this.organization.title.trim(),
                description: this.organization.description,
                description_kz: this.organization.description_kz,
                description_en: this.organization.description_en,
                price: this.organization.price,
                start_monday: this.organization.monday.start,
                end_monday: this.organization.monday.end,

            }).then(response => {
                console.log(response.data);
            }).catch(element => {
                console.log(element);
            });
        },
        timeCheck: function(time) {
            let split   =   time.split(':');
            if (split.length === 2 && split[0].trim() !== '' && split[1].trim() !== '' && split[0].length === 2 && split[1].length === 2) {
                if (parseInt(split[0], 10) < 24 && parseInt(split[1], 10) <= 59) {
                    return false;
                }
            }
            return true;
        },
        getOrganization: function() {
            axios.get('/api/organization/'+this.id).then(response => {
                this.organization   =   response.data.data;
            });
        },
        setOrganizationId: function() {
            let organization    =   document.getElementById('organization');
            this.id =   organization.value;
        },
        getCategories: function() {
            axios.get('/api/category/list')
                .then(response => {
                    this.categories       =   response.data.data;
                });
        },
        getCountries: function() {
            axios.get('/api/countries')
                .then(response => {
                    let data    =   response.data.data;
                    data.forEach(country => {
                        country.city_id.forEach(city => {
                            this.cities.push(city);
                        });
                    });
                });
        }
    },
});
