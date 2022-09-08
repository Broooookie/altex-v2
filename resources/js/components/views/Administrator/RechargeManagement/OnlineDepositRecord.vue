<template>
  <v-app>
    <trading-vue :data="this.$data" title-txt="BTCUSD"></trading-vue>
    <v-btn @click="updateChart()"></v-btn>
  </v-app>
  
</template>

<script>
    import TradingVue from 'trading-vue-js'
    export default {
    components: { TradingVue },
          data() {
          return {
            chartData: [],

            timer: '',
            ohlcv: [
                [ 1636560000000, 33,  37.1, 14,  14,  196 ],
                [ 1636563600000, 13.7, 30, 6.6,  30,  206 ],
                // [ , , , , ,  ],
                // [1551139200000, 24.1, 24.1, 24, 24.1, 29 ],
            ]
          }
        }, 

        created()
        {
          this.updateChart()
          this.timer = setInterval(this.updateChart, 60000)

        },
        methods: {
          updateChart()
          {
        
            // let unix_timestamp = 1636570800
            // // Create a new JavaScript Date object based on the timestamp
            // // multiplied by 1000 so that the argument is in milliseconds, not seconds.
            // var date = new Date(unix_timestamp * 1000);
            // // Hours part from the timestamp
            // var hours = date.getHours();
            // // Minutes part from the timestamp
            // var minutes = "0" + date.getMinutes();
            // // Seconds part from the timestamp
            // var seconds = "0" + date.getSeconds();

            // // Will display time in 10:30:23 format
            // var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

            // console.log(formattedTime);
            axios
                .get("/api/v1/chart")
                .then(response => {
                    this.chartData = response.data.chart;

                    
                    
                   
                    for(let i = 0; i < this.chartData.length; i++)
                    {
                      if(this.chartData[i].date < 1636570800000)
                      {
                        this.ohlcv.push(
                          [Number(this.chartData[i].date), 
                          Number(this.chartData[i].high),
                          Number(this.chartData[i].open), 
                          Number(this.chartData[i].low), 
                          Number(this.chartData[i].close), 
                          Number(this.chartData[i].volume)]
                      )
                      }
                      
                    }
                    
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                  
                });
          }
        },
    }
</script>