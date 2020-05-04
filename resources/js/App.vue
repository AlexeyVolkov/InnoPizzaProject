<template>
  <div id="app">
    <NavBar />
    <router-view :key="$route.fullPath" />
  </div>
</template>

<script>
import NavBar from "./components/NavBar";
import { mapState } from "vuex";

export default {
  components: {
    NavBar
  },
  data() {
    return {
      customer_id: parseInt(localStorage.getItem("customer_id"), 10)
    };
  },
  // finished here
  // check stability
  created() {
    // Pizzas
    this.$store.dispatch("pizzaApi/fetchManyPizzas");
    // Customer
    if (this.customer_id && this.customer_id > 0) {
      this.$store.dispatch("orderApi/getCustomer", this.customer_id);
      this.$store.dispatch("orderApi/getOrder", this.customer_id).then(() => {
        if (!this.orderApi.customer || !this.orderApi.customer.id) {
          localStorage.setItem("customer_id", 0);
          this.$store.dispatch("orderApi/addCustomer").then(() => {
            this.$router.push({
              name: "PizzaList"
            });
          });
        }
      });
    } else {
      // it's new Customer
      localStorage.setItem("customer_id", 0);
      this.$store.dispatch("orderApi/addCustomer");
    }
  },
  computed: {
    ...mapState(["orderApi", "notification"])
  }
};
</script>

<style>
</style>
