<template>
    <div>
        <h2>Products</h2>
        <div>
            <button @click="showCreateProductForm" type="button" class="create-product-btn btn btn-success">New product</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td><button class="btn" v-on:click="sortById">ID</button></td>
                    <td><button class="btn" v-on:click="sortByTitle">Title</button></td>
                    <td><button class="btn" v-on:click="sortByPrice">Price</button></td>
                    <td colspan="2">Action</td>
                </tr>
            </thead>
            <tbody>
                <products_table_row
                    v-for="product in products"
                    :product="product"
                    :key="product.id">
                </products_table_row>
            </tbody>
        </table>

        <div id="product_delete_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Please confirm product deleting</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import products_table_row from "./products_table_row";

    export default {
        name: "products_table",

        components: {
            products_table_row
        },

        data () {
            return {
                products: [],
                sort: {
                    'field': 'id',
                    'dir': 'desc'
                }
            }
        },

        mounted () {
            this.loadProducts()
        },

        methods: {
            loadProducts: function () {
                axios
                    .get('/api/admin/getProductsTableData')
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
            },
            showCreateProductForm: function () {
                this.$parent.show = 'product_create_page';
            },
            sortById: function () {
                let dir = (this.sort.field === 'id') ? ((this.sort.dir === 'asc') ? 'desc' : 'asc') : 'asc'

                if (dir === 'desc'){
                    this.products.sort(function (a, b) {
                        return b.id - a.id
                    })
                } else {
                    this.products.sort(function (a, b) {
                        return a.id - b.id
                    })
                }

                // Set new sort order
                this.sort = {
                    'field': 'id',
                    'dir': dir
                }
            },
            sortByTitle: function () {
                let dir = (this.sort.field === 'title') ? ((this.sort.dir === 'asc') ? 'desc' : 'asc') : 'asc'

                if (dir === 'desc'){
                    this.products.sort(function (a, b) {
                        if (a.title > b.title){
                            return -1;
                        } else if (a.title < b.title) {
                            return 1;
                        } else {
                            return 0;
                        }
                    })
                } else {
                    this.products.sort(function (a, b) {
                        if (b.title > a.title){
                            return -1;
                        } else if (b.title < a.title) {
                            return 1;
                        } else {
                            return 0;
                        }
                    })
                }

                // Set new sort order
                this.sort = {
                    'field': 'title',
                    'dir': dir
                }
            },
            sortByPrice: function () {
                let dir = (this.sort.field === 'price') ? ((this.sort.dir === 'asc') ? 'desc' : 'asc') : 'asc'

                if (dir === 'desc'){
                    this.products.sort(function (a, b) {
                        return b.price - a.price
                    })
                } else {
                    this.products.sort(function (a, b) {
                        return a.price - b.price
                    })
                }

                // Set new sort order
                this.sort = {
                    'field': 'price',
                    'dir': dir
                }
            },
        }
    }
</script>
