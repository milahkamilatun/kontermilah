<?php
session_start();
if (!isset($_SESSION['user'])) {
    return header('Location: http://localhost:8080/kontermilah/views/login/' );
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan - kontermilah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  </head>
  <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container-fluid {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-bottom: 1px solid #007bff;
            border-radius: 8px 8px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-add {
            background-color: #007bff;
            color: #fff;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .modal-content {
            border-radius: 8px;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 8px 8px;
        }

        .btn-close {
            color: #fff;
        }

        .alert-success {
            color: #007bff;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .text-danger {
            color: #dc3545;
        }


        body {
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #dc3545;
            color: #fff;
            padding: 10px 15px;
        }

        .card-body {
            padding: 20px;
        }

        .btn-add {
            background-color: #007bff;
            color: #fff;
        }
    </style>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://localhost:8080/kontermilah/views/dashboard/index.php">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://localhost:8080/kontermilah/views/users/index.php">Users</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="http://localhost:8080/kontermilah/views/barangs/index.php">Barang</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transaksi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="http://localhost:8080/kontermilah/views/penjualan/index.php">Penjualan</a></li>
                            <li><a class="dropdown-item" href="#">Pembelian</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Setting</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Log Out</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
        <div id="message">
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">SELLS</div>
                    <div class="col col-sm-3">
                        <a href="http://localhost:8080/kontermilah/views/penjualan/add.php" class="btn btn-success btn-sm float-end">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="sample_data">
                        <thead>
                            <tr>
                                <th>Kode Penjualan</th>
                                <th>Tanggal Penjualan</th>
                                <th>Customer</th>
                                <th>Kasir</th>
                                <th>Grand Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="action_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Trxid</label>
                                <input type="text" name="trxid" id="trxid" class="form-control" />
                                <span id="trxid_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                    <input type="date_sell" name="date_sell" id="date_sell" class="form-control" />
                                    <span id="date_sell_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Customer</label>
                                <input type="nama_customer" name="nama_customer" id="nama_customer" class="form-control" />
                                <span id="nama_customer_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kasir</label>
                                    <input type="kasir" name="kasir" id="kasir" class="form-control" />
                                    <span id="kasir_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Grand Total</label>
                                    <input type="grand_total" name="grand_total" id="grand_total" class="form-control" />
                                    <span id="grand_total_error" class="text-danger"></span>
                             </div>
                           
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="action_button">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
    $(document).ready(function() {
        showAll();

        $('#add_data').click(function(){
            $('#dynamic_modal_title').text('Add Data penjualan');
            $('#sample_form')[0].reset();
            $('#action').val('Add');
            $('#action_button').text('Add');
            $('.text-danger').text('');
            $('#action_modal').modal('show');
        });
        
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == "Add"){
                var formData = {
                'trxid' : $('#trxid').val(),
                'date_sell' : $('#date_sell').val(),
                'nama_customer' : $('#nama_customer').val(),
                'kasir' : $('#kasir').val(),
                'grand_total' : $('#grand_total').val()
                }

                $.ajax({
                    url:"http://localhost:8080/kontermilah/api/penjualan/create.php",
                    method:"POST",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }else if($('#action').val() == "Update"){
                var formData = {
                    'id' : $('#id').val(),
                    'trxid' : $('#trxid').val(),
                    'date_sell' : $('#date_sell').val(),
                    'nama_customer' : $('#nama_customer').val(),
                    'kasir' : $('#kasir').val(),
                    'grand_total' : $('#grand_total').val()
                }

                $.ajax({
                    url:"http://localhost:8080/kontermilah/api/penjualan/update.php",
                    method:"PUT",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            });
    });

    function showAll() {
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:"http://localhost:8080/kontermilah/api/penjualan/read.php",
            success: function(response) {
            // console.log(response);
                var json = response.body;
                var dataSet=[];
                for (var i = 0; i < json.length; i++) {
                    var sub_array = {
                        'trxid' : json[i].trxid,
                        'date_sell' : json[i].date_sell,
                        'nama_customer' : json[i].nama_customer,
                        'kasir' : json[i].kasir,
                        'grand_total' : json[i].grand_total,
                        'action': '<button onclick="deleteOne(' + json[i].id + ')" class="btn btn-sm btn-danger">Delete</button>' +
                        '<button class="btn btn-sm btn-info btn-print" onclick="printOne(' + json[i].id + ')"><i class="bi bi-printer"></i>Print</button>'
                    };
                    dataSet.push(sub_array);
                }
                $('#sample_data').DataTable({
                    data: dataSet,
                    columns : [
                        { data : "trxid" },
                        { data : "date_sell" },
                        { data : "nama_customer" },
                        { data : "kasir" },
                        { data : "grand_total" },
                        { data : "action" }
                    ]
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function showOne(id) {
        $('#dynamic_modal_title').text('Edit Data');
        $('#sample_form')[0].reset();
        $('#action').val('Update');
        $('#action_button').text('Update');
        $('.text-danger').text('');
        $('#action_modal').modal('show');

        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:
            "http://localhost:8080/kontermilah/api/penjualan/read.php?id="+id,
            success: function(response) {
                $('#id').val(response.id);
                $('#trxid').val(response.trxid);
                $('#date_sell').val(response.date_sell);
                $('#nama_customer').val(response.nama_customer);
                $('#kasir').val(response.kasir);
                $('#grand_total').val(response.grand_total);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function deleteOne(id) {
        alert('Yakin untuk hapus data ?');
        $.ajax({
            url:"http://localhost:8080/kontermilah/api/penjualan/delete.php",
            method:"DELETE",
            data: JSON.stringify({"id" : id}),
            success:function(data){
                $('#action_button').attr('disabled', false);
                $('#message').html('<div class="alert alert-success">'+data+'</div>');
                $('#action_modal').modal('hide');
                $('#sample_data').DataTable().destroy();
                showAll();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
    function printOne(id) {
    // Trigger the print action
    window.print();
  }
  // Add an event listener to handle print button click
  document.getElementById('print_button').addEventListener('click', function() {
    // Trigger the print action
    window.print();
    });
    </script>
</body>
</html>