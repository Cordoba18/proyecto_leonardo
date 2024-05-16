const fecha_inicio = document.querySelector("#fecha_inicio")
const fecha_final = document.querySelector("#fecha_final")
fecha_final.addEventListener("change", () => {
    fecha_inicio.setAttribute('max', fecha_final.value);
})



fecha_inicio.addEventListener("change", () => {
    fecha_final.setAttribute('min', fecha_inicio.value);
})
