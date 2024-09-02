import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        products: []
    }),
    actions: {
        addItem(item) {
            this.products.push(item)
        },
        removeItem(item) {
            this.products.splice(item, 1)
        },
        clearCart() {
            this.products = []
        }
    },
    getters: {
        itemCount: (state) => state.products.length,
        loaded: (state) => state.products.length > 0,
        items: (state) => state.products
    }
})