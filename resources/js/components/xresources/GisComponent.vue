<template>
  <div class="container">
    <GmapMap
      :center="mapCenter"
      :zoom="7"
      map-type-id="terrain"
      style="width: 100%; height: 500px"
      @click="handleMapClicked"
    >
    <GmapInfoWindow 
      :options="infoWindowOptions"
      :position="infoWindowPosition"
      :opened="infoWindowOpened"
      @closeclick="handleInfoWindowClose"
    >
      <div>
        <table class="table table-striped">
            <tr>
              <td>Name</td>
              <td><input type="text" class="form-control-sm" v-model="activePin.name"></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><input type="text" class="form-control-sm" v-model="activePin.address"></td>
            </tr>
            <tr>
              <td>City</td>
              <td><input type="text" class="form-control-sm" v-model="activePin.city"></td>
            </tr>
            <button class="btn btn-success btn-sm" @click="updatePin()">Update</button>
            <button class="btn btn-danger btn-sm" @click="deletePin(activePin.id)">Delete</button>
        </table>
      </div>
    </GmapInfoWindow>
      <GmapMarker
        v-for="(p) in pins"
        :key="p.id"
        :position="getPin(p)"
        :clickable="true"
        :draggable="true"
        @click="clickHandle(p)"
      />
    </GmapMap>
  </div>
</template>

<script>
export default {
  data: () => ({ 
    pins: {},
    infoWindowOptions: {
      pixelOffset: {
        width: 0,
        height: -35
      }
    },
    activePin: {},
    infoWindowOpened: false,
    infoWindowPosition: {lat:10, lng:10}
    
  }),
  mounted() {
      this.getPinpoints();
  },
  computed: {
    mapCenter(){
      if (!this.pins.length) {
        return {lat:10, lng:10}
      }else{
        return {lat: parseFloat(this.pins[0].latitude), lng: parseFloat(this.pins[0].longitude)}
      }
    }
  },
  methods: {
    async getPinpoints() {
      let response = await axios.get('/api/gis')
      .then(
        response => {
          this.pins = response.data;
        }
      );
    },
    getPin(p){
      return {lat: parseFloat(p.latitude), lng: parseFloat(p.longitude)}
    },
    clickHandle(p)
    {
      this.activePin = p;
      this.infoWindowPosition = {lat: parseFloat(p.latitude), lng: parseFloat(p.longitude)},
      this.infoWindowOpened = true;

    },
    handleInfoWindowClose(){
      this.activePin = {};
      this.infoWindowOpened = false;
    },
    async handleMapClicked(e){
      let newPin = {
        name:"",
        address:"",
        city: "",
        state: "",
        latitude: e.latLng.lat(),
        longitude: e.latLng.lng()
      }
      
      await axios.post("/api/gis/create-pinpoint", newPin)
      .then(
        response => {
          this.$toasted.show('Pinpoint saved..', {
          type : 'success',
          duration : 2000
        });
        this.clickHandle(response.data);
        }
      ).catch(
        error => {
        this.$toasted.show('Something went wrong..', {
          type : 'error',
          duration : 2000
        })
        }
      );
      this.getPinpoints()
    },
    async deletePin(id) {
      await axios.delete(`/api/gis/delete/${id}`)
      .then(
        response => {
          this.$toasted.show('Data deleted..', {
            type : 'error',
            duration : 2000
        });
        this.infoWindowOpened = false;
        this.getPinpoints()
        }
      );
    },
    async updatePin(){
      await axios.post("/api/gis/update-pinpoint", this.activePin)
        .then(
            response => {
              this.$toasted.show('Pinpoint updated..', {
              type : 'success',
              duration : 2000
            });
            }
        ).catch(
          error => {
            this.$toasted.show('Something went wrong, fill all input correctly..', {
            type : 'error',
            duration : 2000
          })
          }
        );        
      
      this.getPinpoints();
    }

  }
};

</script>

<style>
</style>