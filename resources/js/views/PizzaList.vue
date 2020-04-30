<template>
  <div>
    <header>
      <FiltersCard />
    </header>
    <main class="row justify-content-around">
      <PizzaCard v-for="pizza in pizzaApi.pizzas" :key="pizza.id" :pizza="pizza" />
    </main>
    <aside v-if="orderApi.orderedPizzas.length > 0">
      <h3>
        <span class="badge badge-light">{{orderApi.orderedPizzas.length}}</span>pizzas in a bag
      </h3>
      <ul class="list-group">
        <li
          class="list-group-item"
          v-for="pizza in orderApi.orderedPizzas"
          :key="pizza.id"
        >{{pizza.name}}</li>
      </ul>
    </aside>
  </div>
</template>

<script>
import PizzaCard from "../components/PizzaCard.vue";
import FiltersCard from "../components/FiltersCard.vue";
import { mapState, mapActions } from "vuex";

export default {
  components: {
    PizzaCard,
    FiltersCard
  },
  computed: {
    page() {
      return parseInt(this.$route.query.page) || 1;
    },
    ...mapState(["pizzaApi", "orderApi", "notification"])
  }
};
</script>
