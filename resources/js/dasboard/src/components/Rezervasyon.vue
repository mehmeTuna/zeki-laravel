<template>
 
    <div class="main-panel">
      <div class="row " style="margin-top:50px">
        <div class="col-md-2" ></div>
        <div class="col-md-3">
          <div >
            <div class="card-body">
              <div class="chart-area">
                <h3 class="card-title">
                    Günlük Rezervasyon Sayısı
                    </h3>
                 <BarChart v-if="loaded" style="height: 100%" :chartdata='chartdata' :options='options' />
                 <h3 class="card-title">
                    Aylık Rezervasyon Sayısı
                    </h3>
                  <BarChart v-if="loaded" style="height: 100%" :chartdata='chartdata1' :options='options' />
              </div>
            </div>
            
          </div>
        </div>
         <div class="col-md-3">
          <div >
            <div class="card-body">
              <div class="chart-area">
                 <h3 class="card-title">
                    Yıllık Rezervasyon Sayısı
                    </h3>
                 <LineChart v-if="loaded" style="height: 100%"  :chartdata='chartdata2' :options='options' />
                 
              </div>
            </div>
            
          </div>
        </div>
         
      </div>
      
  
  </div>
    
</template>

<script>
import axios from 'axios';
import LineChart from './Chart'
import BarChart from './AylikChart';
export default {

    components:{
      BarChart,
      LineChart
    },

  data(){
    return{
      loaded:false,
      chartdata:null,
      chartdata1:null,
      chartdata2:null,
      options:null,
      günlükRezervasyon:{
        toplam:null,
        kabul:0,
        red:0,
        bekleyen:0,
      },
       aylikRezervasyon:{
        toplam:null,
        kabul:0,
        red:0,
        bekleyen:0,
      },
       yillikRezervasyon:{
        toplam:null,
        kabul:0,
        red:0,
        bekleyen:0,
      }

    }
  },

  methods:{

  },

  async mounted(){

    await axios.get('admin/api/rezervasyon/thisday')
    .then((res) =>{
      
      
      this.günlükRezervasyon.toplam = res.data.toplam;
      this.günlükRezervasyon.bekleyen = res.data.wait;
      this.günlükRezervasyon.red = res.data.red;
      this.günlükRezervasyon.kabul = res.data.ok;
      console.log(this.günlükRezervasyon);
      

      
    });
     await axios.get('admin/api/rezervasyon/thismonth')
    .then((res) =>{
      
      
      this.aylikRezervasyon.toplam =res.data.toplam;
      this.aylikRezervasyon.bekleyen = res.data.wait;
      this.aylikRezervasyon.red = res.data.red;
      this.aylikRezervasyon.kabul = res.data.ok;
      console.log(this.aylikRezervasyon);
      

      
    });
     await axios.get('admin/api/rezervasyon/thisyear')
    .then((res) =>{
      
      
      this.yillikRezervasyon.toplam = res.data.toplam;
      this.yillikRezervasyon.bekleyen = res.data.wait;
      this.yillikRezervasyon.red = res.data.red;
      this.yillikRezervasyon.kabul = res.data.ok;
      console.log(this.yillikRezervasyon);
      

      
    });

    
    this.chartdata = {

        
 
             
             labels:['Bekleyen ','Kabul Edilen ','Reddedilen'],

            datasets:[{
               
          backgroundColor: ['rgba(66,134,121,0.15)','rgba(66,134,121,0.15)','rgba(66,134,121,0.15)'],
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#00d6b4',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#00d6b4',
          pointBorderWidth: 10,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
              
            label:'Rezervasyon Sayıları',
            data:[this.günlükRezervasyon.bekleyen,this.günlükRezervasyon.kabul,this.günlükRezervasyon.red],
            
            }
            ]
           };
           this.chartdata1 = {

        
 
             
             labels:['Bekleyen ','Kabul Edilen ','Reddedilen'],

            datasets:[{
               
          backgroundColor: ['rgba(66,134,121,0.15)','rgba(66,134,121,0.15)','rgba(66,134,121,0.15)'],
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#00d6b4',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#00d6b4',
          pointBorderWidth: 10,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
              
            label:'Ödeme Tipleri',
           data:[this.aylikRezervasyon.bekleyen,this.aylikRezervasyon.kabul,this.aylikRezervasyon.red],
            
            }
            ]
           };
           this.chartdata2 = {

        
 
             
             labels:['Bekleyen ','Kabul Edilen ','Reddedilen'],

            datasets:[{
               
          backgroundColor: ['#34495e'],
          borderColor: '#1f8ef1',
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: '#00d6b4',
          pointBorderColor: 'rgba(255,255,255,0)',
          pointHoverBackgroundColor: '#00d6b4',
          pointBorderWidth: 10,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
              
            label:'Ödeme Tipleri',
            data:[this.yillikRezervasyon.bekleyen,this.yillikRezervasyon.kabul,this.yillikRezervasyon.red],
            
            }
            ]
           };
           this.options = {
              legend: {
          display: false
        },
          responsive:true,
       

              tooltips: {
          backgroundColor: '#f5f5f5',
          titleFontColor: '#333',
          bodyFontColor: '#666',
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest"
        },
         
             
            scales: {
          yAxes: [{
              


            gridLines: {
              drawBorder: false,
              color: 'rgba(29,140,248,0.1)',
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 20,
              padding:20,     
              fontColor: "#32325d"
            }
          }],

          xAxes: [{

           
            ticks: {
              padding:20,
              fontColor: "#9e9e9e"
            }
          }]
        }
 
           }
           this.loaded = true;
    

  },

  created(){

  }

}
</script>

<style>

</style>
