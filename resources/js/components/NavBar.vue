<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" to="/">OpenRest</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <router-link
            class="nav-link"
            :to="{ name: 'PizzaList' }"
            :class="'/' === $route.path ? 'active':''"
          >
            Home
            <span v-if="'/' === $route.path" class="sr-only">(current)</span>
          </router-link>
        </li>
        <li class="nav-item" v-if="orderApi.orderedPizzasToShow.length > 0">
          <router-link
            class="nav-link"
            :class="'/bag' === $route.path ? 'active':''"
            :to="{ name: 'BagShow' }"
          >
            Bag
            <span v-if="'/bag' === $route.path" class="sr-only">(current)</span>
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["orderApi", "notification"])
  }
};
</script>
