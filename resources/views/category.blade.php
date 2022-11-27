@extends('layouts.app')

@section('content')
    <div id="app">
        <h2 style="text-align: center">Категория @{{categoryId}}</h2>

        <hr>
        {{--        ------------------------------------------------------------------------------}}
        <h2>Получение одной категории c вложенными товарами</h2>
        <h4 style="color: green">/api/categories/@{{ this.categoryId }}</h4>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>@{{ categoryWithProductById.id }}</td>
                <td>@{{ categoryWithProductById.name }}</td>
                <td>
                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" v-bind:href="'#multiById' + categoryWithProductById.id" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Продукты</a>
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" v-bind:id="'multiById' + categoryWithProductById.id">
                                <div class="card card-body">

                                    <table class="table table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название</th>
                                            <th scope="col">Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="product in categoryWithProductById.products">
                                            <td>@{{ product.id }}</td>
                                            <td>@{{ product.name }}</td>
                                            <td>@{{ product.price }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <hr>
        {{--        ------------------------------------------------------------------------------}}
        <h2>Получение списка товаров из категории</h2>
        <h4 style="color: green">/api/categories/@{{ this.categoryId }}/products</h4>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in productsByCategoryId">
                <td>@{{ product.id }}</td>
                <td>@{{ product.name }}</td>
                <td>@{{ product.price }}</td>
            </tr>
            </tbody>
        </table>

        <hr>
        {{--        ------------------------------------------------------------------------------}}
        <h2>Получение списка товаров из категории</h2>
        <h4 style="color: green">/api/categories/@{{ this.categoryId }}/products</h4>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Цена</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in allProductsByCategoryId">
                <td>@{{ product.id }}</td>
                <td>@{{ product.name }}</td>
                <td>@{{ product.price }}</td>
            </tr>
            </tbody>
        </table>

        <hr>
        {{--        ------------------------------------------------------------------------------}}
        <h2>Получение списка товаров из категории и всех вложенных в неё категорий одним списком</h2>
        <h4 style="color: green">/api/categories/</h4>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categoryWithProduct">
                <td>@{{ category.id }}</td>
                <td>@{{ category.name }}</td>
                <td>
                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" v-bind:href="'#multi' + category.id" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Продукты</a>
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="collapse multi-collapse" v-bind:id="'multi' + category.id">
                                <div class="card card-body">

                                    <table class="table table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название</th>
                                            <th scope="col">Цена</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="product in category.products">
                                            <td>@{{ product.id }}</td>
                                            <td>@{{ product.name }}</td>
                                            <td>@{{ product.price }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

    </div>

    <script>
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    categoryId : {{ $id }},
                    categoryWithProduct : {},
                    categoryWithProductById : {},
                    productsByCategoryId : {},
                    allProductsByCategoryId : {},
                }
            },
            created() {
                this.getCategoryWithProduct();
                this.getCategoryWithProductById();
                this.getProductsByCategoryId();
                this.getAllProductsByCategoryId();
            },
            methods: {
                getCategoryWithProduct() {
                    axios.get('/api/categories/')
                        .then(response => {
                            this.categoryWithProduct = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки");
                        });
                },
                getCategoryWithProductById() {
                    axios.get('/api/categories/' + this.categoryId)
                        .then(response => {
                            this.categoryWithProductById = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки");
                        });
                },
                getProductsByCategoryId() {
                    axios.get('/api/categories/' + this.categoryId + '/products')
                        .then(response => {
                            this.productsByCategoryId = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки");
                        });
                },
                getAllProductsByCategoryId() {
                    axios.get('/api/categories/' + this.categoryId + '/allProducts')
                        .then(response => {
                            this.allProductsByCategoryId = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка загрузки");
                        });
                },
            },
        }).mount('#app')
    </script>
@endsection
