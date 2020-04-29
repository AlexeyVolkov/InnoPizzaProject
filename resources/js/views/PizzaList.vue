<template>
  <div>
    <header>
      <FiltersCard />
    </header>
    <div class="row justify-content-around">
      <PizzaCard v-for="pizza in pizzaApi.pizzas" :key="pizza.id" :pizza="pizza" />
    </div>
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
  data() {
    return {
      customer_id: localStorage.customer_id
    };
  },
  created() {
    // Pizzas
    this.$store.dispatch("pizzaApi/fetchManyPizzas");
    // Customer
    if (this.customer_id && this.customer_id > 0) {
      this.$store.dispatch("orderApi/getCustomer", this.customer_id);
    } else {
      // it's new Customer
      this.$store.dispatch("orderApi/addCustomer");
    }
  },
  computed: {
    page() {
      return parseInt(this.$route.query.page) || 1;
    },
    ...mapState(["pizzaApi", "orderApi", "notification"])
  }
};
</script>
