<template>
    <div class="col-md-6 col-lg-4 g-mb-30">
        <article class="u-shadow-v18 g-bg-white text-center rounded g-px-20 g-py-40 g-mb-5">
            <a :href="product.url">
                <img class="d-inline-block img-fluid mb-4" :src="product.mainImageUrl" alt="Product"/>
            </a>
            <h4 class="h5 g-color-black g-font-weight-600 g-mb-10">
                <a :href="product.url">{{ product.title }}</a>
            </h4>
            <span class="d-block g-color-primary g-font-size-16">${{ product.price }}</span>
        </article>
    </div>
</template>

<script>
    export default {
        props: [
            'product'
        ]
    }
</script>
