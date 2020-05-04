<template>
  <div>
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
    <form v-if="orderApi.orderedPizzas.length > 0" v-on:submit.prevent="onSubmit">
      <div class="form-group">
        <label for="orderComments">Address and notes</label>
        <textarea
          class="form-control"
          v-model="orderApi.order.comments"
          id="orderComments"
          name="comments"
          placeholder="Lenina 45, 32"
        ></textarea>
        <small id="commentsHelp" class="form-text text-muted">We do read notes you leave</small>
      </div>
      <div class="form-group">
        <label>Payment</label>
        <div class="form-check">
          <input
            v-model="orderApi.order.payment_id"
            class="form-check-input"
            type="radio"
            name="paymentRadio"
            id="cash"
            value="1"
            checked
          />
          <label class="form-check-label" for="cash">Cash</label>
        </div>
        <div class="form-check">
          <input
            v-model="orderApi.order.payment_id"
            class="form-check-input"
            type="radio"
            name="paymentRadio"
            id="bank_card"
            value="2"
          />
          <label class="form-check-label" for="bank_card">Bank Card</label>
        </div>
      </div>
      <div class="form-group">
        <label>Delivery</label>
        <div class="form-check">
          <input
            v-model="orderApi.order.delivery_id"
            class="form-check-input"
            type="radio"
            name="deliveryRadio"
            id="shipping"
            value="1"
            checked
          />
          <label class="form-check-label" for="shipping">Shipping</label>
        </div>
        <div class="form-check">
          <input
            v-model="orderApi.order.delivery_id"
            class="form-check-input"
            type="radio"
            name="deliveryRadio"
            id="take_away"
            value="2"
          />
          <label class="form-check-label" for="take_away">Take away</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Get an order id</button>
    </form>
    <div v-if="orderCompleted">
      <div class="form-group">
        <label for="orderID">Order Tracking Number</label>
        <input
          class="form-control"
          v-model="orderApi.order.id"
          id="orderID"
          name="orderID"
          readonly
        />
        <small
          id="orderIDHelp"
          class="form-text text-muted"
        >Call +3534 and say these digits to track manually</small>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  methods: {
    onSubmit() {
      this.$store.dispatch("orderApi/updateOrder", {
        order_id: parseInt(this.orderApi.order.id, 10),
        comments: this.orderApi.order.comments,
        delivery_id: parseInt(this.orderApi.order.delivery_id, 10),
        payment_id: parseInt(this.orderApi.order.payment_id, 10)
      });
    }
  },
  computed: {
    orderCompleted() {
      return this.orderApi.order.open > 0 || true == this.orderApi.order.open;
    },
    ...mapState(["orderApi", "notification"])
  }
};
</script>

<style>
</style>
