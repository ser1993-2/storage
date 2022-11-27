@extends('layouts.app')

@section('content')
    <div id="app">
        <h2> Продукты</h2>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle align-text-bottom" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
            Добавить
        </button>

        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
                <th scope="col">Категория</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products">
                <td>@{{ product.id }}</td>
                <td>@{{ product.name }}</td>
                <td>@{{ product.price }}</td>
                <td>@{{ product.category_name }} (@{{ product.category_id }})</td>
                <td>
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" v-on:click="editProduct = product" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">Редактировать</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" v-on:click="deleteProduct(product.id)">Удалить</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

{{--        modal add--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить категорию</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="Чайник" v-model="newProduct.name">
                            <label for="floatingInput">Название</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control rounded-3" id="floatingInput" placeholder="99" v-model="newProduct.price">
                            <label for="floatingInput">Цена</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" v-model="newProduct.category_id">
                                <option v-for="category in categories" v-bind:value="category.id">
                                    @{{ category.name }}
                                </option>
                            </select>
                            <label for="floatingInput2">Категория</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" v-on:click="createProduct" data-bs-dismiss="modal">Добавить</button>
                    </div>
                </div>
            </div>
        </div>

        {{--        modal edit--}}
        <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Редактировать категорию</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="Чайник" v-model="editProduct.name">
                            <label for="floatingInput">Название</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control rounded-3" id="floatingInput" placeholder="99" v-model="editProduct.price">
                            <label for="floatingInput">Цена</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Default select example" v-model="editProduct.category_id">
                                <option v-for="category in categories" v-bind:value="category.id">
                                    @{{ category.name }}
                                </option>
                            </select>
                            <label for="floatingInput2">Категория</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" v-on:click="updateProduct" data-bs-dismiss="modal">Редактировать</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    categories: {},
                    products : {},
                    newProduct: {},
                    editProduct: {},
                }
            },
            created() {
                this.getCategories();
                this.getProducts();
            },
            methods: {
                getProducts() {
                    axios.get('/api/product/')
                        .then(response => {
                            this.products = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки продукта");
                        });
                },
                getCategories() {
                    axios.get('/api/category/')
                        .then(response => {
                            this.categories = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки категорий");
                        });
                },
                createProduct() {
                    axios.post('/api/product/', this.newProduct)
                        .then(response => {
                            this.getProducts();
                            this.resetNewProduct();
                        })
                        .catch(error => {
                            alert("Ошибка создания продукта");
                        });
                },
                deleteProduct(id) {

                    if (!confirm('Вы уверены?')) {
                        return;
                    }

                    axios.delete('/api/product/' + id,)
                        .then(response => {
                            this.getProducts();
                        })
                        .catch(error => {
                            alert("Ошибка удаления продукта");
                        });
                },
                updateProduct() {
                    axios.put('/api/product/' + this.editProduct.id, this.editProduct)
                        .then(response => {
                            this.getProducts();
                        })
                        .catch(error => {
                            alert("Ошибка редактирования продукта");
                        });
                },
                resetNewProduct() {
                   this.newCategory = {
                       'name' : '',
                       'price' : '',
                       'category_id' : null,
                   }
                },
            },
        }).mount('#app')
    </script>
@endsection
