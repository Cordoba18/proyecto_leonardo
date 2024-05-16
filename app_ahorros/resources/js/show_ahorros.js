

$.ajax({
    type: "GET",
    url: "metas_ahorro/datos_tarjetas_mis_ahorros",
    success: function (response) {


       let gastos_ingresos = response.gastos_ingresos;

       let valor_ingresos = 0;
       let valor_gastos  = 0;
       gastos_ingresos.forEach(g => {

       let valor = g.valor;
        if (g.id_tipo_dinero == 2) {

             valor_gastos = valor_gastos + valor;
        }else{
            valor_ingresos += valor_ingresos + valor;
        }

       });


  const text_valor_ingresos = document.querySelector("#valor_ingresos");
  const text_valor_gastos = document.querySelector("#valor_gastos");
  const text_valor_ahorro = document.querySelector("#valor_ahorro");
  const text_valor_sobrante = document.querySelector("#valor_sobrante");


  text_valor_ingresos.innerHTML = `${parseInt(valor_ingresos).toLocaleString('es-CO', {
    style: 'currency',
    currency: 'COP'
})}`;
  text_valor_gastos.innerHTML =`${parseInt(valor_gastos).toLocaleString('es-CO', {
    style: 'currency',
    currency: 'COP'
})}` ;
  text_valor_ahorro.innerHTML = `${parseInt((valor_gastos -valor_ingresos) / 2).toLocaleString('es-CO', {
    style: 'currency',
    currency: 'COP'
})}`;
  text_valor_sobrante.innerHTML = `${parseInt((valor_gastos -valor_ingresos) / 2).toLocaleString('es-CO', {
    style: 'currency',
    currency: 'COP'
})}`;
    },
    error: function (error) {
        // Manejar el error si lo hay
        console.error(error);
    }
});
