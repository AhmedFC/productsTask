

// products routes
let productsCreate = require('./components/Products/create.vue').default;
let productIndex = require('./components/Products/index.vue').default;
let productEdit = require('./components/Products/edit.vue').default;



export const routes = [

    // products routes
    { path: '/' + locate + '/add-product', component: productsCreate, name: 'productsCreate' },
    { path: '/' + locate + '/products', component: productIndex, name: 'productIndex' },
    { path: '/' + locate + '/product-edit/:id', component: productEdit, name: 'productEdit' },


];
