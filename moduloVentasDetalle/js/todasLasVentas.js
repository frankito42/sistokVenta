document.addEventListener("DOMContentLoaded",async function() {
    console.log("DOM fully loaded and parsed");
    await ListarVentas()
    await ventasToDay()
    await ventasMonth()
    await productosMasVendidos()
    await totalTodosLosMese()
});

document.getElementById("fechaI").addEventListener("change",async ()=>{
   await ventasPorFecha()
})
document.getElementById("fechaF").addEventListener("change",async ()=>{
   await ventasPorFecha()
})


async function ListarVentas() {
    fetch('php/listarVentas.php')
    .then(response => response.json())
    .then(async (data)=>{
        console.log(data)
        await dibujarVentas(data)
    });
}
async function ventasToDay() {
    fetch('../consultasAzar/consultasAzar.php')
    .then(response => response.json())
    .then(async (data)=>{
        console.log(data)
        document.getElementById("ventasDelDia").innerHTML=(data.totalDia==null)?"$"+0:data.totalDia
    });
}
async function productosMasVendidos() {
    fetch('php/productosMasVendidos.php')
    .then(response => response.json())
    .then(async (articulosMasVendi)=>{
        console.log(articulosMasVendi)
        document.getElementById("masVendido").innerHTML=articulosMasVendi[0].nombreProducto
        document.getElementById("modalMasVendi").addEventListener("click",()=>{
            mostrarLosProductosMasVendidos(articulosMasVendi)
        })
    });
}
async function ventasMonth() {
    fetch('../consultasAzar/totalMensual.php')
    .then(response => response.json())
    .then(async (data)=>{
        console.log(data)
        document.getElementById("ventasDelMes").innerHTML=(data.totalMes==null)?"$"+0:data.totalMes
    });
}
async function totalTodosLosMese() {
    fetch('../consultasAzar/totalTodosLosMeses.php')
    .then(response => response.json())
    .then(async (data)=>{
        console.log(data)
        let me=``
        data.forEach(element => {
            me+=`
                <h4>${element.mes}: <span style="border-bottom-style: outset;border-color: #4eff4eb8;">$${element.totalMes }</span></h4>
            `
        });
        document.getElementById("totalMeses").innerHTML=me
    });
}
async function ventasPorFecha() {
    let fechaI=document.getElementById("fechaI").value
    let fechaF=document.getElementById("fechaF").value
    console.log(fechaI)
    console.log(fechaF)

    document.getElementById("cambiarPorElFiltro").innerHTML=`Fecha de inicio ${fechaI} hasta ${fechaF}`

    fetch(`php/ventasPorFecha.php?fechaI=${fechaI}&fechaF=${fechaF}`)
    .then(response => response.json())
    .then(async (data)=>{
        console.log(data)
        dibujarVentas(data)
    });
}



async function dibujarVentas(params) {
    let listaVentas=``
    let sumaTotal=0
    let fecha
    params.forEach((element,i) => {
        sumaTotal=parseFloat(sumaTotal)+parseFloat(element.totalV)
        /* console.log(params.length)
        console.log(i) */
        fecha=element.fechaV.split("-")
        fecha=`${fecha[2]}-${fecha[1]}-${fecha[0]}`
        console.log(fecha)
        if(i==params.length-1){
            listaVentas+=`
            <div style="border-radius: 5px;padding: 1%;margin: -1%;" class="media hoverable">
            <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-bag fa-4x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!">${fecha} N° ${element.idVenta}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$${element.totalV}</span></a></h6>
            <p class="text-muted">Usuario: ${element.user}.</p>

            <a onclick="abrirDetalle(${element.idVenta})"><h3><span class="waves-effect waves-light rgba-white-slight btn-block badge badge-primary float-right noselect">Detalles</span></h3></a>
            </div>
            </div>
            <hr>

            <div style="border-radius: 5px;padding: 1%;margin: -1%;" class="media hoverable">
            <i style="color: #007bff;" class="d-flex mr-3 fas fa-cash-register fa-4x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!"><span style="font-size: 125%;">TOTAL</span></a><a><span style="font-size: 226%;" class="badge badge-success float-right">$${sumaTotal.toFixed(2)}</span></a></h6>
            </div>
            </div>
            `

        }else{
            listaVentas+=`
            <div style="border-radius: 5px;padding: 1%;margin: -1%;" class="media hoverable">
            <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-bag fa-4x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!">${fecha} N° ${element.idVenta}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$${element.totalV}</span></a></h6>
            <p class="text-muted">Usuario: ${element.user}.</p>
            
            <a onclick="abrirDetalle(${element.idVenta})"><h3><span class="waves-effect waves-light rgba-white-slight btn-block badge badge-primary float-right noselect">Detalles</span></h3></a>
            </div>
            </div>
            <hr>`

        }
    });

    /* if(listaVentas==""){
        console.log("123123")
        document.getElementById("listaVentas").innerHTML=`a`
    } */

    document.getElementById("listaVentas").innerHTML=(listaVentas=="")?"<h1 style='color:black;text-align: center;'>Realiza una venta :)</h1>":listaVentas
}


async function abrirDetalle(id) {

    fetch('php/listarDetalle.php?idV='+id)
    .then(response => response.json())
    .then((data)=>{
        console.log(data)
        let detail=``
        let suma=0
        data.forEach((element,i) => {
            suma+=element.cantidadV*element.precio
            if(i==data.length-1){
                detail+=`
                <div style="margin: -1%;" class="media">
                <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
                <div class="media-body">
                <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$${element.precio}</span></a></h6>
                <p class="text-muted">cantidad: ${element.cantidadV}.</p>            
                </div>
                </div>
                <hr>
    
                <div style="margin: -1%;" class="media">
                <i style="color: #007bff;" class="d-flex mr-3 fas fa-cash-register fa-3x"></i>
                <div class="media-body">
                <h6 class="mt-1 font-weight-bold"><a href="#!"><span style="font-size: 125%;">TOTAL</span></a><a><span style="font-size: 226%;" class="badge badge-success float-right">$${suma.toFixed(2)}</span></a></h6>
                </div>
                </div>
                `
    
            }else{
                detail+=`<div style="margin: -1%;" class="media">
                <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
                <div class="media-body">
                <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$${element.precio}</span></a></h6>
                <p class="text-muted">cantidad: ${element.cantidadV}.</p>            
                </div>
                </div>
                <hr>`
            }
        });

        if(document.getElementById(`detalleV${id}`)){
            $("#detalleV"+id).modal("show")
        }else{
            let modalDetalle=`<div class="modal fade right" id="detalleV${id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
                <div class="modal-dialog modal-notify modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-header text-white">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Detalle Ticket N°${id}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body row">
                    <div class="col-12 mb-3 mx-auto">
                    ${detail}
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>`
            $(modalDetalle).modal("show")
    
        }
    });


}

let hoy = localStorage.getItem("fechaHoy")
console.log(hoy)

async function mostrarLosProductosMasVendidos(productos) {


        let detail=``
        productos.forEach((element,i) => {
            if(i==productos.length-1){
                detail+=`
                <div style="margin: -1%;" class="media">
                <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
                <div class="media-body">
                <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$$$$$$$$$</span></a></h6>
                <p class="text-muted">vendido: ${element.cantidadVendida}.</p>            
                </div>
                </div>`
    
            }else{
                detail+=`<div style="margin: -1%;" class="media">
                <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
                <div class="media-body">
                <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$$$$$$$$$</span></a></h6>
                <p class="text-muted">vendido: ${element.cantidadVendida}.</p>            
                </div>
                </div>
                <hr>`
            }
        });







    if(document.getElementById(`todosLosProductosMasVendidos`)){
        $("#todosLosProductosMasVendidos").modal("show")
    }else{
        let modalProductosMasVendidos=`<div class="modal fade right" id="todosLosProductosMasVendidos" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
            <div class="modal-dialog modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header text-white">
                <h5 class="modal-title" id="exampleModalPreviewLabel">Los productos mas vendidos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body row">
                <div class="col">
                        <!-- Default input -->
                        <input type="date" id="fecha1" class="form-control" value="${hoy}" onchange="filtrarProductosFecha()" placeholder="First name">
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col">
                        <!-- Default input -->
                        <input type="date" id="fecha2" class="form-control" value="${hoy}" onchange="filtrarProductosFecha()" placeholder="Last name">
                        </div>
                        
                <div id="productosMasVendidosFiltro" class="col-12 mb-3 mx-auto">
                <hr>
                ${detail}
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>`
        /* $(modalProductosMasVendidos).modal({backdrop: 'static'}) */
        $(modalProductosMasVendidos).modal("show")

    }
}

async function filtrarProductosFecha() {
    fecha1=document.getElementById("fecha1").value
    fecha2=document.getElementById("fecha2").value
    console.log(fecha1)
    console.log(fecha2)
    await fetch('php/producMasVendiFiltro.php?fecha1='+fecha1+'&fecha2='+fecha2)
    .then(response => response.json())
    .then( async (data)=>{
        await mostrarLosProductosMasVendidosFiltro(data)
    })
}
async function mostrarLosProductosMasVendidosFiltro(productos) {


    let detail=``
    productos.forEach((element,i) => {
        if(i==productos.length-1){
            detail+=`
            <div style="margin: -1%;" class="media">
            <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$$$$$$$$$</span></a></h6>
            <p class="text-muted">Vendido: ${element.cantidadVendida}.</p>            
            </div>
            </div>`

        }else{
            detail+=`<div style="margin: -1%;" class="media">
            <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-basket fa-3x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!">${element.nombreProducto}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$$$$$$$$$</span></a></h6>
            <p class="text-muted">vendido: ${element.cantidadVendida}.</p>            
            </div>
            </div>
            <hr>`
        }
    });
    document.getElementById("productosMasVendidosFiltro").innerHTML="<hr>"+detail
}

document.getElementById("modalMesVendi").addEventListener("click",()=>{
    $("#totalMesesModal").modal("show")
})