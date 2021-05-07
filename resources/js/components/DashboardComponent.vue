<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Premier League Statistics Launcher</div>
                    <div class="card-body">
                        <div v-if="loaded">
                            <div v-for="row in teamRows" class="row team-row-spacer">
                                <div v-for="team in row" class="col-sm-4">
                                    <button type="button" class="btn btn-light btn-block" v-on:click="showStatistics(team)"> {{ team }} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <statistics v-bind:teamName="selectedTeam" v-if="showModal" v-on:modalClose="closeModal()"></statistics>
    </div>
</template>


<script>

import statistics from './StatisticsComponent.vue';

export default {
    data : function()
    {
        return {
            loaded: false,
            teamRows: [],
            columns: 3,
            showModal: false,
            selectedTeam: "",
        } 
    }, 
    components: {
        statistics
    },
    methods: 
    {
        showStatistics: function (teamName) 
        {
            this.selectedTeam = teamName;
            this.showModal = true;
        },
        closeModal: function (){
            this.selectedTeam = "";
            this.showModal = false;
        }
    },
    mounted() 
    {
        axios.get("/teams").then( (response) => 
            { 
                console.log(response.data);
                var totalTeams = response.data.length;
                var totalRows = totalTeams / 3;
                var row = 0;
                var col = 0;
                for(var i = 0; i < totalTeams; i++)
                {
                    if (col == 0){
                        this.teamRows[row] = [];
                    }
                    this.teamRows[row].push(response.data[i].HomeTeam);
                    if ( col >= this.columns - 1)
                    {
                        col = 0;
                        row++;
                    }
                    else {
                        col++;
                    }
                }
                console.log(this.teamRows);
                this.loaded = true;
            }
        );
    }
}
</script>
