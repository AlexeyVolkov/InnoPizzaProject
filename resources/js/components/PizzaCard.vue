<template>
  <div class="card col-md-3 ml-md-auto" style="width: 18rem;">
    <img src class="card-img-top" alt="..." />
    <div class="card-body">
      <h5 class="card-title">{{ pizza.name }}</h5>
      <figure class="figure" id="figure" :title="pizza.name">
        <img
          :alt="pizza.name"
          class="img figure__img figure-img img-fluid rounded"
          :src="pizza.img_url"
        />
        <figcaption
          class="figure__figcaption screen-reader-text figure-caption"
          id="figure-1"
        >${{ pizza.price }}</figcaption>
      </figure>
      <button href="#" class="btn btn-primary" v-on:click="onClick">+ Добавить</button>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  props: {
    pizza: Object
  },
  methods: {
    onClick() {
      this.$store.dispatch("orderApi/addOrderedPizza", this.pizza);
      console.log(this.orderApi.orderedPizzas);
      this.$store.dispatch("orderApi/updateOrder", {
        order_id: this.orderApi.order.id,
        orderedPizzas: this.orderApi.orderedPizzas
      });
    }
  },
  computed: {
    ...mapState(["orderApi"])
  }
};
</script>

<style>
</style>
