@extends('layouts.dashboard')


@section('title', 'Inicio')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-white rounded shadow-sm py-1">
                <canvas id="dailySells" height="100">></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-white rounded shadow-sm my-3 py-1">
                <canvas id="monthlySells" height="100">></canvas>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" crossorigin="anonymous"/>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        
        
        var dailySells = document.getElementById('dailySells').getContext('2d');
        var monthlySells = document.getElementById('monthlySells').getContext('2d');
        

        const getDailySells = async () => {

            const data = await axios.get('/statistics/dailySells');

            let labels = data.data.map((item, index) => item.day);
            let values = data.data.map((item, index) => item.total);
            
            return [labels, values]
        }

        const getMonthlySells = async () => {

            const data = await axios.get('/statistics/monthlySells');
            const months = 
                [
                    "Enero", 
                    "Febrero", 
                    "Marzo", 
                    "Abril", 
                    "Mayo", 
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ];

            let labels = data.data.map((item, index) => months[item.month-1]);
            let values = data.data.map((item, index) => item.total);
            
            return [labels, values]
        }

        const graphicDailySells = async () =>{
            let data = await getDailySells();

            var dayilySellsChart = new Chart(dailySells, {
                type: 'line',
                data: {
                    labels: data[0],
                    datasets: [{
                        label: 'Venta en los últimos 15 dias',
                        data: data[1],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        tension: 0.2,
                        borderWidth: 1
                    }]
                },
            });
        }

        const graphicMonthlySells = async () =>{
            let data = await getMonthlySells();

            var monthlySellsChart = new Chart(monthlySells, {
                type: 'line',
                data: {
                    labels: data[0],
                    datasets: [{
                        label: 'Venta en el último año',
                        data: data[1],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)'
                        ],
                        tension: 0.2,
                        borderWidth: 1
                    }]
                },
            });
        }

        graphicDailySells();
        graphicMonthlySells();

    </script>
@endsection