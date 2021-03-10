<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.title }}</td>
        <td>{{ product.price }}</td>
        <td><a :href="product.edit_url" class="btn btn-primary">Edit</a></td>
        <td><button type="button" data-toggle="modal" data-target="#product_delete_modal" class="btn btn-danger">Delete</button></td>
    </tr>
</template>

<script>
    export default {
        name: "products_table_row",

        props: [
            'product'
        ]
    }
</script>
