<template>
  <section class="address row justify-content-center">
    <form action method="get" class="col-6">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">📍</span>
        </div>
        <label class="sr-only" for="addressInput">Delivery Address</label>
        <input
          type="text"
          class="form-control form-control-lg"
          id="addressInput"
          placeholder="Delivery Address"
          title="Contactless delivery"
          v-model="addressInput"
          @change="onChange()"
        />
        <small id="addressInputHelp" class="sr-only form-text text-muted">Contactless delivery</small>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  data() {
    return {
      addressInput: ""
    };
  },
  methods: {
    onChange() {
      this.$store.dispatch("event/updateOrder", this.addressInput);
    }
  }
};
</script>

<style>
</style>
