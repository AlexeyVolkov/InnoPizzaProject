<template>
  <section class="row justify-content-center">
    <form action method="get" class="col-6">
      <div class="form-group">
        <label class="sr-only" for="filterSelect">Filter Pizzas</label>
        <select
          class="form-control"
          id="filterSelect"
          name="filterSelect"
          v-model="selected"
          @change="onChange()"
        >
          <option disabled value>Filter</option>
          <option value="cheap">Cheap</option>
          <option value="expensive">Expensive</option>
          <option value="fat">Fat</option>
          <option value="favorless">Favorless</option>
        </select>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  data() {
    return {
      selected: ""
    };
  },
  methods: {
    onChange() {
      this.$store.dispatch("event/fetchPizzas", this.selected);
    }
  }
};
</script>

<style></style>
