<template>
    <div class="container">
        <div class="row">
            <product-item
                v-for="product in products"
                :product="product"
                :key="product.id"
            ></product-item>
        </div>
    </div>
</template>

<script>
    import productItem from "./productItem";

    export default {
        name: "productsGallery",

        components: {
            productItem,
        },

        data () {
            return {
                products: []
            }
        },

        mounted () {
            this.loadProducts()
            // .finally(() => this.loading = false)
        },

        methods: {
            loadProducts: function () {
                axios
                    .get('/api/getProductsList')
                    .then(response => {
                        this.products = response.data
                        // console.log('success')
                        // console.log(response.data)
                    })
                    .catch(error => {
                        // console.log('error')
                        console.log(error)
                        // this.errored = true
                    })
            }
        }
    }
</script>
