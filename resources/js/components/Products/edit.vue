<template>
<div class="">
    <section class="content-header">
        <h1>{{ t('edit_products') }}</h1>

        <ol class="breadcrumb">

            <li>
                <router-link :to="{name: 'productIndex'}"> {{ t('all_products') }}</router-link>
            </li>
            <li class="active">{{ t('edit_products') }}</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">{{ t('edit_products') }}</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                <form @submit.prevent="productEdit" method="POST">

                  <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ t('product_name') }}<span class="text-danger">*</span></label>
                                <input v-model="form.title" type="text" class="form-control" :placeholder="t('product_name')">
                                <span class="text-danger" v-if="errors.title">{{errors.title[0]}}</span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ t('product_cat') }}<span class="text-danger">*</span></label>
                                <select class='form-control' v-model='form.category_id' style="height: 100%;">
                                    <option value='' selected>Select Category</option>
                                    <option v-for='data in categories' :value='data.id' :key="data.id">
                                        <p> {{ data.name }} </p>
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ t('product_price') }}<span class="text-danger">*</span></label>
                                <input v-model="form.price" type="number" step="any" class="form-control" :placeholder="t('product_price')">
                                <span class="text-danger" v-if="errors.price">{{errors.price[0]}}</span>
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ t('quantity') }}<span class="text-danger">*</span></label>
                                <input v-model="form.quantity" type="number" class="form-control" :placeholder="t('quantity')">
                                <span class="text-danger" v-if="errors.quantity">{{errors.quantity[0]}}</span>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ t('add') }}</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->
</div>
</template>

<script>
export default {

    name: "edit",
    data() {

        return {
            _method: 'POST',
            categories: [],
            form: {
                 title: '',
                price: '',
                quantity: '',
                category_id: '',
            },
            errors: {},
        }
    },

    created() {

        let id = this.$route.params.id;
        axios.get(BaseUrl+'/api/products/' + id)
            .then(res => {
                //this.isLoaded = true;
                this.form = res.data;

            })
            .catch(error => {});


        this.getCategories();

    },

    methods: {
        getCategories: function () {
            axios.get(BaseUrl+'/api/get_categories')
                .then(function (response) {
                      this.isLoaded = true;
                      this.isLoaded = false;
                    this.categories = response.data;
                }.bind(this));

        },

        productEdit() {
            let id = this.$route.params.id;
            axios.patch(BaseUrl+'/api/products/' + id, this.form)
                .then(res => {
                    Notification.success();
                    this.$router.push({
                        name: 'productIndex'
                    })
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                })
        },
    },

}
</script>
