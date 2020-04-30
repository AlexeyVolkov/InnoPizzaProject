<template>
  <table class="table" v-if="orderApi.orderedPizzas.length > 0">
    <thead>
      <tr>
        <th scope="col">Pizza</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="pizza in orderApi.orderedPizzas" :key="pizza.id">
        <td>{{pizza.name}}</td>
        <td>{{pizza.price}}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapState } from "vuex";
export default {
  created() {
    this.orderApi.orderedPizzas;
  },
  computed: {
    ...mapState(["orderApi", "notification"])
  }
};
</script>

<style>
</style>
