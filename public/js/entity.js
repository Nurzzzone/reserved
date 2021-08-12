Vue.use(VueMask.VueMaskPlugin);

let app = new Vue({
    el: "#app",
    data() {
        return {
            id: 0,
            organization: '',
            categories: [],
            cities: [],
            status: true,
            success: false,
        };
    },
    created() {
        this.setOrganizationId();
        this.getCountries();
        this.getCategories();
        this.getOrganization();
    },
    methods: {
        categoryChange: function() {
            this.categories.forEach(category => {
                if (category.id === this.organization.category) {
                    this.organization.category_id   =   category;
                }
            });
        },
        saveOrganization: function() {
            if (this.organization.title.trim() === '') {
                return this.$refs.organization_title.focus();
            } else if (this.organization.price.trim() === '') {
                return this.$refs.price.focus();
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
            if (this.status) {
                this.status = false;
                this.success    =   false;
                axios.post('/api/organization/update/'+this.id,{
                    title: this.organization.title.trim(),
                    description: this.organization.description,
                    description_kz: this.organization.description_kz,
                    description_en: this.organization.description_en,
                    price: this.organization.price,
                    start_monday: this.organization.monday.start,
                    end_monday: this.organization.monday.end,
                    start_tuesday: this.organization.tuesday.start,
                    end_tuesday: this.organization.tuesday.end,
                    start_wednesday: this.organization.wednesday.start,
                    end_wednesday: this.organization.wednesday.end,
                    start_thursday: this.organization.thursday.start,
                    end_thursday: this.organization.thursday.end,
                    start_friday: this.organization.friday.start,
                    end_friday: this.organization.friday.end,
                    start_sunday: this.organization.sunday.start,
                    end_sunday: this.organization.sunday.end,
                    start_saturday: this.organization.saturday.start,
                    end_saturday: this.organization.saturday.end,
                    address: this.organization.address,
                    phone: this.organization.phone,
                    email: this.organization.email,
                    website: this.organization.website,
                    city_id: this.organization.city_id,
                    category_id: this.organization.category
                }).then(response => {
                    this.success    =   true;
                    this.status =   true;
                }).catch(element => {
                    this.status =   true;
                });
            }
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
