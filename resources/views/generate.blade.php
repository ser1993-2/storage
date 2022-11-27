@extends('layouts.app')

@section('content')
    <div id="app">
        <h2>Генератор пароля / PIN-кода</h2>

        <input type="number" class="form-control rounded-3" placeholder="Длина пин" v-model="lengthPin">

        <button class="btn btn-success" v-on:click="generatePin" >
            Сгенерировать PIN
        </button>

        <h4 style="color: red">@{{ pin }}</h4>

        <hr>
        <input type="number" class="form-control rounded-3" placeholder="Длина пароля" v-model="lengthPass">

        <button class="btn btn-success" v-on:click="generatePass" >
            Сгенерировать PASS
        </button>

        <h4 style="color: red">@{{ pass }}</h4>

    </div>

    <script>
        const { createApp } = Vue

        createApp({
            data() {
                return {
                    pin : '',
                    lengthPin : '',
                    pass : '',
                    lengthPass : '',
                }
            },
            created() {
            },
            methods: {
                generatePin() {
                    axios.post('/api/generate/pin', { 'length' : this.lengthPin})
                        .then(response => {
                            this.pin = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка генирации");
                        });
                },
                generatePass() {
                    axios.post('/api/generate/pass', { 'length' : this.lengthPass})
                        .then(response => {
                            this.pass = response.data;
                        })
                        .catch(error => {
                            alert("Ошибка генирации");
                        });
                },
            },
        }).mount('#app')
    </script>
@endsection
