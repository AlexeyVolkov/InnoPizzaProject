<template>
  <table class="table" v-if="orderApi.orderedPizzasToShow.length > 0">
    <thead>
      <tr>
        <th scope="col">Pizza</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="orderedPizza in orderApi.orderedPizzasToShow" :key="orderedPizza.ordered_pizza.id">
        <td>{{orderedPizza.pizza.name}}</td>
        <td>{{orderedPizza.ordered_pizza.price}}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapState } from "vuex";
export default {
  created() {
    // if (this.orderApi.orderedPizzas.length > 0) {
    //   this.$store.dispatch(
    //     "orderApi/updateOrder",
    //     this.orderApi.order.id,
    //     this.orderApi.orderedPizzas
    //   );
    // }
  },
  computed: {
    ...mapState(["orderApi", "notification"])
  }
};
</script>

<style>
</style>
