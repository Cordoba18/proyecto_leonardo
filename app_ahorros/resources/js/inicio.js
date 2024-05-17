
$.ajax({
    type: "GET",
    url: "inicio/dates_graficas",
    success: function (response) {

    let gastos_ingresos = response.gastos_ingresos;
    let tarjetas = response.tarjetas;

    // Crear una nueva fecha en la zona horaria de Colombia
const colombiaTime = new Date().toLocaleString("en-US", { timeZone: "America/Bogota" });

// Convertir la fecha local de Colombia a un objeto Date
const date = new Date(colombiaTime);

// Formatear la fecha al formato YYYY-MM-DD
const year = date.getFullYear();
const month = String(date.getMonth() + 1).padStart(2, '0'); // Los meses en JavaScript van de 0 a 11
const day = String(date.getDate()).padStart(2, '0');

const dia_de_hoy = `${year}-${month}-${day}`;


        llenar_gastos_de_hoy(gastos_ingresos,tarjetas);

        llenar_grafica_barras(gastos_ingresos,tarjetas,dia_de_hoy);
        cargartorta(gastos_ingresos,tarjetas);
    },
    error: function (error) {
        // Manejar el error si lo hay
        console.error(error);
    }
});

function cargartorta(gastos_ingresos, tarjetas) {


    let total_gastos = 0;
    let total_ingresos = 0;

    let conteo = gastos_ingresos.length + tarjetas.length;


    gastos_ingresos.forEach(g => {

        if (g.id_tipo_dinero ==1) {
            total_ingresos += 1;
        }else{
            total_gastos += 1;
        }

    });

    tarjetas.forEach(t => {
        total_gastos += 1;
    });



    let data = [{
        name: 'INGRESOS',
        y: (total_ingresos/conteo) * 100
    },{
        name: 'GASTOS',
        y: (total_gastos/conteo) * 100
    }]
        Highcharts.chart('container2', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'PORCENTAJE GASTOS Y INGRESOS DE LA SEMANA'
            },
            tooltip: {
                valueSuffix: '%'
            },
            subtitle: {
                text: 'Source:<a href="https://www.mdpi.com/2072-6643/11/3/684/htm" target="_default">MDPI</a>'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: [{
                        enabled: true,
                        distance: 20
                    }, {
                        enabled: true,
                        distance: -40,
                        format: '{point.percentage:.1f}%',
                        style: {
                            fontSize: '1.2em',
                            textOutline: 'none',
                            opacity: 0.7
                        },
                        filter: {
                            operator: '>',
                            property: 'Porcentaje',
                            value: 10
                        }
                    }]
                }
            },
            series: [{
                name: 'Porcentaje',
                colorByPoint: true,
                data: data
            }]
        });


}

function llenar_grafica_barras(gastos_ingresos, tarjetas,dia_de_hoy) {


    let data = [];
    let categories = [];
    gastos_ingresos.forEach(g => {


        if (g.fecha == dia_de_hoy) {
            data.push({
                name: g.detalle + " | " + g.tipo_dinero,
                data: [g.valor]
            })

            categories.push(g.detalle)
        }


    });

    tarjetas.forEach(t => {
        if (t.fecha_cuota_manejo == dia_de_hoy) {
        data.push({
            name: `${t.asociacion} - ${t.numero} - ${t.nombre_banco}"| CUOTA DE MANEJO`,
            data: [t.cuota_manejo]
        })

        categories.push(`${t.asociacion} - ${t.numero} - ${t.nombre_banco}`)
    }
    });

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'DATOS',
            align: 'left'
        },
        subtitle: {
            text: 'Source: <a target="_blank" ' +
                'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
            align: 'left'
        },
        xAxis: {
            categories: categories,
            crosshair: true,
            accessibility: {
                description: 'Countries'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'COP'
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
        series: data
    });
}

function llenar_gastos_de_hoy(gastos_ingresos, tarjetas) {

    let filas = ``;


    gastos_ingresos.forEach(g => {

        let clase = "";
        if (g.id_tipo_dinero ==1) {
            clase = "table-success";
        }else{
            clase = "table-danger";
        }

        filas += `<tr class="${clase}">
        <td>${g.detalle}</td>
        <td>${parseInt(g.valor).toLocaleString('es-CO', {
            style: 'currency',
            currency: 'COP'
        })}</td>
        <td>${g.fecha}</td>
        <td>${g.asociacion} | ${g.numero} | ${g.nombre_banco}</td>
        <td>${g.tipo_dinero}</td>
        </tr>`;
    });

    tarjetas.forEach(t => {
        filas += `<tr class="table-danger">
        <td>CUOTA DE MANEJO</td>
        <td>${parseInt(t.cuota_manejo).toLocaleString('es-CO', {
            style: 'currency',
            currency: 'COP'
        })}</td>
        <td>${t.fecha_cuota_manejo}</td>
        <td>${t.asociacion} | ${t.numero} | ${t.nombre_banco}</td>
        <td>GASTO</td>
        </tr>`;
    });

    const filas_semanales = document.querySelector("#filas_semanales");

    filas_semanales.innerHTML = filas;

    activar_tabla();
}
