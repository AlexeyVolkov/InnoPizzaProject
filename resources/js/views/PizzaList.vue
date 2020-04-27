<template>
  <div class="row justify-content-around">
    <PizzaCard v-for="pizza in event.pizzas.pizzas" :key="pizza.id" :pizza="pizza" />
  </div>
</template>

<script>
import PizzaCard from "../components/PizzaCard.vue";
import { mapState } from "vuex";

export default {
  components: {
    PizzaCard
  },
  created: function() {
    this.$store.dispatch("event/fetchPizzas");
  },
  computed: {
    page() {
      return parseInt(this.$route.query.page) || 1;
    },
    ...mapState(["event", "user"])
  }
};
</script>
