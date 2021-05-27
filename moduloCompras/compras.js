function addNewProductFrom(id) {
    
    /* console.log((parseInt(id))) */
    
    fetch('traerArticulo.php?id='+id)
    .then(response => response.json())
    .then((data)=>{ 

        let tablaEscondida=document.getElementById("tablaEscondida").style.display="block"
        let tbody=document.getElementById("addProducto")
        
        
        let tr=document.createElement('tr')
        
        for (let index = 0; index <= 6; index++) {
            let td=document.createElement('td')
            
            
            let nombre=document.createTextNode(data.nombre)
            if(index==0){
                /* let img=document.createElement('img')
                img.setAttribute("height", "80");
                img.setAttribute("width", "80")
                img.setAttribute("src", data.imagen.replace('../', ''))
                td.appendChild(img)
                tr.appendChild(td) */
            }else if(index==1){
                td.appendChild(nombre)
                tr.appendChild(td)
            }else if(index==2){
                /* CANTIDADDDDDDDDDDDDDDDDDDDDDDDDD */
                let input=document.createElement('input')
                input.className="form-control"
                input.required=true
                input.type="number"
                input.name="cantidad[]"
                td=document.createElement('td')
                td.appendChild(input)
                tr.appendChild(td)
            }else if(index==3){
                /* COSTOOOOOOOOOOOOOOOOOOOOOO */
                let input=document.createElement('input')
                let inputFantasma=document.createElement('input')
                input.className="form-control"
                input.required=true
                input.type="number"
                input.name="costo[]"
                input.onkeyup=sumarTodoTodito
                input.value=0
                inputFantasma.value=data.articulo
                inputFantasma.name="idArticulo[]"
                inputFantasma.style.display="none"
                td=document.createElement('td')
                td.appendChild(inputFantasma)
                td.appendChild(input)
                tr.appendChild(td)
                
            }else if(index==4){
              
              let input2=document.createElement('input')
              input2.type = "number";
              input2.name = "precioventa[]";
              input2.style.display="none"
              
              let input=document.createElement('input')
                input.className="form-control"
                input.required=true
                input.style.width="44%"
                input.style.display="inline"
                input.style.marginRight="2%"
                input.type="number"
                input.onkeyup = sumarTodoTodito;


                td=document.createElement('td')
                tr.appendChild(td)

                let p=document.createElement('p')
                p.innerText="$0"
                p.style.color = "rgb(0 206 84 / 97%)";
                p.style.fontSize="140%"
                p.style.background = "#ffc4f2";
                p.style.borderRadius = "5px";
                p.style.padding = "1%";
                p.style.display="inline"
                td.appendChild(p)
                let div=`
                <div class="md-form">
                <input type="number" disabled class="form-control" id="meno${data.articulo}">
                <label style="max-width: max-content;" for="meno${data.articulo}" class="active">Ganancia por menor</label>
                </div>
                `
                td.innerHTML+=div
                /* el primer input es el de porcentaje */
                td.insertBefore(input, td.firstChild);
                /* este es un input escondido */
                td.appendChild(input2);
            }else if(index==5){
                let input2 = document.createElement("input");
                input2.type = "number";
                input2.name = "preciomayor[]";
                input2.onkeyup = sumarTodoTodito;
                input2.style.display = "none";
                
                
                
                let input3 = document.createElement("input");
                input3.className="form-control"
                input3.required=true
                input3.type = "number";
                input3.style.width="44%"
                input3.style.display="inline"
                input3.style.marginRight="2%"
                input3.onkeyup = sumarTodoTodito;
                td=document.createElement('td')
                
                tr.appendChild(td)

                let p = document.createElement("p");
                p.innerText = "$0";
                p.style.color = "rgb(0 206 84 / 97%)";
                p.style.fontSize = "140%";
                p.style.background = "#ffc4f2";
                p.style.borderRadius = "5px";
                p.style.padding = "1%";
                p.style.display = "inline";
                td.appendChild(p)
                let div=`
                <div class="md-form">
                <input type="number" disabled class="form-control" id="mayo${data.articulo}">
                <label style="max-width: max-content;" for="mayo${data.articulo}" class="active">Ganancia por mayor</label>
                </div>
                `
                td.innerHTML+=div
                td.insertBefore(input3,td.firstChild);
                td.appendChild(input2)
            }else if(index==6){
              let boton=document.createElement('a')
              boton.className="btn btn-sm btn-primary borrar"
              boton.innerText="x"
              td.appendChild(boton)
              tr.appendChild(td)
          }

        }

        tbody.appendChild(tr)
        
        let borrar=document.getElementsByClassName("borrar")

    
/* CAMBIAR ESTO POR UNA FUNCION CON THIS PARA ELIMINAR  */
        borrar.forEach(element => {
         
          element.addEventListener("click",(e)=>{
                console.log(e.target.parentNode.parentNode.parentNode)
                console.log(e.target.parentNode.parentNode)
                e.target.parentNode.parentNode.parentNode.removeChild(e.target.parentNode.parentNode)
                if (tbody.childElementCount==0) {
                    document.getElementById("tablaEscondida").style.display="none"
                }
            })
    });
    
    });



    
    




  
}


// Material Select Initialization
$(document).ready(function() {
  $('.mdb-select').materialSelect();
  console.log($(this))
  /* SOY EL MEJOR LPM */
  document.getElementsByClassName("dropdown-content select-dropdown").forEach((element)=>{
    
    element.parentElement.childNodes[1].addEventListener("click",()=>{
      element.children[0].children[0].children[0].focus()
    })

  })
  

});




/* console.log(document.getElementsByClassName('search w-100').autofocus) */
 


function abrirModalBorrar(id,fecha,factura,observacion) {


  if (document.getElementById("modal"+id)) {
    $("#modal"+id).modal("show")
  }else{
    let modal=`<div id="modal${id}" class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div style="background: #dee2e6;" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalPreviewLabel">Compra ${fecha} N° factura ${factura}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Si elimina la factura, se restaran la cantidad de todos los articulos ingresados.<br>
          ${observacion}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="borrar(${id})" class="btn btn-danger">Confirmar borrado</button>
        </div>
      </div>
    </div>
  </div>
  `;
  $(modal).modal("show")
}
console.log(id)
    
    
}

function borrar(id) {
  $("#modal"+id).modal('hide')
   
  fetch('borrarEntradaCompleta.php?idEntrada='+id)
  .then(response => response.json())
  .then((data) => {
    /* console.log(data) */
    
    
    if(data=="ok"){

      $('#entrada'+id).addClass('animated bounceOutLeft');

      $('#entrada'+id).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("entrada"+id).remove()
      });
    }else{
      alert("Error comunicar a pancho.")
    }
  });    
}


function abrirModalBorrarDetalle(id,cantidad,idArticulo,nombre) {
  /* console.log(id)
  console.log(idEntrada)
  console.log(cantidad)
  console.log(idArticulo) */

  if (document.getElementById("modalDetalle"+id)) {
    $("#modalDetalle"+id).modal("show")
  }else{
    let modal=`<div id="modalDetalle${id}" class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div style="background: #dee2e6;" class="modal-content">
      <div style="background: #ff3547;color: white;" class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel">${nombre}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Al elminar el producto de la factura, se descontara la cantidad de ${cantidad} unidades automaticamnete.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="borrarDetalle(${id},${cantidad},${idArticulo})" class="btn btn-danger">Confirmar borrado</button>
      </div>
    </div>
  </div>
</div>
`;
$(modal).modal("show")
  }
  
/* console.log(id) */
  
}

function borrarDetalle(id,cantidad,idArticulo) {
  $("#modalDetalle"+id).modal('hide')
   
  fetch('borrarEntradaProducto.php?id='+id+'&cantidad='+cantidad+'&idArticulo='+idArticulo)
  .then(response => response.json())
  .then((data) => {
    /* console.log(data) */
    
    
    if(data=="ok"){

      $('#entradaDetalle'+id).addClass('animated bounceOutLeft');

      $('#entradaDetalle'+id).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', ()=>{
        document.getElementById("entradaDetalle"+id).remove()
      });
    }else{
      alert("Error comunicar a pancho.")
    }
  });    
}

function tomarId(id,idForm,canti) {
  /* console.log(id) */
  document.getElementById("formularioId"+idForm).value=id
  alert("Al cambiar el producto se inabilita la cantidad y toma la cantidad de "+canti+" para descontar y sumar al nuevo articulo seleccionado.")
  document.getElementById("cantidadNo"+idForm).style.display="none"
}
function tomarId2(id) {
  console.log(id)
  document.getElementById("idDelArticuloSelect").value=id
  
}



function sumarTodoTodito() {
  let todosLosTrProductos=document.querySelectorAll("#addProducto")
  let costoBruto=0
  let minoriTotal=0
  let mayoriTotal=0
  let p1
  let p2
  let input1=0
  let input2=0
  todosLosTrProductos[0].children.forEach(element => {
    /* costo mas el porcentaje de minoritario */
    costoBruto=parseFloat((element.children[2].children[1].value=="")?0:element.children[2].children[1].value)
    minoriTotal=costoBruto*parseFloat((element.children[3].children[0].value=="")?0:element.children[3].children[0].value)/100+costoBruto
    mayoriTotal=costoBruto*parseFloat((element.children[4].children[0].value=="")?0:element.children[4].children[0].value)/100+costoBruto
    /* costo mas el porcentaje de mayoritario */
    /* costo2=element.children[2].children[1].value* */
    /* console.log(element.children[2].children[1]) */
    p1=element.children[3].children[1].innerHTML="$"+minoriTotal
    p2=element.children[4].children[1].innerHTML="$"+mayoriTotal
    input1=element.children[3].children[2].children[0].value=(minoriTotal-costoBruto).toFixed(2)
    input2=element.children[4].children[2].children[0].value=(mayoriTotal-costoBruto).toFixed(2)

    /* PRECIO DE VENTA MINORITARIO TOTAL */
    element.children[3].children[3].value = minoriTotal;
    /* PRECIO DE VENTA mayoritario TOTAL */
    element.children[4].children[3].value = mayoriTotal;

    console.log(element.children[3].children[3])
    console.log(element.children[4].children[3])
    console.log(costoBruto)
    console.log(minoriTotal)
    console.log(mayoriTotal)

  });
}
