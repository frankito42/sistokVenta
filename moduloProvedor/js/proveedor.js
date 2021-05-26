let todosLosProveedores
document.addEventListener("DOMContentLoaded",async function() {
    console.log("DOM fully loaded and parsed");
    await listarProveedores()
});
function vaciarFromPro() {
  document.getElementById("nombreProveedor").value=""
  document.getElementById("direccionProveedor").value=""
  document.getElementById("telefonoProveedor").value=""
  document.getElementById("informacionExtra").value=""
}

async function listarProveedores() {
    fetch('php/listarProveedores.php')
    .then(response => response.json())
    .then((data)=> {
        console.log(data)
        let listar=``
        data.forEach(element => {
            listar+=`<div class="row">
                        <div style="padding: 2%;background: #383742b8;border-radius: 22px;margin-left: 6%;margin-right: 6%;box-shadow: 0px 0px 20px 0px #00000047;" class="col">
                        <h3>${element.nombreP}</h3>
                        </div>
                    </div>
                    <div style="margin-bottom: 3%;padding-top: 6% !important;background: #7188a0c9;border-radius: 12px;padding: 1%;margin-top: -6%;box-shadow: 0px 0px 20px 0px #00000059;">
                        <div class="row">
                            <div class="col">
                            <h4 style="    text-shadow: 0px 0px 20px black;">Direccion</h4>
                            <h5>${element.direccionP}</h5>
                            </div>
                            <div class="col">
                            <h4 style="    text-shadow: 0px 0px 20px black;">Telefono</h4>
                            <h5>${element.telefonoP}</h5>
                            </div>
                            <div class="col-sm">
                            <h4 style="    text-shadow: 0px 0px 20px black;">Info extra</h4>
                            <h5>${element.informacionExtra}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div style="color:red;" class="col">
                            <button onclick="abrirModalEdit(${element.idProveedor})" class="btn btn-blue">Editar</button>
                            <button onclick="abrirModalDelete(${element.idProveedor},'${element.nombreP}')" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    `

        });
        document.getElementById("proveedores").innerHTML=listar

        return todosLosProveedores=data
    
    });
}

document.getElementById("addNewproveedor").addEventListener("click",()=>{
    let proveedorNew = {
        nombre:document.getElementById("nombreProveedor").value,
        direccion:document.getElementById("direccionProveedor").value,
        telefono:document.getElementById("telefonoProveedor").value,
        informacionExtra:document.getElementById("informacionExtra").value,
      };
    let trueOfalse=true
      for (const property in proveedorNew) {
          if(proveedorNew[property]==""){
            trueOfalse=false
        }
        
      }
    if (trueOfalse) {
        let datosEnviar = new FormData();
        datosEnviar.append("proveedorNew", JSON.stringify(proveedorNew));
      
        fetch("php/addProveedor.php", {
          method: 'POST',
          body: datosEnviar,
          }).then(respuesta => respuesta.json())
              .then(async decodificado => {
                console.log(decodificado)
                  if (decodificado=="perfecto") {
                    $("#centralModalSuccess").modal("hide")
                    /* AQUI VA EL LISTAR TODOS LOS PROVEEDORES */
                    await listarProveedores()
                    vaciarFromPro()
                    /* AQUI VA EL LISTAR TODOS LOS PROVEEDORES */
                    $("#exito").modal("show")
                  }
              });
    }else{
        if(document.getElementById("error")){
            /* $("#centralModalSuccess").modal("hide") */
            $("#error").modal("show")
        }else{
            /* $("#centralModalSuccess").modal("hide") */
            let modalError=`<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
                <!--Content-->
                <div class="modal-content text-center">
                    <!--Header-->
                    <div class="modal-header d-flex justify-content-center">
                    <p class="heading">Error completar todos los campos para guardar!</p>
                    </div>
                
                    <!--Body-->
                    <div class="modal-body">
                
                    <i class="fas fa-times fa-5x animated rotateIn"></i>
                
                    </div>
                
                    <!--Footer-->
                    <div class="modal-footer">
                
                    <a type="button" class="btn btn-danger waves-effect" onclick="cerrarYabrirOtroModal()">Cerrar</a>
                    </div>
                </div>
                <!--/.Content-->
                </div>
                </div>`
                $(modalError).modal({backdrop: 'static', keyboard: false})
                /* $(modalError).modal("show") */

        }
        
    }
})
function cerrarYabrirOtroModal() {
    $("#error").modal("hide")
    $("#centralModalSuccess").modal("show")
}



async function abrirModalEdit(id) {
    let filtroArray= todosLosProveedores.find((m) => m.idProveedor === `${id}`);
    console.log("Es: " + filtroArray.nombreP );
    
    /* creo el select de categorias en el modal editar */
  
      if(document.getElementById(`proveedorEdit${id}`)){
        $(document.getElementById(`proveedorEdit${id}`)).modal("show")
      }else{
        let modalEdit=`
        <div class="modal fade" id="proveedorEdit${id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div style="margin: 5.75rem auto !important;" class="modal-dialog modal-notify modal-info" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div style="margin-left: 5%;margin-right: 5%;margin-top: -5%;box-shadow: 0px 0px 20px 0px #00000073;" class="modal-header">
              <p style="padding: 3%;" class="heading lead">Editar ${filtroArray.nombreP}</p>
     
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>
           <form>
            <!--Body-->
            <div class="modal-body">
              
               <div class="md-form">
                 <input required type="text" name="nombreProveedor" id="nombreProveedor${id}" value="${filtroArray.nombreP}" class="form-control">
                 <label for="nombreProveedor${id}" class="active">Nombre</label>
               </div>
               <div class="md-form">
                 <input required type="text" name="direccionProveedor" id="direccionProveedor${id}" value="${filtroArray.direccionP}" class="form-control">
                 <label for="direccionProveedor${id}" class="active">Direccion</label>
               </div>
               <div class="md-form">
                 <input required type="number" name="telefonoProveedor" id="telefonoProveedor${id}" value="${filtroArray.telefonoP}" class="form-control">
                 <label for="telefonoProveedor${id}" class="active">Telefono</label>
               </div>
               <div class="md-form">
                 <textarea required name="informacionExtra" id="informacionExtra${id}" class="md-textarea form-control" cols="30" rows="3">${filtroArray.informacionExtra}</textarea>
                 <label for="informacionExtra${id}" class="active">Informacion Extra</label>
               </div>
     
              </div>
            
     
            <!--Footer-->
            <div class="modal-footer">
              <a type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
              <a onclick="guardarEditarProveedor(${id})" class="btn btn-success">Guardar</a>
            </div>
            </form>
          </div>
          <!--/.Content-->
        </div>
      </div>`
          
        $(modalEdit).modal("show")
      }
     
   }

   function guardarEditarProveedor(id) {
    console.log(id)
    let proveedorEdit = {
     idProveedor:id,
     nombreP:document.getElementById("nombreProveedor"+id).value,
     direccionP:document.getElementById("direccionProveedor"+id).value,
     telefonoP:document.getElementById("telefonoProveedor"+id).value,
     infoExtra:document.getElementById("informacionExtra"+id).value,
   };
 
   let datosEnviar = new FormData();
   datosEnviar.append("proveedor", JSON.stringify(proveedorEdit));
 
   fetch("php/editProveedor.php?id=", {
     method: 'POST',
     body: datosEnviar,
     }).then(respuesta => respuesta.json())
         .then(async decodificado => {
           console.log(decodificado)
             if (decodificado=="perfecto") {
               $("#proveedorEdit"+id).modal("hide")
               await listarProveedores()
             }
         });
 
   console.log(proveedorEdit)
  }

  function abrirModalDelete(id,nombre) {
    $("#modalEliminar").modal("show")
    document.getElementById("tituloEliminarP").innerHTML=nombre
    let boton=`<button class="btn btn-danger" onclick="borrarProveedor(${id})">Eliminar</button>`
    document.getElementById("cambiarBoton").innerHTML=boton
  }
  function borrarProveedor(id) {
      console.log(id)
      fetch('php/deleteProveedor.php?id='+id)
    .then(response => response.json())
    .then(async (data) => {
        console.log(data)
        if (data=="perfecto") {
            $("#modalEliminar").modal("hide")
            await listarProveedores()
          }
    });
  }
 
  