let elInput = document.getElementById('codigoDeBarra');
elInput.addEventListener('keypress', async (e) => {
    console.log(e.key)
    if(e.key=="Enter"){
        await cargarProductoTablaVenta()
        elInput.value=""
    }
});


async function cargarProductoTablaVenta() {
    let codigo=document.getElementById('codigoDeBarra').value
    
    if(codigo){
        fetch('php/cargarArticulo.php?codigo='+codigo)
        .then(response => response.json())
        .then((data)=> {
            console.log(data)

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

            input2.value=data[0].precioVenta
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

            textoCelda4 = document.createTextNode(`${data[0].precioVenta}`);
            celda1.appendChild(textoCelda1);
            celda2.appendChild(input1);
            celda2.appendChild(input3);
            celda3.appendChild(input2);
            celda4.appendChild(textoCelda4);
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

        });
    }else{
        alert("error")
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
                    /* $("#exito").modal("show") */
                    document.getElementById('codigoDeBarra').focus()
                  }
              });


    }else{
        console.log("error")
    }
}


document.getElementById("btnGuardarVenta").addEventListener("click",guardarVenta)
 
