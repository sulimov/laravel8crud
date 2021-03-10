<template>
    <div>
        <div v-if="hasErrors" class="alert alert-danger">
<!--            <ul>-->
                <errors_block v-for="(error, index) in errors" :error="error" :key="index"></errors_block>
<!--            </ul>-->
        </div><br/>

        <div v-if="success" class="alert alert-success">
            {{ successText }}
        </div><br />

        <div class="card-header">
            Create new product
        </div>
        <div class="card-body">
            <form name="product_create_form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" v-model="title"/>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea rows=8 class="form-control" name="description" v-model="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" name="price" v-model="price"/>
                </div>
                <div class="form-group">
                    <label for="image">Upload new image:</label>
                    <input id="image" type="file" name="image" ref="image" accept="image/x-png,image/gif,image/jpeg" @change="handleImageUpload"/>
                </div>
                <button type="button" @click="submit_form" class="btn btn-primary">Save</button>
                <a class="btn btn-secondary" href="/admin/products">Back</a>
            </form>
        </div>
    </div>
</template>

<script>
    import errors_block from "./errors_block";

    export default {
        name: "product_create",

        components: {
            errors_block
        },

        data(){
            return {
                title: '',
                description: '',
                price: '',
                image: '',

                hasErrors: false,
                errors: [],

                success: false,
                successText: ''
            }
        },

        methods: {
            handleImageUpload: function () {
                this.image = this.$refs.image.files[0];
            },
            validateFormFields: function () {
                if (this.title === ''){
                    return false;
                }

                if (this.price === ''){
                    return false;
                }

                return true;
            },
            hideErrors: function () {
                this.errors = []
                this.hasErrors = false
            },
            showSuccess: function (successText) {
                this.success = true
                this.successText = successText
            },
            submit_form: function () {
                this.hideErrors()

                /*if (!this.validateFormFields()){
                    return;
                }*/

                let formData = new FormData(document.forms.product_create_form);

                axios
                    .post('/api/admin/products/store', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        console.log(response.data);

                        if (response.data.success){
                            this.hideErrors()
                            this.showSuccess(response.data.success)
                        }
                    })
                    .catch(error => {
                        console.log(error.response)
                        if (error.response.data){
                            this.errors = error.response.data.errors
                        }
                        // TODO: unexpected error
                        this.hasErrors = true
                    })
            }
        }
    }
</script>
