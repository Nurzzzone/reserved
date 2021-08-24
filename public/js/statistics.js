Vue.use(VueMask.VueMaskPlugin);

let app = new Vue({
    el: "#app",
    data() {
        return {
            id: 0,
            showModal: false,
            colors: [
                {bg: 'rgba(87,162,131,.2)',ln: 'rgba(87,162,131,.7)'},
                {bg: 'rgba(255,128,8,.2)',ln: 'rgba(255,128,8,.7)'}
            ],
            selectedDate: {
                start: new Date(),
                end: new Date(),
            },
            web: {
                labels: [],
                list: [],
            }
        }
    },
    created() {
        this.setOrganizationId();
        this.setTime();
    },
    mounted() {
        this.setWeb();
        this.getWeb();

        //bar
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        new Chart(document.getElementById("horizontalBar"), {
            "type": "horizontalBar",
            "data": {
                "labels": ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey"],
                "datasets": [{
                    "label": "My First Dataset",
                    "data": [22, 33, 55, 12, 86, 23, 14],
                    "fill": false,
                    "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                    ],
                    "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                    ],
                    "borderWidth": 1
                }]
            },
            "options": {
                "scales": {
                    "xAxes": [{
                        "ticks": {
                            "beginAtZero": true
                        }
                    }]
                }
            }
        });
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
                datasets: [{
                    data: [300, 50, 100, 40, 120],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                }]
            },
            options: {
                responsive: true
            }
        });
    },
    methods: {
        readyFilter: function() {
            this.showModal  =   false;
        },
        getStartDate: function() {
            return this.selectedDate.start.getFullYear()+'-'+(this.selectedDate.start.getMonth()+1)+'-'+this.selectedDate.start.getDate();
        },
        getEndDate: function() {
            return this.selectedDate.end.getFullYear()+'-'+(this.selectedDate.end.getMonth()+1)+'-'+this.selectedDate.end.getDate();
        },
        setWeb: function() {
            new Chart(this.$refs.lineChart, {
                type: 'line',
                data: {
                    labels: this.web.labels,
                    datasets: this.web.list
                },
                options: {
                    responsive: true
                }
            });
        },
        onlyUnique: function(value, index, self) {
            return self.indexOf(value) === index;
        },
        getWeb: function() {
            axios.get('/api/webTraffic/dateBetween/'+this.getStartDate()+'/'+this.getEndDate()+'/'+this.id)
                .then(response => {
                    let data    =   response.data;
                    let labels  =   [];
                    let list    =   [];
                    let i       =   0;
                    data.forEach(item => {
                        labels.push(item.date);
                        if (!(item.website in list)) {
                            list[item.website]  =   {
                                label: item.website,
                                data: [],
                                backgroundColor: this.colors[i].bg,
                                borderColor: this.colors[i].ln,
                                borderWidth: 2
                            };
                        }
                        list[item.website].data.push(item.total);
                        i++;
                    });

                    let arr =   [];

                    for (i in list) {
                        arr.push(list[i]);
                    }

                    this.web.labels =   labels.filter(this.onlyUnique);
                    this.web.list   =   arr;

                    new Chart(this.$refs.lineChart, {
                        type: 'line',
                        data: {
                            labels: this.web.labels,
                            datasets: this.web.list
                        },
                        options: {
                            responsive: true
                        }
                    });

                });
            /*
           {
                                   label: "2gis.com",
                                   data: [65, 59, 80, 81, 56, 55, 40],
                                   backgroundColor: [
                                       'rgba(105, 0, 132, .2)',
                                   ],
                                   borderColor: [
                                       'rgba(200, 99, 132, .7)',
                                   ],
                                   borderWidth: 2
                               },
                               {
                                   label: "vk.com",
                                   data: [28, 48, 40, 19, 86, 27, 90],
                                   backgroundColor: [
                                       'rgba(0, 137, 132, .2)',
                                   ],
                                   borderColor: [
                                       'rgba(0, 10, 130, .7)',
                                   ],
                                   borderWidth: 2
                               }
            */
        },
        setTime: function() {
            let start   =   new Date();
            let end     =   new Date();
            start.setDate(end.getDate() - 7);
            this.selectedDate.start =   start;
            this.selectedDate.end   =   end;
        },
        setFilter: function() {

        },
        setOrganizationId: function() {
            let organization    =   document.getElementById('organization');
            this.id =   organization.value;
        },
    }
});
