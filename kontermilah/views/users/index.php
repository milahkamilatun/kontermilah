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
    <title>Users - Kontermilah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
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
        <div id="message">
        </div>
        <h1 class="mt-4 mb-4 text-center text-danger">USERS
        CRUD</h1>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">USERS</div>
                    <div class="col col-sm-3">
                        <button type="button" id="add_data" class="btn
                        btn-success btn-sm float-end">Add</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="sample_data">
                        <thead>
                            <tr>
                                <th>FullName</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
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
                                <label class="form-label">FullName</label>
                                <input type="text" name="fullname" id="fullname" class="form-control" />
                                <span id="name_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" />
                                <span id="email_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                    <input type="password" name="pass" id="password" class="form-control" />
                                    <span id="pass_error" class="text-danger"></span>
                                </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select id="role" class="form-select">
                                <option selected>Choose...</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="owner">Owner</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                                </select>
                                <span id="role_error" class="text-danger"></span>
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
            $('#dynamic_modal_title').text('Add Data');
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
                'fullname' : $('#fullname').val(),
                'email' : $('#email').val(),
                'password' : $('#password').val(),
                'role' : $('#role').val()
                }

                $.ajax({
                    url:"http://localhost:8080/kontermilah/api/user/create.php",
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
                    'fullname' : $('#fullname').val(),
                    'email' : $('#email').val(),
                    'password' : $('#password').val(),
                    'role' : $('#role').val()
                }

                $.ajax({
                    url:"http://localhost:8080/kontermilah/api/user/update.php",
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
            url:"http://localhost:8080/kontermilah/api/user/read.php",
            success: function(response) {
            // console.log(response);
                var json = response.body;
                var dataSet=[];
                for (var i = 0; i < json.length; i++) {
                    var sub_array = {
                        'fullname' : json[i].fullname,
                        'email' : json[i].email,
                        'role' : json[i].role,
                        'created' : json[i].created,
                        'action' : '<button onclick="showOne('+json[i].id+')" class="btn btn-sm btn-warning">Edit</button>'+
                        '<button onclick="deleteOne('+json[i].id+')" class="btn btn-sm btn-danger">Delete</button>'
                    };
                    dataSet.push(sub_array);
                }
                $('#sample_data').DataTable({
                    data: dataSet,
                    columns : [
                        { data : "fullname" },
                        { data : "email" },
                        { data : "role" },
                        { data : "created" },
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
            "http://localhost:8080/kontermilah/api/user/read.php?id="+id,
            success: function(response) {
                $('#id').val(response.id);
                $('#fullname').val(response.fullname);
                $('#email').val(response.email);
                $('#role').val(response.role).change();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function deleteOne(id) {
        alert('Yakin untuk hapus data ?');
        $.ajax({
            url:"http://localhost:8080/kontermilah/api/user/delete.php",
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
    </script>
</body>
</html>