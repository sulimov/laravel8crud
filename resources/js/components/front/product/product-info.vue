<template>
    <div>
        <div v-if="product.hasImages" id="productImagesSlider" class="carousel slide">
            <ol class="carousel-indicators">
                <li v-for="(index, image) in product.images" data-target="#productImagesSlider" :data-slide-to="index"></li>
            </ol>
            <div class="carousel-inner">
                <div v-for="image in product.images" class="carousel-item">
                    <img class="d-block w-100" :src="image.image" alt="">
                </div>
            </div>
            <a class="carousel-control-prev" href="#productImagesSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#productImagesSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="product-info">
            <h2>{{ product.title }}</h2>
            <h4>${{ product.price }}</h4>
            <hr>
            <p>{{ product.description }}</p>
            <hr>
            <div id="add_to_cart">
                <form :action="add_to_cart_url" method="post">
                    <input v-model="product_id" type="hidden" name="product_id"/>
                    <label>
                        <input v-model.number="count" type="number" name="count" style="width: 60px;" min="1"/>
                    </label>
                    <button v-on:click="addToCart" class="btn btn-success" type="button">Add to cart</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "productInfo",

        props : [
            'product_id',
            'add_to_cart_url'
        ],

        data () {
            return {
                product: [],
                count: 1
            }
        },

        mounted () {
            this.loadProduct(this.product_id)
            // .finally(() => this.loading = false)
        },

        methods: {
            loadProduct: function () {
                axios
                    .get('/api/product/'+this.product_id)
                    .then(response => {
                        this.product = response.data
                        // console.log('success')
                        // console.log(response.data)
                    })
                    .catch(error => {
                        // console.log('error')
                        console.log(error)
                        // this.errored = true
                    })
            },
            addToCart: function (){
                axios
                    .post(this.add_to_cart_url, {product_id: this.product_id, count: this.count})
                    .then(response => {
                        location.href = response.data.cart_url;
                        // this.product = response.data
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
