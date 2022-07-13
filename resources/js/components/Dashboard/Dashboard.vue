<template>
<div class="bg-white relative overflow-hidden">
  <div class="space-y-16 relative container xl:max-w-7xl mx-auto w-full px-4 py-16 lg:px-8 lg:py-32 min-h-screen">
    <div>
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 ">
            Login Temperature
        </h2>
        <hr>
        <div class="w-full block">
          <div class="float-right pt-3">
            <button @click="onClickHottestOrder" type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-red-200 bg-red-200 text-red-700 hover:text-red-700 hover:bg-red-300 hover:border-red-300 focus:ring focus:ring-red-500 focus:ring-opacity-50 active:bg-red-200">
              Hottest First
            </button>
            <button @click="onClickResetOrder" type="button" class="inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm rounded border-gray-100 bg-gray-100 text-gray-600 hover:text-gray-600 hover:bg-gray-200 hover:border-gray-200 focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-gray-100">
              Reset Order
            </button>
          </div>
          <div class="clear-both"></div>
        </div>
    </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="space-y-1" v-for="(item, index) in entries">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 text-center">{{index}}</h2>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="(temperature, key) in item">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{temperature.date}}
                                </th>
                                <td class="py-4 px-6">
                                    {{temperature.celsius}}
                                </td>
                                <td class="py-4 px-6">
                                    {{temperature.fahrenheit}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

</template>

<script>
    const axios = require("axios");
    export default {
        data() {
            return  {
                entries : [],
                order_by : '',
            }
        },
        methods: {
            async getAll(){
                const { data } = await axios.get("dashboard/weather", {
                    params: {
                        order_by: this.order_by,
                    },
                });
                this.entries  = data.data;
            }, 
            onClickHottestOrder(){
                this.order_by = 'value';
            },
            onClickResetOrder(){
                this.order_by = '';
            }
        },
        watch: {
           order_by: function () {
              this.getAll();
           }
        },
        beforeMount() {
          this.getAll();
        }
    }
</script>
