document.getElementById("submitBtn").addEventListener("click",(e)=>{
    e.preventDefault()
    let user=document.getElementById("user").value
    let pass=document.getElementById("pass").value
    console.log(user)
    console.log(pass)
    fetch(`php/loguear.php?user=${user}&pass=${pass}`)
    .then(response => response.json())
    .then((data)=>{
        console.log(data)
        if(data=="mal"){
            document.getElementById("user").value=""
            document.getElementById("pass").value=""
            $("#error").modal("show")
        }else{
            localStorage.setItem("user", JSON.stringify(data));
           /*  localStorage.getItem("user"); */
            /* console.log(localStorage.getItem("user")) */
            location.href="../index.php"

        }
    });
})