<template>
  <div>
    <em class="left">Source : https://disease.sh</em>
    <div v-if="infoMassages.description" class="col-md-12 text-danger">{{infoMassages.description}}</div>
    <div class="font-weight-bold text-center">INDONESIA COVID CASES TODAY, TOTAL AND GRAPHIC CHART LAST {{startFrom}} DAYS</div>
    <div class="font-weight-bold text-center">&nbsp;</div>
    <div class="row col-sm-12">
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TODAY CASES</div>
        <div class="font-weight-bold text-center"> <font v-model="today.cases">{{today.cases}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TODAY DEATH</div>
        <div class="font-weight-bold text-center"><font v-model="today.death">{{today.death}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TODAY RECOVERED</div>
        <div class="font-weight-bold text-center"><font v-model="today.recover">{{today.recover}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL CASES</div>
        <div class="font-weight-bold text-center"><font v-model="today.totcases">{{today.totcases}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL DEATH</div>
        <div class="font-weight-bold text-center"><font v-model="today.totdeath">{{today.totdeath}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL RECOVERED</div>
        <div class="font-weight-bold text-center"><font v-model="today.totrecover">{{today.totrecover}}</font></div>
      </dir>
    </div>
    <hr>
    <div class="col-md-9">
        <table width="100%">
          <tr>
            <td width="30%">Start From Last :</td>
            <td width="40%"><input v-model="startFrom" type="number" class="form-control"></td>
            <td width="30%">Days</td>
          </tr>
          <tr>
            <td width="30%">In Range :</td>
            <td width="40%"><input v-model="rangeDate" type="number" class="form-control"></td>
            <td width="30%">Days</td>
          </tr>
          <tr>
            <td><button type="button" class="btn btn-primary text-light" @click="fillData()">Procceed</button></td>
          </tr>
        </table>
    </div>
    <hr>
    <bar-chart :chart-data="datacollection" :height="170"></bar-chart>
  </div>
</template>

<script>
  import BarChart from './BarChart.js'

  export default {
    components: {
      BarChart
    },
    data () {
      return {
        startFrom: 30,
        rangeDate: 30,
        datacollection: null,
        dataOption: {label:[],cases:[],recovered:[],deaths:[],daily:[]},
        today: {cases: 0,death: 0,recover: 0,totcases: 0,totdeath: 0,totrecover: 0},
        infoMassages: {
          description: 'Loading data form the sources ...'
        },
      }
    },
    mounted () {
      this.fillData(),
      this.fillDataToday()
    },
    methods: {
      async fillData () {
        this.startFrom > 1 ? this.startFrom = this.startFrom : this.startFrom = 2;
        this.rangeDate > 1 ? this.rangeDate = this.rangeDate : this.rangeDate = 2;
        await axios.get(`https://milearn.herokuapp.com/api/covid/last-month/${this.startFrom}`)
        .then(
          response => {
            this.generateDataset(response.data.timeline);
            this.infoMassages = {description : ``} 
          }
        ).catch(
            error => {
              this.infoMassages = {description : `Data failed to load..`} 
            }
        );

        this.datacollection = {
          fill: false,
          labels: this.dataOption.label,
          datasets: [
            {
              label: 'Death',
              // backgroundColor: 'red',
              fill: false,
              borderColor: 'red',
              lineTension: 0,
              data: this.dataOption.deaths,
            },
            {
              label: 'Recovered',
              // backgroundColor: 'green',
              fill: false,
              borderColor: 'green',
              lineTension: 0,
              data: this.dataOption.recovered,
            },
            {
              label: 'Cases',
              // backgroundColor: 'blue',
              fill: false,
              borderColor: 'blue',
              lineTension: 0,
              data: this.dataOption.cases,
            },
          ]
        }
      },
      async fillDataToday () {
        await axios.get('https://milearn.herokuapp.com/api/covid/').then(response => {
          this.today.cases = response.data.todayCases
          this.today.death = response.data.todayDeaths
          this.today.recover = response.data.todayRecovered
          this.today.totcases = response.data.cases
          this.today.totdeath = response.data.deaths
          this.today.totrecover = response.data.recovered
        });
      },
      generateDataset(datas){
        this.dataOption = {label:[],cases:[],recovered:[],deaths:[],daily:[]};
        let tempCase,tempRec,tempDeath,count = 0;
        Object.keys(datas.cases).forEach(function(key) {
          if(count <= this.rangeDate){
          if (count > 0) {
            this.dataOption.label.push(key);
            datas.cases[key] == 0 ? this.dataOption.cases.push(0) : this.dataOption.cases.push(datas.cases[key]-tempCase);
            datas.deaths[key] == 0 ? this.dataOption.deaths.push(0) : this.dataOption.deaths.push(datas.deaths[key]-tempDeath);
            datas.recovered[key] == 0 ? this.dataOption.recovered.push(0) : this.dataOption.recovered.push(datas.recovered[key]-tempRec);
            tempCase = datas.cases[key]
            tempRec = datas.recovered[key]
            tempDeath = datas.deaths[key]
            count++
          } else {
            tempCase = datas.cases[key]
            tempRec = datas.recovered[key]
            tempDeath = datas.deaths[key]
            count++
          }
          }
        }, this);
      },
    }
  }
</script>

<style>
    .covid-info{
      height: 50px;
    }
</style>