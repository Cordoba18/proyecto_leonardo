const fecha_inicio = document.querySelector("#fecha_inicio")
const fecha_final = document.querySelector("#fecha_final")
fecha_final.addEventListener("change", () => {
    fecha_inicio.setAttribute('max', fecha_final.value);
})



fecha_inicio.addEventListener("change", () => {
    fecha_final.setAttribute('min', fecha_inicio.value);
})

const id_meta_ahorro =  document.querySelector("#id_meta_ahorro").value;

$.ajax({
    type: "GET",
    url: "dastos_grafica_mi_ahorro/"+id_meta_ahorro,
    success: function (response) {

        const valor_ahorrado = document.querySelector("#valor_ahorrado");
        valor_ahorrado.innerHTML = `${parseInt(response.valor_de_inicio_a_hoy).toLocaleString('es-CO', {
                                style: 'currency',
                                currency: 'COP'
                            })}`;


        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: '',
                align: 'left'
            },
            subtitle: {
                text: '',
                align: 'left'
            },
            xAxis: {
                categories:response.tiempos_grafica,
                crosshair: true,
                accessibility: {
                    description: 'Countries'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ' VALOR COP'
                }
            },
            tooltip: {
                valueSuffix: ' COP'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [response.valores_grafica]
        });

    },
    error: function (error) {
        // Manejar el error si lo hay
        console.error(error);
    }
});
