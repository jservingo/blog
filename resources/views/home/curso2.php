<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  -->

  <title>Hello, world!</title>
</head>

<body>
  <div class="container mt-5" id="app">

    <h3>{{titulo}}</h3>

    <input type="text" class="form-control my-3" v-model="nuevaTarea" v-on:keyup.enter="agregarTarea">
    <button class="btn btn-primary" @click="agregarTarea">Agregar</button>

    <div class="mt-3" v-for="(item, index) of tareas">

      <div role="alert" 
      :class="['alert', item.estado ? 'alert-success' : 'alert-danger']">
        <div class="d-flex justify-content-between align-items-center">

          <div>
            {{index}} - {{item.nombre}} - {{item.estado}}
          </div>
          <div>
            <button class="btn btn-success btn-sm" @click="editarTarea(index)">OK</button>
            <button class="btn btn-danger btn-sm" @click="eliminar(index)">X</button>
          </div>

        </div>
      </div>

    </div>

  </div>

  <script src="/js/vue.js"></script>
  <script src="/js/curso2.js"></script>
</body>

</html>