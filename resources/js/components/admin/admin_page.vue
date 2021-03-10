<template>
    <div>
        <div v-if="show === 'products_list_page'" id="products_table">
            <products_table></products_table>
        </div>

        <div v-if="show === 'product_create_page'" id="product_create">
            <product_create></product_create>
        </div>
    </div>
</template>

<script>
    import products_table from "./products_table";
    import product_create from "./product_create";

    export default {
        name: "admin_page",

        components: {
            products_table,
            product_create
        },

        data () {
            return {
                show: 'products_list_page'
            }
        }
    }
</script>
