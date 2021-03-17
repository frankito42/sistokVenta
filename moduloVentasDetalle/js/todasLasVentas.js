document.addEventListener("DOMContentLoaded",async function() {
    console.log("DOM fully loaded and parsed");
    await ListarVentas()
    await ventasToDay()
});

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
        document.getElementById("ventasDelDia").innerHTML="$"+data.totalDia
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
        fecha=`${fecha[1]}-${fecha[2]}-${fecha[0]}`
        console.log(fecha)
        if(i==params.length-1){
            listaVentas+=`
            <div style="border-radius: 5px;padding: 1%;margin: -1%;" class="media hoverable">
            <i style="color: #29b6f6;" class="d-flex mr-3 fas fa-shopping-bag fa-4x"></i>
            <div class="media-body">
            <h6 class="mt-1 font-weight-bold"><a href="#!">${fecha} N° ${element.idVenta}</a><a><span style="font-size: 125%;" class="badge badge-success float-right">$${element.totalV}</span></a></h6>
            <p class="text-muted">Usuario: ${element.user}.</p>
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
            </div>
            </div>
            <hr>`

        }
    });

    document.getElementById("listaVentas").innerHTML=listaVentas
    console.log(params)
}