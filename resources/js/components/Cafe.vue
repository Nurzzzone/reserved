<template>
    <Header></Header>
    <profile-section></profile-section>
    <loading v-if="Loading"></loading>
    <organization v-else-if="organizations.length > 0" :organization="organizations"></organization>
    <not-found v-else :params="NotFound"></not-found>
    <Footer-menu></Footer-menu>
    <Footer></Footer>
</template>

<script>
import Header from "./header/Header";
import Footer from "./footer/Footer";
import ProfileSection from './sections/ProfileSection';
import FooterMenu from './footerMenu/FooterMenu';
import Organization from './layout/Organization';
import NotFound from './layout/Not-found';
import Loading from './layout/Loading';
export default {
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        Organization,
        NotFound,
        Loading
    },
    name: "Cafe",
    data() {
        return {
            Loading: true,
            NotFound: {
                img: '/img/logo/cafe.svg',
                title: 'Список пуст',
                description: 'Возможно в данный момент все заведения закрыты. Попробуите обновить страницу позднее.'
            },
            city: 1,
            organizations: []
        }
    },
    created() {
        this.setFilter();
        this.getOrganizations();
    },
    methods: {
        setFilter: function() {
            if (this.storage.city) {
                this.city =   this.storage.city.id;
            }
        },
        getOrganizations: function()
        {
            axios.get('/api/category/organizations/2/'+this.city)
            .then(response => {
                let data    =   response.data.data;
                for (let i = 0; i < data.length; i++) {
                    data[i].timeTitle   =   this.getTime(data[i]);
                }
                this.organizations  =   data;
                this.Loading    =   false;
            }).catch(error => {
                this.Loading    =   false;
            });
        },
        getTime: function(organization) {
            let today   =   new Date();
            today       =   new Date(today.getFullYear(),today.getMonth(),today.getDate());
            let weekDay =   today.getDay();
            let week;
            if (weekDay === 0) {
                week    =   organization.sunday;
            } else if (weekDay === 1) {
                week    =   organization.monday;
            } else if (weekDay === 2) {
                week    =   organization.tuesday;
            } else if (weekDay === 3) {
                week    =   organization.wednesday;
            } else if (weekDay === 4) {
                week    =   organization.thursday;
            } else if (weekDay === 5) {
                week    =   organization.friday;
            } else if (weekDay === 6) {
                week    =   organization.saturday;
            }
            if (week.start === week.end) {
                return 'круглосуточно';
            }
            return this.timeConvert(week.start)+' '+this.timeConvert(week.end);
        },
        timeConvert: function(time) {
            let converted   =   time.split(':');
            return converted[0]+'.'+converted[1];
        },
    }
}
</script>

<style lang="scss">
    @import '../../css/favorite/favorite.scss';
    @import '../../css/organization/list.scss';
</style>
