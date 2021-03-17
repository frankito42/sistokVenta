let todosLosArticulosCategorias
async function listarArticulos() {
  await fetch('php/listarArticulos.php')
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
      
    return todosLosArticulosCategorias=data
  });
    
}
async function listarProveedores() {
  await fetch('php/listarProveedores.php')
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
    let option=`<option value="" selected disabled>Seleccionar proveedor</option>`
    data.forEach(element => {
      option+=`<option value="${element.idProveedor}">${element.nombreP}</option>`
    });
    document.getElementById("selectProvedorAumentar").innerHTML=option
  });
    
}

function subirPorcentajeEnPreciosProveedor() {
  let porcentaje=document.getElementById("porcentajeFiltro").value
  let proveedor=document.getElementById("selectProvedorAumentar").value
  if(proveedor&&porcentaje){
    fetch("php/aumentarPrecio.php?porcentaje="+porcentaje+"&idPro="+proveedor)
          .then(respuesta => {
                $("#modalPorcentaje").modal("hide")
                listarArticulos().then(async()=>{
                  await traerPoductoGalpon(document.getElementById("establecimientos").value)
                })
             }
          );
  }else{
    if(!porcentaje){
      document.getElementById("porcentajeFiltro").style.borderColor="red"
    }
    if(!proveedor){
      document.getElementById("selectProvedorAumentar").style.borderColor="red"
    }
  }
  
}
document.getElementById("porcentajeFiltro").addEventListener("click",()=>{
  document.getElementById("porcentajeFiltro").style.borderColor=""
})
document.getElementById("selectProvedorAumentar").addEventListener("click",()=>{
  document.getElementById("selectProvedorAumentar").style.borderColor=""
})


listarArticulos().then(async()=>{
  await dibujarTabla(todosLosArticulosCategorias[1])
  await dibujarCategorias(todosLosArticulosCategorias[0])
  await dibujarSelect(todosLosArticulosCategorias[2])
  await listarProveedores()
})

/* console.log(todosLosArticulosCategorias) */


$(document).ready(function(){
  $("#filtroProductos").keyup(function(){
  _this = this;
  // Show only matching TR, hide rest of them
  $.each($("#mytable tbody tr"), function() {
  if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
  $(this).hide();
  else
  $(this).show();
  });
  });
 });


 async function abrirModalEdit(id) {
  let filtroArray= todosLosArticulosCategorias[1].find((m) => m.articulo === `${id}`);
  console.log("Es: " + filtroArray.nombre );
  
  /* creo el select de categorias en el modal editar */

    if(document.getElementById(`articulo${id}`)){
      $(document.getElementById(`articulo${id}`)).modal("show")
    }else{
      let optionsCategoria=``
    todosLosArticulosCategorias[0].forEach(element => {
      optionsCategoria+=`
      <option ${(element.idCategoria==filtroArray.categoria)?"selected":""} value="${element.idCategoria}">${element.nombreCategoria}</option>
      `
    });
      let modalEdit=`
                <div class="modal fade" id="articulo${id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div style="background:#33b5e5;" class="modal-header text-white">
                          <h4 class="modal-title heading lead" id="myModalLabel">Editar un producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span style="color: white;" aria-hidden="true">&times;</span>
                      </button>
                            
                        </div>
                        <div class="modal-body">
                  <div class="container-fluid">
                  <form enctype="multipart/form-data">
                    <div class="row">
                      <div class="col">
                        <div class="md-form">
                            <input required type="text" id="nombreEdit${id}" value="${filtroArray.nombre}" name="nombreEdit" class="form-control">
                            <label for="nombreEdit${id}" class="active">Nombre del articulo</label>
                        </div>
                      </div>
                        <div class="col">
                          <div class="md-form">
                              <input type="text" id="codBarraEdit${id}" name="codBarraEdit" value="${filtroArray.codBarra}" class="form-control">
                              <label for="codBarraEdit${id}" class="active">Codigo de barra</label>
                          </div>
                        </div>
                    </div>
                    

                      <div class="row">
                        <div class="col">
                          <div class="md-form">
                            <input required type="number" id="stockminEdit${id}" value="${filtroArray.stockmin}" name="stockminEdit" class="form-control">
                            <label for="stockminEdit${id}" class="active">Stock minino</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="md-form">
                            <input type="number" id="cantidadEdit${id}" value="${filtroArray.cantidad}" name="cantidad" class="form-control">
                            <label for="cantidadEdit${id}" class="active">Cantidad</label>
                          </div>
                        </div>
                      </div>
                      


                      <div class="md-form">
                          <textarea id="descripcionEdit${id}" name="descripcionEdit" class="md-textarea form-control" rows="2">${filtroArray.descripcion}</textarea>
                          <label for="descripcionEdi${id}t" class="active">Descripcion</label>
                      </div>


                    <div class="form-group">
                        <div class="row">
                          <div class="col">
                            <div class="md-form">
                              <input required type="number" id="costoArticuloEdit${id}" value="${filtroArray.costo}" name="costoArticulo" class="form-control">
                              <label for="costoArticuloEdit${id}" class="active">Costo</label>
                            </div>
                          </div>
                          <div class="col">
                            <div class="md-form">
                              <input type="number" id="precioArticuloEdit${id}" value="${filtroArray.precioVenta}" name="precioArticulo" class="form-control">
                              <label for="precioArticuloEdit${id}" class="active">Precio de venta</label>
                            </div>
                          </div>
                        </div>
                    </div>
                    
                    <div class="row">
                  
                    
                        <select id="selectCategoriaEdit${id}" required class="form-control">
                        <option value="">Categoria</option>
                        ${optionsCategoria}
                        
                        </select>
                    
                  
                    
                    </div>
                        </div> 
                  </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                            <button onclick="guardarEditArticulo(${id})" name="add" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</a>
                  </form>
                        </div>

                    </div>
                </div>
              </div>`
        
              $(modalEdit).modal("show")
    }
   
 }



 async function dibujarTabla(articulosStock) {
  let tablaArticulos=``
  let imagen=``
  console.log(articulosStock)
  articulosStock.forEach(element => {
    imagen=`<img style="width: 100%;" src="${element['imagen']}">`
    /* <td>${element['costo']}</td>
    <td>${element['descripcion']}</td> */
    tablaArticulos+=`
    <tr>
    <td>${element['nombre']}</td>
    <td>${element['precioVenta']}</td>
    <td>${element['cantidad']}</td>
    <td>${element['nombreEsta']}</td>
    <td>${element['nombreCategoria']}</td>
    <td style="width: 8%">${(element['imagen']!="")?imagen:"Img"}</td>
    <td><button onclick="abrirModalEdit(${element['articulo']})" class="btn btn-blue">Editar</button></td>
    </tr>
    `
  });
  document.getElementById("articulosTabla").innerHTML=tablaArticulos
 }

 async function dibujarSelect(options) {
  let dibujarOptions=`<option disabled value="" selected>Establecimiento</option>
                      <option value="">Todos los articulos</option>`
  options.forEach(element => {
    
  
    dibujarOptions+=`
    <option value="${element.idEsta}">${element.nombreEsta}</option>
    `
  });
  /* SELECT DE TODOS LOS ESTABLECIMIENTOS */
  document.getElementById("establecimientos").innerHTML=dibujarOptions

  /* SELECT DEL MODAL AÑADIR NUEVO PRODUCTO *//* SELECT DEL MODAL AÑADIR NUEVO PRODUCTO */
  document.getElementById("newArticuloEnEstablecimiento").innerHTML=dibujarOptions
  /* REMUEVO LA OPCION TODOS LOS ARTICULOS */
  document.getElementById("newArticuloEnEstablecimiento").children[1].remove()

  

  document.getElementById("establecimientos").addEventListener("change",()=>{
    traerPoductoGalpon(document.getElementById("establecimientos").value)
  })
 }
 async function dibujarCategorias(categorias) {
  let dibujarCategorias=`<option value="" disabled selected>Categorias</option>`
  categorias.forEach(element => {
    
  
    dibujarCategorias+=`
    <option value="${element.idCategoria}">${element.nombreCategoria}</option>
    `
  });
  document.getElementById("categoriaNew").innerHTML=dibujarCategorias
 }

 async function traerPoductoGalpon(id) {
  await fetch('php/listarArticulos.php?id='+id)
  .then(response => response.json())
  .then(async (data)=>{
    console.log(data)
    await dibujarTabla(data[1])

    return todosLosArticulosCategorias=data
  });
   
 }

 /* //////////////////////////////////////////////////////////////////////////////////// */
 /* //////////////////////////////////////////////////////////////////////////////////// */
 document.getElementById("guardarEstablecimiento").addEventListener("click",()=>{
   let nombreEsta=document.getElementById("nombreEstablecimiento").value
   if(nombreEsta==""){
     console.log(nombreEsta)
     document.getElementById("nombreEstablecimiento").style.borderColor="red";
     document.getElementById("labelIdEstablecimineto").style.color="red";
     document.getElementById("errorEstablecimiento").classList.add("zoomIn")
     document.getElementById("errorEstablecimiento").style.display="block"
     $('#errorEstablecimiento').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
       document.getElementById("errorEstablecimiento").classList.remove("zoomIn")
    });
   }else{
     fetch('php/addEstablecimiento.php?nEstablecimineto='+nombreEsta)
      .then(response => response.json())
      .then(async (data)=>{
        if(data=="perfecto"){
          listarArticulos().then(async()=>{
            await dibujarSelect(todosLosArticulosCategorias[2])
            vaciarEstablecimiento()
            $("#modalNewEstablecimiento").modal("hide")
          })
        }
      });
   }
 })
 document.getElementById("nombreEstablecimiento").addEventListener("click",()=>{
   if(document.getElementById("nombreEstablecimiento").style.borderColor=="red"){
      document.getElementById("nombreEstablecimiento").style.borderColor="";
      document.getElementById("labelIdEstablecimineto").style.color="";
      document.getElementById("errorEstablecimiento").classList.add("zoomOut")
      $('#errorEstablecimiento').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("errorEstablecimiento").classList.remove("zoomOut")
        document.getElementById("errorEstablecimiento").style.display="none"
    });
  }
 })
  /* //////////////////////////////////////////////////////////////////////////////////// */
 /* //////////////////////////////////////////////////////////////////////////////////// */
 document.getElementById("guardarNewProducto").addEventListener("click",(e)=>{
      let entraNoEntra=false
      e.preventDefault()
      let articulo = {
        nombre:document.getElementById("newNombreA"),
        establecimiento:document.getElementById("newArticuloEnEstablecimiento"),
        stockMinA:document.getElementById("stockMinA"),
        descripcionNewA:document.getElementById("descripcionNewA"),
        categoriaNew:document.getElementById("categoriaNew"),
        codBarraNew:document.getElementById("codBarraNew")
      };
      let articuloValues = {
        nombre:document.getElementById("newNombreA").value,
        establecimiento:document.getElementById("newArticuloEnEstablecimiento").value,
        stockMinA:document.getElementById("stockMinA").value,
        descripcionNewA:document.getElementById("descripcionNewA").value,
        categoriaNew:document.getElementById("categoriaNew").value,
        codBarraNew:document.getElementById("codBarraNew").value
      };
      console.log(articulo)
      for (const property in articulo) {
        if(articulo[property].value==""){
          articulo[property].style.borderColor="red"
          console.log(`${property} vacio`)
          entraNoEntra=true
        }
        if(entraNoEntra==true){
          document.getElementById("erroAddNewProducto").classList.add("zoomIn")
          document.getElementById("erroAddNewProducto").style.display="block"
          $('#erroAddNewProducto').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
            document.getElementById("erroAddNewProducto").classList.remove("zoomIn")
          });
        }
        

        articulo[property].addEventListener("click",()=>{
          /* console.log(articulo[property].style.display) */
          if(document.getElementById("erroAddNewProducto").style.display=="block"){
            document.getElementById("erroAddNewProducto").classList.add("zoomOut")
            articulo[property].style.borderColor=""
            $('#erroAddNewProducto').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
              document.getElementById("erroAddNewProducto").classList.remove("zoomOut")
              document.getElementById("erroAddNewProducto").style.display="none"
            });
          }else{
            articulo[property].style.borderColor=""
          }
        })
      
      }
      if(entraNoEntra==false){
        let inputFile = document.querySelector("#inputFile");
        
        let formData = new FormData();
            formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
            formData.append("articulo", JSON.stringify(articuloValues)); // En la posición 0; es decir, el primer elemento
            fetch("php/addNewProduct.php", {
                method: 'POST',
                body: formData,
            }).then(respuesta => respuesta.json())
                .then(decodificado => {
                  console.log(decodificado)
                    if (decodificado=="perfecto") {
                      $("#addnew").modal("hide")
                      vaciarFormularioNew()
                      listarArticulos().then(async()=>{
                        await dibujarTabla(todosLosArticulosCategorias[1])
                      })
                    }
                });
      }
  
 })

 function guardarEditArticulo(id) {
   console.log(id)
   let articuloEditado = {
    articulo:id,
    nombreEdit:document.getElementById("nombreEdit"+id).value,
    costoEdit:document.getElementById("costoArticuloEdit"+id).value,
    precioEdit:document.getElementById("precioArticuloEdit"+id).value,
    stockMinEdit:document.getElementById("stockminEdit"+id).value,
    cantidadEdit:document.getElementById("cantidadEdit"+id).value,
    descripcionEdit:document.getElementById("descripcionEdit"+id).value,
    categoriaEdit:document.getElementById("selectCategoriaEdit"+id).value,
    codBarraEdit:document.getElementById("codBarraEdit"+id).value
  };

  let datosEnviar = new FormData();
  datosEnviar.append("articulo", JSON.stringify(articuloEditado));

  fetch("php/editarArticulo.php?id=", {
    method: 'POST',
    body: datosEnviar,
    }).then(respuesta => respuesta.json())
        .then(decodificado => {
          console.log(decodificado)
            if (decodificado=="perfecto") {
              $("#articulo"+id).modal("hide")
              listarArticulos().then(async()=>{
                await traerPoductoGalpon(document.getElementById("establecimientos").value)
              })
            }
        });

  console.log(articuloEditado)
 }

 function subirPorcentajeEnPrecios() {
   let porcentaje=document.getElementById("porcentaje").value
   if(porcentaje){
    fetch("php/aumentarPrecio.php?porcentaje="+porcentaje)
          .then(respuesta => {
                $("#modalPorcentaje").modal("hide")
                listarArticulos().then(async()=>{
                  await traerPoductoGalpon(document.getElementById("establecimientos").value)
                })
            }
          );
    }else{
      document.getElementById("porcentaje").style.borderColor="red"
    }
 }
 document.getElementById("porcentaje").addEventListener("click",()=>{
  document.getElementById("porcentaje").style.borderColor=""
 })
/* MODAL DONDE CAMBIO EL TIPO DE FILTRO PARA PONER UN PORCENTAJE GENERAL O ESPECIFICO */
 document.getElementById("botonAvanzadoPorcentaje").addEventListener("click",()=>{
  document.getElementById("modalBody").classList.add("fadeOutRight")
  /* oculto un boton y muestro el otro en el modal  */
  document.getElementById("porcentajeNormal").style.display="none"
  document.getElementById("porcentajePorProveedor").style.display="block"
  /* oculto un boton y muestro el otro en el modal  */
  $('#modalBody').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
    document.getElementById("modalBody").classList.remove("fadeOutRight")
    document.getElementById("modalBody").style.display="none"
    document.getElementById("modalBody2").classList.add("fadeInRight")
    document.getElementById("modalBody2").style.display="block"
    
  });
 })
 /* MODAL DONDE CAMBIO EL TIPO DE FILTRO PARA PONER UN PORCENTAJE GENERAL O ESPECIFICO */
 document.getElementById("botonAvanzadoPorcentaje2").addEventListener("click",()=>{
   document.getElementById("porcentajePorProveedor").style.display="none"
    document.getElementById("porcentajeNormal").style.display="block"
   document.getElementById("modalBody2").style.display="none"
   document.getElementById("modalBody").classList.add("fadeInRight")
   document.getElementById("modalBody").style.display="block"
   $('#modalBody').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
    document.getElementById("modalBody").classList.remove("fadeOutRight")
    
  });
 })

 function vaciarFormularioNew() {
  document.getElementById("newNombreA").value=""
  document.getElementById("newArticuloEnEstablecimiento").value=""
  document.getElementById("stockMinA").value=""
  document.getElementById("descripcionNewA").value=""
  document.getElementById("categoriaNew").value=""
  document.getElementById("codBarraNew").value=""
  console.log("vacioNew")
 }

 function vaciarEstablecimiento() {
  document.getElementById("nombreEstablecimiento").value=""
  console.log("vacioEsta")
 }
