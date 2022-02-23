<template>
  <div>
    <em class="left">Source : https://disease.sh</em><br>
    <em class="left">Last update : {{today.lastUpdate}}</em>
    <div v-if="infoMassages.description" class="col-md-12 text-danger">{{infoMassages.description}}</div>
    <div class="font-weight-bold text-center">INDONESIA LATEST COVID-19 INFORMATION, TOTAL AND GRAPHIC LAST {{startFrom}} DAYS</div>
    <div class="font-weight-bold text-center">&nbsp;</div>
    <div class="row col-sm-12">
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">LATEST CASES</div>
        <div class="font-weight-bold text-center"> <font v-model="today.todayCases">{{today.todayCases}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">LATEST DEATH</div>
        <div class="font-weight-bold text-center"><font v-model="today.todayDeaths">{{today.todayDeaths}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">LATEST RECOVERED</div>
        <div class="font-weight-bold text-center"><font v-model="today.todayRecovered">{{today.todayRecovered}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL CASES</div>
        <div class="font-weight-bold text-center"><font v-model="today.cases">{{today.cases}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL DEATH</div>
        <div class="font-weight-bold text-center"><font v-model="today.deaths">{{today.deaths}}</font></div>
      </dir>
      <dir class="card col-sm-4 covid-info">
        <div class="font-weight-bold">TOTAL RECOVERED</div>
        <div class="font-weight-bold text-center"><font v-model="today.recovered">{{today.recovered}}</font></div>
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
        today: {},
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
        await axios.get(`/api/covid/last-month/${this.startFrom}`)
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
        await axios.get(`/api/covid/today`).then(response => {
          this.today = response.data;
          this.today.lastUpdate = 'Yesterday'
        });
      },
      generateDataset(datas){
        this.dataOption = {label:[],cases:[],recovered:[],deaths:[],daily:[]};
        let tempCase,tempRec,tempDeath,count = 0;
        let sliced = Object.entries(datas.cases).slice(0, this.rangeDate+1);
        sliced.forEach(element => {
            if (count > 0) {
              this.dataOption.label.push(element[0]);
              datas.cases[element[0]] > tempCase ? this.dataOption.cases.push(datas.cases[element[0]]-tempCase) : this.dataOption.cases.push(0);
              datas.deaths[element[0]] > tempDeath ? this.dataOption.deaths.push(datas.deaths[element[0]]-tempDeath) : this.dataOption.deaths.push(0);
              datas.recovered[element[0]] > tempRec ? this.dataOption.recovered.push(datas.recovered[element[0]]-tempRec) : this.dataOption.recovered.push(0);
              tempCase = datas.cases[element[0]]
              tempRec = datas.recovered[element[0]]
              tempDeath = datas.deaths[element[0]]
            }else{
              tempCase = datas.cases[element[0]]
              tempRec = datas.recovered[element[0]]
              tempDeath = datas.deaths[element[0]]
              count++;
            }
        });
      },
    }
  }
</script>

<style>
    .covid-info{
      height: 50px;
    }
</style>