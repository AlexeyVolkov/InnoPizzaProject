import axios from "axios";

const apiClient = axios.create({
	baseURL: "http://localhost:8000/",
	withCredentials: false,
	headers: {
		Accept: "application/json",
		"Content-Type": "application/json"
	}
});

export default {
	getPizzas(sortMethod) {
		return apiClient.get("/api/pizzas/", {
			params: {
				sort: sortMethod
			}
		});
	},
	getPizza(id) {
		return apiClient.get("/api/pizza/", {
			params: {
				id: id
			}
		});
	},
	getCustomer(id) {
		return apiClient.get("/api/customer/" + id);
	},
	addCustomer() {
		return apiClient.post("/api/customer/");
	},
	addOrder(customer, ordered_pizzas) {
		return apiClient.post("/api/order/", {
			params: {
				customer: customer,
				ordered_pizzas: ordered_pizzas,
			}
		});
	},
	updateOrder(payment, delivery) {
		return apiClient.put("/api/order/", {
			params: {
				payment: payment,
				delivery: delivery,
			}
		});
	},
};
