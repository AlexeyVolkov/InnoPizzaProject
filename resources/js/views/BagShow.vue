<template>
  <table class="table" v-if="orderApi.orderedPizzas.length > 0">
    <thead>
      <tr>
        <th scope="col">Pizza</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="orderedPizza in orderApi.orderedPizzas" :key="orderedPizza.id">
        <td>{{orderedPizza.pizza.name}}</td>
        <td>{{orderedPizza.ordered_pizza.price}}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["orderApi", "notification"])
  }
};
</script>

<style>
</style>
