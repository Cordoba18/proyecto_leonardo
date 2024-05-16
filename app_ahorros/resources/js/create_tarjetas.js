
const check_cuota_manejo = document.querySelector("#check_cuota_manejo")
const fecha_cuota_manejo = document.querySelector("#fecha_cuota_manejo")
const cuota_manejo = document.querySelector("#cuota_manejo");
const content_fecha_cuota_manejo = document.querySelector(".content_fecha_cuota_manejo");
check_cuota_manejo.addEventListener("click", () => {

    if (check_cuota_manejo.checked) {

        fecha_cuota_manejo.disabled = false;
        cuota_manejo.disabled = false;
        content_fecha_cuota_manejo.removeAttribute("hidden");
    }else{
        fecha_cuota_manejo.disabled = true;
        cuota_manejo.disabled = true;
        content_fecha_cuota_manejo.setAttribute("hidden",true);
    }
})
