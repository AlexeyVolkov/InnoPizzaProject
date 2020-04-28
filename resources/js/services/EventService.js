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
		return apiClient.get("/customer/", {
			params: {
				customer: id
			}
		});
	},
	addCustomer() {
		return apiClient.post("/customer/");
	},
	addOrder(customer, ordered_pizzas) {
		return apiClient.post("/order/", {
			params: {
				customer: customer,
				ordered_pizzas: ordered_pizzas,
			}
		});
	},
	updateOrder(payment, delivery) {
		return apiClient.put("/order/", {
			params: {
				payment: payment,
				delivery: delivery,
			}
		});
	},
};
