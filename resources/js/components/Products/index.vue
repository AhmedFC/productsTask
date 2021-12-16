<template>
<div class="">
    <section class="content-header">

        <h1> {{ t('products') }} </h1>

        <ol class="breadcrumb">

            <li class="active"> {{ t('products') }} </li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">{{ t('products') }} <small></small></h3>

                <div class="row">

                    <div class="col-md-4">
                        <input type="text" class="form-control" :placeholder=" t('search') " @keyup="searchit" v-model="search">
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-primary" @click="searchit"><i class="fa fa-search"></i> {{ t('search') }}</button>

                        <router-link class="btn btn-primary" :to="{name: 'productsCreate'}" v-if="selectedPermissions.indexOf('create_products') !== -1"><i class="fa fa-plus"></i> {{ t('add') }}</router-link>

                        <a href="#" class="btn btn-primary disabled" v-else><i class="fa fa-plus"></i> {{ t('add') }}</a>

                    </div>

                </div>

            </div><!-- end of box header -->

            <div class="box-body">
                <div v-if="isLoaded">
                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ t('product_name') }}</th>
                                <th>{{ t('product_cat') }}</th>
                                <th>{{ t('quantity') }}</th>
                                <th>{{ t('product_price') }}</th>
                                <th>{{ t('action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(product,index) in products.data" :key="index">

                                <td>{{index+1}}</td>
                                <td> {{product.title }}</td>
                                <td> {{product.category.name }}</td>
                                <td> {{product.quantity }}</td>
                                <td> {{product.price }}</td>
                                <td style="display: flex;">
                                    <router-link :to="{name:'productEdit',params:{id:product.id}}" class="btn-sm btn-primary"><i class="fa fa-edit"></i></router-link>
                                    <a @click="productDel(product.id)" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                        </tbody>

                    </table><!-- end of table -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>

                </div>

                <div v-else>
                    <circle-spin loading="isLoaded"></circle-spin>
                </div>

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->
</div>
</template>

<script>
export default {

    data() {
        return {
            lang: '',
            selectedPermissions: [],
            isLoaded: false,
            products: {},
            search: '',
        }
    },

    methods: {
        getResults(page = 1) {
            axios.get(BaseUrl+'/api/products?page=' + page)
                .then(response => {
                    this.isLoaded = true;
                    this.products = response.data;
                });
        },

        searchit: _.debounce(() => {
            Fire.$emit('searching');
        }, 1000),

        productDel(id) {
            Swal.fire({
                title: this.t('Are_you_sure?'),
                text: this.t("You_won't_be_able_to_revert_this!"),
                icon: 'warning',
                showCancelButton: true,
                customClass: 'swalicon',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: this.t("Yes_delete_it!"),
                cancelButtonText: this.t("cancel")
            }).then((result) => {
                if (result.value) {
                    axios.delete(BaseUrl+'/api/products/' + id)
                        .then(() => {
                            Notification.success();
                            this.getResults();

                        }).catch(() => {
                            this.$router.push({
                                name: 'products'
                            })
                        })
                }

            })
        }
    },

    mounted() {
        this.selectedPermissions = Permissions;
        this.lang = locate;
        this.getResults();
    },
    created() {
        Fire.$on('searching', () => {
            let query = this.search;
            axios.get(BaseUrl+'/api/findProduct?q=' + query)
                .then((data) => {
                    this.products = data.data;
                })
                .catch(() => {

                })
        });

    }

}
</script>

<style>
.swalicon {
    font-size: 1.6rem !important;
}
</style>
