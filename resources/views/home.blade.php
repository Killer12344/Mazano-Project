@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 col-md-3">
            <div class="card mb-3 mb-md-0 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="">
                        <h5 class="font-weight-bolder mb-2">Products</h5>
                        <h3 class="text-center m-0 text-success"> {{ $products->count()  }} </h3>
                    </div>
                    <i class="feather-tag text-light bg-primary py-2 px-4" style="font-size: 55px; border-radius: 20px"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card mb-3 mb-md-0 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="">
                        <h5 class="font-weight-bolder mb-2">Categories</h5>
                        <h3 class="text-center m-0 text-success"> {{ $categories->count()  }} </h3>
                    </div>
                    <i class="feather-layers text-light bg-primary py-2 px-4" style="font-size: 55px; border-radius: 20px"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card mb-3 mb-md-0 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="">
                        <h5 class="font-weight-bolder mb-2">Brands</h5>
                        <h3 class="text-center m-0 text-success"> {{ $brands->count()  }} </h3>
                    </div>
                    <i class="feather-award text-light bg-primary py-2 px-4" style="font-size: 55px; border-radius: 20px"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card mb-3 mb-md-0 shadow">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="">
                        <h5 class="font-weight-bolder mb-2">Users</h5>
                        <h3 class="text-center m-0 text-success"> {{ $users->where('role','1')->count() }} </h3>
                    </div>
                    <i class="feather-users text-light bg-primary py-2 px-4" style="font-size: 55px; border-radius: 20px"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="font-weight-bolder text-center mb-3"> Product Category </h4>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="font-weight-bolder text-center mb-3"> Product Brand </h4>
                    <canvas id="product"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="product"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('foot')

<?php

    $data = [];
    $dataB = [];

    foreach ($categories as $k => $v) {
        $vl = $v->product->count();
        array_push($data,$vl);
    };

    foreach ($brands as $k => $v) {
        $vl = $v->product->count();
        array_push($dataB,$vl);
    };

?>


<script>


    let cat = @json($categories);
    let brand = @json($brands);
    let data = @json($data);
    let dataB = @json($dataB);

    let labels = [];
    let labelsB = [];


    cat.forEach(el => {
        let title = el.title
        labels.push(title);
    });

    brand.forEach(el => {
        let title = el.name
        labelsB.push(title);
    });


const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false,
                position: 'bottom',
                labels: {
                    color: 'rgb(255, 99, 132)',
                    pointStyle: 'circle',
                    usePointStyle: 'boolean',
                }
            }
        }
    }
});

const ctx1 = document.getElementById('product').getContext('2d');
const myChart1 = new Chart(ctx1, {
    type: 'pie',
    data: {
        labels: labelsB,
        datasets: [{
            label: '# of Votes',
            data: dataB,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 0
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false,
                position: 'bottom',
                labels: {
                    color: 'rgb(255, 99, 132)',
                    pointStyle: 'circle',
                    usePointStyle: 'boolean',
                }
            }
        }
    }
});

</script>


@endsection
