<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hola mundo con Vue.js</title>
</head>

<body>

  <!--
  <div id="app">

    <h1>{{titulo}}</h1>

    <ul>
      <li v-for="fruta of frutas">
        {{fruta.cantidad}} - {{fruta.nombre}}
        <span v-if="fruta.cantidad === 0"> - Sin Stock</span>
      </li>
    </ul>

  </div>
  -->

  <div id="app">
    <h1>{{titulo}}</h1>
    <input type="text" v-model="nuevaFruta" @keyup.enter="agregarFruta">
    <button @click="agregarFruta">Agregar</button>
    <ul>
      <li v-for="fruta of frutas">
        <input type="number" v-model.number="fruta.cantidad">
        {{fruta.nombre}}
        <button @click="fruta.cantidad = fruta.cantidad + 1">+</button>
        <span v-if="fruta.cantidad === 0"> - Sin Stock</span>
      </li>
    </ul>
    <h4>TOTAL: {{sumarFrutas}}</h4>
  </div>
  
  <!-- development version, includes helpful console warnings -->
  <script src="/js/vue.js"></script>
  <script src="/js/curso.js"></script>
</body>

</html>