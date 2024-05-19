
let bloqueo = `<span class="placeholder col-10"></span>`;

const select_tarjetas = document.querySelector("#select_tarjetas");
const text_valor_ingresos = document.querySelector("#valor_ingresos");
const text_valor_gastos = document.querySelector("#valor_gastos");
const text_valor_ahorro = document.querySelector("#valor_ahorro");
const text_valor_sobrante = document.querySelector("#valor_sobrante");

select_tarjetas.addEventListener("change", () => {


    text_valor_ingresos.innerHTML = bloqueo;
   text_valor_gastos.innerHTML = bloqueo;
   text_valor_ahorro.innerHTML = bloqueo;
   text_valor_sobrante.innerHTML = bloqueo;

    if (select_tarjetas.value == "") {
        cargar_tarjtas("");
    }else{
        cargar_tarjtas("?id_tarjeta="+select_tarjetas.value);
    }

})

cargar_tarjtas("");
function cargar_tarjtas(request) {

    $.ajax({
        type: "GET",
        url: "metas_ahorro/datos_tarjetas_mis_ahorros"+request,
        success: function (response) {



           let gastos_ingresos = response.gastos_ingresos;

           let tarjetas = response.tarjetas;



           let valor_ingresos = 0;
           let valor_gastos  = 0;
           gastos_ingresos.forEach(g => {

            console.log(g)
           let valor = g.valor;
if (g.id_tipo_periodo == 2) {


            if (g.id_tipo_dinero == 2) {

                 valor_gastos = valor_gastos + valor;
            }else{
                valor_ingresos = valor_ingresos + valor;
            }
        }
           });

           tarjetas.forEach(t => {

            if (t.cuota_manejo !== null && t.cuota_manejo !== "") {
                valor_gastos = valor_gastos + t.cuota_manejo;
            }

           });


      let valor_de_ahorro = 0;
     valor_de_ahorro = valor_ingresos *0.20;

    if (valor_de_ahorro < 0) {

        valor_de_ahorro = 0;
    }

    let valor_sobrante = 0;

     valor_sobrante = (valor_ingresos-valor_gastos) - valor_de_ahorro;

    if (valor_sobrante < 0) {

        valor_sobrante = 0;
    }

      text_valor_ingresos.innerHTML = `${parseInt(valor_ingresos).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })} | ${parseInt(valor_ingresos/2).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })}`;
      text_valor_gastos.innerHTML =`-${parseInt(valor_gastos).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })} | -${parseInt(valor_gastos/2).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })}` ;
      text_valor_ahorro.innerHTML = `${parseInt(valor_de_ahorro).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })} | ${parseInt(valor_de_ahorro/2).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })}`;
      text_valor_sobrante.innerHTML = `${parseInt(valor_sobrante).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })} | ${parseInt(valor_sobrante/2).toLocaleString('es-CO', {
        style: 'currency',
        currency: 'COP'
    })}`;
        },
        error: function (error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });
}


