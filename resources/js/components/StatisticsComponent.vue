<template>
    <b-modal :visible="show" id="modal-1" v-on:hide="cleanup()">
        <div class="row">
            <h2 class="my-3"> {{ teamName }} </h2>
        </div>
        <div class="row">
            <h5> Last Played : {{ lastPlayed }} </h5>
        </div>
        <div class="row my-2">
            <div class="col-sm-6">
                <doughnut-chart :chartdata="homeData" :options="homeOptions" v-if="chartsLoaded"></doughnut-chart>
            </div>
            <div class="col-sm-6">
                <doughnut-chart :chartdata="awayData" :options="awayOptions" v-if="chartsLoaded"></doughnut-chart>
            </div> 
        </div> 
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Team</th>
                        <th scope="col">Wins</th>
                        <th scope="col">Draws</th>
                        <th scope="col">Losses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="team in hthData">
                        <td>{{team.team}}</td>
                        <td>{{team.W}}</td>
                        <td>{{team.D}}</td>
                        <td>{{team.L}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </b-modal> 
</template>

<script>

import DoughnutChart from './DoughnutChart.vue'

export default {
    components: {
        DoughnutChart
    },
    data : function()
    {
        return {
            show: false,
            lastPlayed: "",
            hthData: [],
            homeData: null,
            homeOptions: null,
            awayData: null,
            awayOptions: null,
            chartsLoaded: false,
        } 
    }, 
    methods: 
    {
        cleanup()
        {
            this.show = false;
            this.$emit("modalClose");
        }
    },

    props: 
    {
        teamName: String,
    },

    mounted() 
    {
        axios.get("/statistics?teamName=" + this.teamName).then(
            (response) =>
            {
                console.log(response);
                this.lastPlayed = response.data.lastPlayed.Date;

                console.log(response.data.homeResults);
                var homeW = ((response.data.homeResults.find(x => x.FTR == "H") != null) ?  
                        response.data.homeResults.find(x => x.FTR == "H").count :
                        0);
                var homeD = ((response.data.homeResults.find(x => x.FTR == "D") != null) ?  
                        response.data.homeResults.find(x => x.FTR == "D").count :
                        0);
                var homeL = ((response.data.homeResults.find(x => x.FTR == "A") != null) ?  
                        response.data.homeResults.find(x => x.FTR == "A").count :
                        0);


                this.homeData = {
                    labels: ["Wins", "Draws", "Losses"],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: ["#5EDC4E", "#7A7A7A", "#DC2020"],
                            data: [
                                homeW,
                                homeD,
                                homeL
                            ]
                        }, 
                    ]
                };
                this.homeOptions = {
                    title: {
                        display: true,
                        text: "Home"
                    }
                };

                var awayL = ((response.data.awayResults.find(x => x.FTR == "H") != null) ?  
                        response.data.awayResults.find(x => x.FTR == "H").count :
                        0);
                var awayD = ((response.data.awayResults.find(x => x.FTR == "D") != null) ?  
                        response.data.awayResults.find(x => x.FTR == "D").count :
                        0);
                var awayW = ((response.data.awayResults.find(x => x.FTR == "A") != null)?  
                        response.data.awayResults.find(x => x.FTR == "A").count :
                        0);
                this.awayData = {
                    labels: ["Wins", "Draws", "Losses"],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: ["#5EDC4E", "#7A7A7A", "#DC2020"],
                            data: [
                                awayW,
                                awayD,
                                awayL
                            ]
                        }, 
                    ]
                };
                this.awayOptions = {
                    title: {
                        display: true,
                        text: "Away"
                    }
                };
                this.chartsLoaded = true;
                for(var rec = 0; rec < response.data.headToHead.length; rec++){
                    this.hthData.push(response.data.headToHead[rec]);
                }
                this.show = true;
            },
            (error) =>
            {
                console.log("Error loading statistics");
                this.cleanup();
            }
        );

    }
}
</script>
