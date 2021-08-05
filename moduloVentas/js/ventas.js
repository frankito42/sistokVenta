let elInput = document.getElementById('codigoDeBarra');
elInput.addEventListener('keypress', async (e) => {
    console.log(e.key)
    if(e.key=="Enter"){
        await cargarProductoTablaVenta()
        elInput.value=""
    }
});


async function cargarProductoTablaVenta(codi,idPro,mayoriOminori) {
    let codigo
    if(codi){
        codigo=codi
    }else{
        codigo=document.getElementById('codigoDeBarra').value
    }
    
    if(codigo){
        fetch('php/cargarArticulo.php?codigo='+codigo+'&idPro='+idPro)
        .then(response => response.json())
        .then((data)=> {
            /* console.log(data) */

            if(data==""){
                alert("El producto no existe.")
            }else{
                fila = document.createElement("tr");
                celda1 = document.createElement("td");
                celda2 = document.createElement("td");
                celda3 = document.createElement("td");
                celda4 = document.createElement("td");
                celda5 = document.createElement("td");
                input1 = document.createElement("input")
                input2 = document.createElement("input")
                input1.value=1
                input1.type="number"
                input1.style.width="71px"
                
                input1.addEventListener("change", async()=>{
                   await sumarTodo()
                })
                input1.addEventListener("keyup",async ()=>{
                   await sumarTodo()
                })
                let maOmi
                if (mayoriOminori=="mayo") {
                    maOmi=data[0].mayoritario
                    console.log(mayoriOminori +" entro en el si")
                }else{
                    maOmi=data[0].precioVenta
                    console.log(mayoriOminori +" entro en el elseeeeeeeeeee")
                }
    
                input2.value=maOmi
                input2.type="number"
                input2.style.width="87px"
                input2.addEventListener("change",async ()=>{
                   await sumarTodo()
                })
                input2.addEventListener("keyup",async ()=>{
                   await sumarTodo()
                })
                input3=document.createElement("input")
                input3.type="number"
                input3.value=data[0].articulo
                input3.style.display="none"
                textoCelda1 = document.createTextNode(`${data[0].nombre}`);
                /* console.log(mayoriOminori) */

                
                
                celda1.appendChild(textoCelda1);
                celda2.appendChild(input1);
                celda2.appendChild(input3); 
                celda3.appendChild(input2);
                
                celda5.innerHTML=`<button onclick="deleteTdTable(this)" class="btn btn-danger btn-sm">x</button>`
                
                fila.appendChild(celda1);
                fila.appendChild(celda2);
                fila.appendChild(celda3);
                fila.appendChild(celda4);
                fila.appendChild(celda5);
               /*  let tr=`
                <tr>
                    <td>${data[0].nombre}</td>
                    <td><input onkeyup="sumarTodo()" style="width: 71px;" onchange="sumarTodo()" type="number" value="1"><input style="display:none;" type="number" value="${data[0].articulo}"></td>
                    <td><input onkeyup="sumarTodo()" style="width: 83px;" onchange="sumarTodo()" type="number"  value="${data[0].precioVenta}"></td>
                    <td></td>
                    <td><button onclick="deleteTdTable(this)" class="btn btn-danger btn-sm">x</button></td>
                </tr>
                ` */
                document.getElementById("ProductosVender").appendChild(fila)
                /* document.getElementById("ProductosVender").innerHTML+=tr */
    
                sumarTodo()

            }

        });
        /* escondo el modal al hacer click en un boton */
        $("#mostarProductElegir").modal("hide")
    }else{
        alert("Agregue codigo de barra.")
    }
}

async function deleteTdTable(e) {
    e.parentNode.parentNode.remove()
    await sumarTodo()
    
}

async function sumarTodo() {
    let acumulador=0
    let no=true
    document.getElementById("ProductosVender").children.forEach(element => {
        console.log(element.children[1].children[0].value)
        console.log(element.children[2].children[0].value)
        let suma=element.children[1].children[0].value*element.children[2].children[0].value
        acumulador=acumulador+parseFloat(suma.toFixed(2))
        console.log(acumulador)
        element.children[3].innerHTML=suma.toFixed(2)
        document.getElementById("total").innerHTML=acumulador.toFixed(2)
        no=false
    });

    if(no){
        document.getElementById("total").innerHTML=0
    }
}

function guardarVenta() {
    if (document.getElementById("ProductosVender").children.length>0) {
        let venta=[]
        let ventas=[]
        document.getElementById("ProductosVender").children.forEach((element)=>{
            /* primero el id */
            /* console.log(element.children[0]) */
            venta.push(element.children[1].children[1].value)
            venta.push(element.children[0].innerHTML)
            venta.push(element.children[1].children[0].value)
            venta.push(element.children[2].children[0].value)
            /* venta[array()].push(element.children[2].children[0].value) */
            ventas.push(venta)
            venta=[]
        })
       /*  console.log(ventas) */

        let productosVender = new FormData();
        productosVender.append("productos", JSON.stringify(ventas));
      
        fetch("php/venderProducto.php", {
          method: 'POST',
          body: productosVender,
          }).then(respuesta => respuesta.json())
              .then(decodificado => {
                console.log(decodificado)
                  if (decodificado=="perfecto") {
                    document.getElementById("ProductosVender").innerHTML=""
                    sumarTodo()
                    alert("Venta finalizada.")
                    $("#pregunta").modal("hide")
                    /* $("#exito").modal("show") */
                    document.getElementById('codigoDeBarra').focus()
                  }
              });


    }else{
        console.log("error")
    }
}


document.getElementById("btnGuardarVenta").addEventListener("click",abreModalPregunta)
document.getElementById("imprimeTicket").addEventListener("click",guardarVenta)



function abreModalPregunta() {
    console.log(document.getElementById("ProductosVender").children.length)
    if (document.getElementById("ProductosVender").children.length>0){
        $("#pregunta").modal("show")
    }else{
        alert("Cargue productos antes de continuar")
        document.getElementById('codigoDeBarra').focus()
    }
}

async function listarTodosLosProductos() {
    await fetch("php/listarProductos.php")
    .then(respuesta => respuesta.json())
    .then(data => {
              console.log(data)
              let elementos=``
              data.forEach(element => {
                  elementos+=`
                  <tr>
                    <td>${element.nombre}</td>
                    <td>$${element.precioVenta} <button class="btn btn-blue btn-sm" onclick="cargarProductoTablaVenta('${(element.codBarra)?element.codBarra:'no'}',${element.articulo})"><i class="fas fa-plus fa-1x"></i></button></td>
                    <td>$${element.mayoritario} <button class="btn btn-blue btn-sm" onclick="cargarProductoTablaVenta('${(element.codBarra)?element.codBarra:'no'}',${element.articulo},'mayo')"><i class="fas fa-plus fa-1x"></i></button></td>
                  </tr>
                  `
              });
              document.getElementById("aquiMostrarTodo").innerHTML=elementos
    });
}
listarTodosLosProductos()

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
 
