@extends('layouts.dashboard')


@section('title', 'Inicio')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg-white rounded shadow-sm py-1">
                <canvas id="dailySells" height="70">></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-white rounded shadow-sm my-3 py-1">
                <canvas id="monthlySells" height="70">></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 bg-white rounded shadow-sm my-3 py-1">
                <canvas id="monthlyBestClient" height="70">></canvas>
                {{-- <h5>Clientes del mes</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Cliente</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bestClients as $key => $client)
                            <tr>
                                <td>{{ $client->name}}</td>
                                <td>$ {{ number_format($client->total)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
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
        var monthlyBestClient = document.getElementById('monthlyBestClient').getContext('2d');
        

        const getDailySells = async () => {

            const data = await axios.get('/statistics/dailySells');

            let labels = data.data.map((item, index) => item.day);
            let values = data.data.map((item, index) => item.total);
            
            return [labels, values]
        }
        
        const getMonthlyBestClient = async () => {

            const data = await axios.get('/statistics/bestClient');

            let labels = data.data.map((item, index) => item.name);
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
                            '#6f42c1'
                        ],
                        borderColor: [
                            '#6610f2'
                        ],
                        tension: 0.2,
                        borderWidth: 1
                    }]
                },
            });
        }
        
        const graphicBestClient = async () =>{
            let data = await getMonthlyBestClient();

            var monthlyBestClientChart = new Chart(monthlyBestClient, {
                type: 'line',
                data: {
                    labels: data[0],
                    datasets: [{
                        label: 'Los 5 mejores clientes del mes',
                        data: data[1],
                        backgroundColor: [
                            '#6f42c1'
                        ],
                        borderColor: [
                            '#6610f2'
                        ],
                        tension: 0.2,
                        borderWidth: 1
                    }]
                },
            });
        }

        graphicDailySells();
        graphicMonthlySells();
        graphicBestClient();

    </script>
@endsection