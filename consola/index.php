<?php 
include './server/sessionstart.php';

include './server/database.php';

include './server/querys.php';

?>
<script>
//Funcion que cada 100ms ejecuta Funcion URLChecker
setInterval(URLChecker, 100);

//Funcion para checkear la URL
function URLChecker(){
  //Obtencion de URL
  const URL=window.location.href;
  //Ifs continuos buscando la cadena de valor de cada href para ejecutar la funcion "Selected();" 
  //Selected(); esta en index.js y determina el movimiento de la pagina
    if(URL.indexOf('Ventas') > -1){Seleccionar(selected=1);}
    if(URL.indexOf('Productos') > -1){Seleccionar(selected=2);}
    if(URL.indexOf('Reportes') > -1){Seleccionar(selected=3);}
    if(URL.indexOf('Categorias') > -1){Seleccionar(selected=8);}
    if(URL.indexOf('Configuracion') > -1){Seleccionar(selected=5);}
    if(URL.indexOf('EditarProducto') > -1){Seleccionar(selected=6);}
    if(URL.indexOf('Agregar') > -1){Seleccionar(selected=4)}
}
</script>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Terra Consola</title>
	<meta name="author" content="HAZEinc.">
	<meta name="description" content="Ventas online y control de stock">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="icon" type="image/x-icon" href="./media/favicon.png"/>
	
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/index.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Edic. Global Productos -->
  <link rel="icon" type="image/x-icon" href="./css/edicprod.css"/>

 
</head>

<body onload="showTime()">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0"> 
      <a class="text-center navbar-brand col-sm-3 col-md-2 mr-0" href="#">Consola Terracosmetica</a>
      <p id="MyClockDisplay" class="text-center col-sm-3 col-md-2 mr-0" style="color:white;margin: 0;"></p>
      <ul class="navbar-nav px-3">      
        <li class="nav-item text-nowrap">
          <form method="post" class="form-inline" style="margin-bottom: 0px;">
          <button type="button" class="btn btn-primary rounded-circle" title="<?php echo $_SESSION['NombreUsuario']; ?>" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Se encuentra logueado con: <?php echo $_SESSION['NombreUsuario']; ?>"> <?php echo substr($_SESSION['NombreUsuario'], 0, 1); ?> </button>
          <button type="submit" name="LogOut" class="btn nav-link" >Log out</button>
          </form>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">

        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#Ventas" id="Ventas" onclick="Seleccionar(selected=1)">
                  <span data-feather="dollar-sign"></span>
                  Ventas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#Productos" id="Productos" onclick="Seleccionar(selected=2)">
                  <span data-feather="gift"></span>
                  Productos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#Categorias" id="Categorias" onclick="Seleccionar(selected=8)">
                  <span data-feather="filter"></span>
                  Categorias
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#Reportes" id="Reportes" onclick="Seleccionar(selected=3)">
                  <span data-feather="bar-chart-2"></span>
                  Reportes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#Configuracion" id="Configuracion" onclick="Seleccionar(selected=5)">
                  <span data-feather="settings"></span>
                  Configuracion
                </a>
              </li>
            </ul>
            <div class="fixed-bottom Marca">
            <a href="http://hazear.com/" target="_blank"><strong>HAZE</strong></a>
            <h1 class="h2"><strong>S O V</strong></h1>
            <p>Versión <?php echo $VERSION; ?></p>
          </div>
          </div>

        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            
          <!-- VENTAS -->
          <div class="" id="VentasTitulo">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="h2">Ventas</h1>
            </div>


            <div class="table-responsive">
                              <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th>Codigo Envio</th>                                    
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Estado</th>                                    
                                    <th></th>       
                                    <th></th>
                                    <th></th>                              
                                  </tr>
                                </thead>
                                <tbody>
                  <?php 
                  //MOSTRADOR DE VENTAS (LISTADO)
                  
                  $sql ="SELECT * FROM TERRA_Ventas ORDER BY 'Estado' ASC";
                  $result= $conn->query($sql);
                  if ($result->num_rows > 0) {
                  //Output data of each row
                  while($row = $result->fetch_assoc()) {                   
                               ?>                     
                                  <tr>
                                        <td><?php echo $row["CodigoPedido"]; ?></td>                                                                    
                                        <td>
                                          <?php
                                                $source = $row["Fecha"];
                                                $date = new DateTime($source);
                                                echo $date->format('d/m/Y');
                                            ?>                                        
                                        </td>
                                        <td>$ <?php echo $row["PrecioTotal"]; ?></td>                                        
                                        <td>
                                        <?php
                                              switch ($row["Estado"]) {
                                              case "0": ?>
                                                  <span class="badge badge-danger">ERROR</span>
                                              <?php break;
                                              case "1": ?>
                                                  <span class="badge badge-secondary">FALTA DE PAGO</span> 
                                              <?php break;
                                              case "2": ?>
                                                  <span class="badge badge-warning">PENDIENTE</span>
                                              <?php break;
                                              case "3": ?>
                                                  <span class="badge badge-primary">EN CAMINO</span>
                                              <?php break;
                                              case "4": ?>
                                                  <span class="badge badge-success">ENTREGADO</span>
                                              <?php break;
                                              } 
                                              ?>
                                        </td>
                                        <td>                                         
                                        <button class="btn btn-light" title="Ver Mas" data-toggle="modal" data-target="#modalVentas<?php echo $row["ID"]; ?>"><span data-feather="plus"></span></button>
                                        </td>
                                        <td>                                         
                                        <button class="btn btn-light" title="Descargar" onclick="DivAPdf()"><span data-feather="download"></span></button>
                                        </td>


                                  
                                        <td>
                                  <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalVentas<?php echo $row["ID"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div id="Ticket" class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header row align-items-center m-0">
                <h5 class="modal-title col-6">Pedido N° <span id="CodigoPedido" ><?php echo $row["CodigoPedido"]; ?></span></h5>

                <?php
                switch ($row["Estado"]) {
                case "0": ?>
                    <span class="badge badge-danger col-3">ERROR</span>
                <?php break;
                case "1": ?>
                    <span class="badge badge-secondary col-3">FALTA DE PAGO</span> 
                <?php break;
                case "2": ?>
                    <span class="badge badge-warning col-3">PENDIENTE</span>
                <?php break;
                case "3": ?>
                    <span class="badge badge-primary col-3">EN CAMINO</span>
                <?php break;
                case "4": ?>
                    <span class="badge badge-success col-3">ENTREGADO</span>
                <?php break;
                } 
                ?>

                  <button type="button" class="close col-3" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                
                <?php
                $sqlV ="SELECT * FROM TERRA_Clientes WHERE ID='".$row["IDCliente"]."' ";
                
                  $resultV= $conn->query($sqlV);
                  if ($resultV->num_rows > 0) {
                    $filaV = mysqli_fetch_object($resultV);
                    ?>

                <div class="row">
                <h6 class="col-6">Datos De Cliente</h6>
                <h6 class="col-6">Fecha: <?php echo $date->format('d/m/Y'); ?></h6>
                </div>
                  
                  <p>Nombre: <?php echo $filaV->Nombre ." ". $filaV->Apellido; ?></p>
                  <p> <?php 
                  switch ($filaV->TipoDoc) {
                  case "0": echo "DNI"; 
                  break;
                  case "1": echo "Libreta Civica"; 
                  break;
                  case "2": echo "Pasaporte"; 
                  break;
                  default: echo "N/A";  
                  break;}
                  ?>: <?php echo $filaV->Doc; ?></p>

                  <h6>Datos De Contacto</h6>
                  <p>Email: <?php echo $filaV->Email; ?></p>
                  <p>Telefono: <?php echo $filaV->Telefono; ?></p>
                  <p>Direccion: <?php echo $filaV->Calle ." ". $filaV->Altura ." ".$filaV->Localidad ." ". $filaV->Provincia;?></p>
                  <p>Codigo Postal: <?php echo $filaV->Postal; ?></p>
                  <p>Departamento: <?php echo $filaV->Departamento; ?></p>

                  <h6>Observaciones</h6>
                  <p><?php echo $filaV->Observaciones; ?></p>

                
                <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                      </tr>
                    </thead>
                    <tbody>
                  
                  <?php
                }else { echo"Cliente no Registrado"; }

                $sqlPedidos ="SELECT * FROM TERRA_Pedidos WHERE CodigoPedido='".$row["CodigoPedido"]."' ";
                $resultPedidos= $conn->query($sqlPedidos);
                if ($resultPedidos->num_rows > 0) {
                //Output data of each row
                while($rowPedidos = $resultPedidos->fetch_assoc()) {

                $sqlP ="SELECT * FROM TERRA_Productos WHERE ID='".$rowPedidos["IDProducto"]."' ";
                
                $resultP= $conn->query($sqlP);
                if ($resultP->num_rows > 0) {
                  $filaP = mysqli_fetch_object($resultP);
                ?>

                  
                      <tr>
                        <td><?php echo $filaP->Codigo; ?></td>
                        <td><?php echo $filaP->Nombre; ?></td>
                      </tr>                     
                   

                <?php
                } 
              else { echo"Productos no Registrados"; }
              }
            } else { echo"Pedido no Registrado"; }
                ?>


                </tbody>
                  </table>



                </div>


                <div id="elementH"></div>
                <div class="modal-footer d-flex justify-content-between">
                <!-- Cambio de estado en tabla ventas -->
                <form action="index.php#Ventas" method="post">
                <select class="form-select" name="EditarEstado" aria-label="" onchange="this.form.submit()">
                                        <?php if($row["Estado"]==0){ ?>                                      
                                        <option selected>ERROR</option>
                                        <?php } else{ ?>                                                                                 
                                        <option value="1" <?php if($row["Estado"]==1){echo "selected";}; ?>>FALTA DE PAGO</option>
                                        <option value="2" <?php if($row["Estado"]==2){echo "selected";}; ?>>PENDIENTE</option>
                                        <option value="3" <?php if($row["Estado"]==3){echo "selected";}; ?>>EN CAMINO</option>
                                        <option value="4" <?php if($row["Estado"]==4){echo "selected";}; ?>>ENTREGADO</option>
                                        <?php }; ?>
                  </select>
                  <input type="hidden" name="IDVentas" value="<?php echo $row["ID"]; ?>" />
                  </form>


                  <button type="button" class="btn btn-primary" onclick="DivAPdf()">Descargar comprobante</button>

             



                 

                </div>
              </div>
            </div>
          </div>
<!-- FIN Modal -->
</td>
</tr>
                         <?php   } }else {  ?>
                            <tr>
                            NO HAY Ventas
                            <tr>
                      <?php     }   ?>             
                  </tbody>
                </table>
              </div>

            </div>
            
          
     
        
          <!-- PRODUCTOS -->
            <div class="Ocultar" id="ProductosTitulo">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
            <h1 class="h2">Productos</h1>           
            <form class="form-inline mr-auto mb-0" method="POST" action='index.php#Productos'>
            <select class="custom-select my-1 mr-sm-2" id="Filtro" name="Filtro" onchange="this.form.submit()">
              <option <?php if($Filtro=="10000"){echo"selected";}; ?> value="10000">Todos</option>
              <option <?php if($Filtro=="20"){echo"selected";}; ?> value="20">20</option>
              <option <?php if($Filtro=="50"){echo"selected";}; ?> value="50">50</option>
              <option <?php if($Filtro=="100"){echo"selected";}; ?> value="100">100</option>
              <option <?php if($Filtro=="500"){echo"selected";}; ?> value="500">500</option>              
            </select>
            </form>
            <form class="form-inline mb-0">
            <input id="SearchBox" type="search" class="form-control mr-sm-2" placeholder="Buscador" aria-label="Search" onchange="window.find(document.getElementById('SearchBox').value,false,false,true);">
            <button id="Agregar" type="button" class="btn btn-outline-dark mr-2" onclick="Seleccionar(selected=4),window.location='#Agregar'">Agregar Producto</button>
            <button id="modal" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#EdicionRapida">Edicion Rapida <span class="badge badge-light">4</span></button>
            </form>
            </div>

<!-- Modal -->
<div class="modal fade" id="EdicionRapida" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">EdicionRapida</h5>
                  <p>Productos seleccionados:4</p>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                <div class="form-row">
                 <div class="col">
                  <label for="Stock">Cantidad</label>
                    <input type="text" class="form-control mb-2" id="Stock" name="Stock" placeholder="Cantidad" required>
                </div>

                <div class="col">
                  <label for="MargenML">Margen</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Margen" name="Margen" placeholder="100" value="" onchange="CalculoPrecio()">
                  </div>
                </div>

                <div class="col">
                  <label for="Precio">Oferta</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Oferta" name="Oferta" placeholder="Oferta" value="" onchange="CalculoPrecio()">
                  </div>
                </div>
                </div>



                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar</button>
                  <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
              </div>
            </div>
          </div>  
<!-- FIN Modal -->
<div class="mdl-grid" style="width:1000px;margin-top:100px;">
  <div id="products" class="mdl-data-tabledynamic mdl-shadow--2dp">
    <div class="mdl-data-tabledynamic__title">
      <div class="mdl-data-tabledynamic__actions">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect add-row">
                                            ADD
                                        </a>
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect remove-row">
                                            REMOVE
                                        </a>
      </div>

    </div>

    <div class="mdl-data-tabledynamic__content">
      <table class="mdl-data-table mdl-data-dynamictable mdl-js-data-table mdl-shadow--2dp mdl-cell--6-col mdl-data-table__row--selectable">
        <thead>

          <tr>
            <th>
              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="checkbox-all">
                                                        <input type="checkbox" id="checkbox-all" class="mdl-checkbox__input">
                                                    </label>
            </th>
            <th class="mdl-data-table__cell--non-numeric">Codigo</th>
            <th class="mdl-data-table__cell--non-numeric">Nombre</th>
            <th class="mdl-data-table__cell--non-numeric">Stock</th>
            <th class="mdl-data-table__cell--non-numeric">Categoria 1</th>
            <th class="mdl-data-table__cell--non-numeric">Categoria 2</th>
            <th class="mdl-data-table__cell--non-numeric">Categoria 3</th>
            <th>Costo</th>
            <th>Margen</th>
            <th>Oferta</th>
            <th>Precio</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          //MOSTRADOR DE PRODUCTOS (LISTADO)

          //Cuando la pagina carga por primera vez setea el filtro para mostrar 19 productos(pantalla completa)
          if (isset($_POST['Filtro'])){$Filtro=$_POST['Filtro'];}else{$Filtro="19";};
          
          $class="FormLista";
          //Checkeo si hay producto con categoria que haya sido previamente eliminada
          $categoriaFaltante="SELECT * FROM TERRA_Productos where aux1='1' AND Eliminar!='1' LIMIT ".$Filtro." ";                  
          $resultado= $conn->query($categoriaFaltante);
          if($resultado->num_rows >0){
          //Si el resultado es mayor a cero muestro los productos sin categoria por eliminacion primero
          $sql ="SELECT * FROM TERRA_Productos WHERE Eliminar!='1' order by aux1 desc LIMIT ".$Filtro."";
          $result= $conn->query($sql);
          }else
          {
          //En caso de no haber productos con categorias eliminadas previamente ordeno por bloques de Categoria1
          $sql ="SELECT * FROM TERRA_Productos WHERE Eliminar!='1' order by Categoria desc LIMIT ".$Filtro."";
          $result= $conn->query($sql);
          }
          if ($result->num_rows > 0) {
          //Output data of each row
          while($row = $result->fetch_assoc()) {
            $search1=$row["Categoria"];
            $search2=$row["Categoria2"];
            $search3=$row["Categoria3"];
            //Obtencion de Nombre categoria by ID
            $sqlID = "SELECT * FROM TERRA_Categorias WHERE ID = '$search1'";
            $resultID= $conn->query($sqlID);
            $row1 = $resultID->fetch_assoc();
            $NombreCategoria1=$row1["Nombre"];

            $sqlID2 = "SELECT * FROM TERRA_Categorias WHERE ID = '$search2'";
            $resultID2= $conn->query($sqlID2);
            $row2 = $resultID2->fetch_assoc();
            $NombreCategoria2=$row2["Nombre"];

            $sqlID3 = "SELECT * FROM TERRA_Categorias WHERE ID = '$search3'";
            $resultID3= $conn->query($sqlID3);
            $row3 = $resultID3->fetch_assoc();
            $NombreCategoria3=$row3["Nombre"];
                       ?>                     
          <tr>
            <td>
              <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select" for="checkbox-1">

                                                        <input type="checkbox" id="checkbox-1" class="mdl-checkbox__input">
                                                    </label>
            </td>
            <form action="index.php#Productos" method="post" id="EditarProducto<?php echo $row["ID"]; ?>"> 
                     
              <td> <span class="mdl-data-table__label add-table-content" title="product name"> <?php echo $row["Codigo"]; ?> </span></td>
              <td><?php echo $row["Nombre"]; ?></td>                            
              <td><?php echo $row["Stock"]; ?></td>
              <td><?php echo $NombreCategoria1; ?></td>
              <td><?php echo $NombreCategoria2; ?></td>
              <td><?php echo $NombreCategoria3; ?></td>
              <td>$<input name="CostoProducto" type="text"  onchange="document.getElementById('EditarProducto<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Costo"]; ?>"></td>
              <td>%<input name="MargenProducto" type="text"  onchange="document.getElementById('EditarProducto<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Margen"]; ?>"></td>
              <td>%<input name="OfertaProducto" type="text"  onchange="document.getElementById('EditarProducto<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Oferta"]; ?>"></td>
              <td>$<input name="PrecioProducto" type="text"  onchange="document.getElementById('EditarProducto<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Precio"]; ?>"></td>
              <td> 
              <button disabled class="btn btn-light" title="<?php if ($row['Mostrar']!=1){echo "NO ";};?>Se Muestra"><span data-feather="eye<?php if ($row['Mostrar']!=1){echo "-off";}; ?>"></span></button>
              </td>
              <input type="hidden" name="IDProducto" value="<?php echo $row["ID"]; ?>" />
              <input type="hidden" name="EditarProducto" value="set" />
          </form>
          <td> 
          <form action="index.php#EditarProducto" class="mb-0" method="post">
          <input type="hidden" name="IDProducto" value="<?php echo $row["ID"]; ?>" />
              <button class="btn btn-light" id="MenuEditarProducto" name="MenuEditarProducto" onclick="this.form.submit()"><span data-feather="edit"></span></button>
              
              </form>  
         </td> 
          <td>                 
              <form action="index.php#Productos" class="mb-0" method="post">
                  <input type="hidden" name="IDProducto" value="<?php echo $row["ID"]; ?>" />
                  <button class="btn btn-light" name="EliminarProducto" onclick="this.form.submit()"><span data-feather="trash-2"></span></button>
              </form>                                 

          </tr>
          <?php   } }else {  ?>
            <tr>
            NO HAY PRODUCTOS
            <tr>
      <?php     }   ?>      
        </tbody>
      </table>
    </div>


  </div>
</div>
<dialog class="mdl-dialog">
  <h4 class="mdl-dialog__title">Remove Products</h4>
  <div class="mdl-dialog__content">
    <p>
      Selected products will be removed. Are you sure?
    </p>
  </div>
  <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button remove">Yes</button>
    <button type="button" class="mdl-button close">Cancel</button>
  </div>
</dialog>

<!-- FORMULARIO DE CARGA DE PRODUCTOS-->
<div class="Ocultar" id="AgregarProducto">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Agregar Producto</h1>
            <button type="button" class="btn btn-outline-dark" onclick="Seleccionar(selected=2),window.location='#Productos'">X</button>
            </div>
            <form method="POST" action='' enctype='multipart/form-data'>
              <div class="form-row">
                <div class="col-1">
                  <label for="Codigo">Codigo</label>
                    <input type="text" class="form-control  mb-2" id="Codigo" placeholder="#PR0D" required name="Codigo">
                </div>

                <div class="col">
                <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control mb-2" name="Nombre" id="Nombre" placeholder="Nombre" required>
                  </div>
                  <div class="col">
                  <label for="Descripcion">Descripcion</label>
                  <input type="text" class="form-control mb-2" id="Descripcion" placeholder="Descripcion" name="Descripcion" required>
                </div>
                </div>

                <div class="form-row">
                 <div class="col-1">
                  <label for="Stock">Cantidad</label>
                    <input type="text" class="form-control mb-2" id="Stock" name="Stock" placeholder="Cantidad" required>
                </div>
                <div class="col">
                  <label for="Categoria">Categoria 1</label>
                    <select class="form-control" id="Categoria" name="Categoria" required>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN CARGA DE PRODUCTOS
                        $sql ="SELECT * FROM TERRA_Categorias";
                        $result= $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<option value=".$row["ID"].">" .$row["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>
                <div class="col">
                  <label for="Categoria">Categoria 2</label>
                    <select class="form-control" id="Categoria2" name="Categoria2" required>
                    <option> - </option>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN CARGA DE PRODUCTOS
                        $sql ="SELECT * FROM TERRA_Categorias";
                        $result= $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<option value=".$row["ID"].">" .$row["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>
                <div class="col">
                  <label for="Categoria">Categoria 3</label>
                    <select class="form-control" id="Categoria3" name="Categoria3" required>
                    <option> - </option>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN CARGA DE PRODUCTOS
                        $sql ="SELECT * FROM TERRA_Categorias";
                        $result= $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo "<option value=".$row["ID"].">" .$row["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>
                </div>
                <div class="form-row">
                <div class="col">
                  <label for="Costo">Costo</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="Costo" name="Costo" value="" placeholder="Costo" onchange="CalculoPrecio()" >
                  </div>
                </div>

                <div class="col">
                  <label for="MargenML">Margen</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Margen" name="Margen" placeholder="100" value="" onchange="CalculoPrecio()">
                  </div>
                </div>

                <div class="col">
                  <label for="Precio">Oferta</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Oferta" name="Oferta" placeholder="Oferta" value="" onchange="CalculoPrecio()">
                  </div>
                </div>

                <div class="col">
                  <label for="Precio">Precio</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="Precio" name="Precio" placeholder="Precio">
                  </div>
                </div>
                </div>
               
                <div class="form-row">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file[]" id="file" multiple >
                  <label class="custom-file-label" for="customFile">Elegir Cinco Imagenes</label>
                </div>
                </div>
                <div class="form-row">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="Mostrar" value="1" id="defaultCheck1" checked>
                  <label class="form-check-label" for="defaultCheck1">
                    Mostrar en el Ecomerce
                  </label>
                </div>
                </div>
                <div class="form-row">
                <div class="col">
                  <button type="submit" class="btn btn-primary mb-2" name="SubirAWeb" onclick="LimpiarForm(), Seleccionar(selected=5)">Cargar</button>
                </div>
              </div>
            </form>
            </div>
          <!-- FIN DEL FORMULARIO DE CARGA DE PRODUCTOS -->


<!-- FORMULARIO DE EDICION DE PRODUCTOS-->
<?php 
if (isset($_POST['MenuEditarProducto'])) {
  $ID = $_POST['IDProducto'];
  
  $sql = "SELECT * FROM TERRA_Productos WHERE ID ='".$ID."'";
        $result = $conn->query($sql);
        if($result){
          $fila = mysqli_fetch_object($result);
          $Codigo= $fila->Codigo;
          $Nombre= $fila->Nombre;
          $Descripcion=$fila->Descripcion;
          $Stock=$fila->Stock;
          $Categoria=$fila->Categoria;
          $Categoria2=$fila->Categoria2;
          $Categoria3=$fila->Categoria3;
          $Costo=$fila->Costo;
          $Margen=$fila->Margen;
          $Precio=$fila->Precio;
          $Oferta=$fila->Oferta;
          $Mostrar=$fila->Mostrar;
          $Imagen1=$fila->Imagen1; 
          $Imagen2=$fila->Imagen2; 
          $Imagen3=$fila->Imagen3;
          $Imagen4=$fila->Imagen4;
          $Imagen5=$fila->Imagen5;

        $sqlname1="SELECT * FROM  TERRA_Categorias WHERE ID = '$Categoria'";
        $resultname1=$conn->query($sqlname1);
        $row1 = $resultname1->fetch_assoc();
        $NombreCategoria1=$row1["Nombre"];

        $sqlname2="SELECT * FROM  TERRA_Categorias WHERE ID = '$Categoria2'";
        $resultname2=$conn->query($sqlname2);
        $row2 = $resultname2->fetch_assoc();
        $NombreCategoria2=$row2["Nombre"];

        $sqlname3="SELECT * FROM  TERRA_Categorias WHERE ID = '$Categoria3'";
        $resultname3=$conn->query($sqlname3);
        $row3 = $resultname3->fetch_assoc();
        $NombreCategoria3=$row3["Nombre"];

          }
        }
?>
<div class="Ocultar" id="EditarProducto">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Editar Producto</h1>
            <button type="button" class="btn btn-outline-dark" onclick="Seleccionar(selected=2),window.location='#Productos'">X</button>
            </div>
            <form method="POST">

            <input type="hidden" name="ID" value="<?php echo $ID; ?>" />

              <div class="form-row">
                <div class="col-1">
                  <label for="Codigo">Codigo</label>
                    <input type="text" class="form-control  mb-2" value="<?php echo $Codigo;?>" id="Codigo" name="Codigo" required>
                </div>

                <div class="col">
                <label for="Nombre">Nombre</label>
                  <input type="text" class="form-control mb-2" name="Nombre" id="Nombre" value="<?php echo $Nombre;?>" required>
                  </div>
                  <div class="col">
                  <label for="Descripcion">Descripcion</label>
                  <input type="text" class="form-control mb-2" id="Descripcion" value="<?php echo $Descripcion;?>" name="Descripcion" required>
                </div>
                </div>
               
                <div class="form-row">
                 <div class="col-1">
                  <label for="Stock">Cantidad</label>
                    <input type="text" class="form-control mb-2" id="Stock" name="Stock" value="<?php echo $Stock;?>" required>
                </div>
                <div class="col">
                  <label for="Categoria">Categoria 1</label>
                    <select class="form-control" id="Categoria" name="Categoria" >
                    <option value="<?php echo $Categoria; ?>" selected> <?php echo $NombreCategoria1;?> </option>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN EDICION DE PRODUCTOS
                        $sql4 ="SELECT * FROM TERRA_Categorias WHERE ID!='$Categoria'";
                        $result4= $conn->query($sql4);
                        if ($result4->num_rows > 0) {
                            // output data of each row
                            while($row4 = $result4->fetch_assoc()) {
                              echo "<option value=".$row4["ID"].">" .$row4["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>

                <div class="col">
                  <label for="Categoria2">Categoria 2</label>
                    <select class="form-control" id="Categoria2" name="Categoria2" >
                    <option value="<?php echo $Categoria2; ?>" selected> <?php echo $NombreCategoria2;?> </option>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN EDICION DE PRODUCTOS
                        $sql5 ="SELECT * FROM TERRA_Categorias WHERE ID!='$Categoria2'";
                        $result5= $conn->query($sql5);
                        if ($result5->num_rows > 0) {
                            // output data of each row
                            while($row5 = $result5->fetch_assoc()) {
                              echo "<option value=".$row5["ID"].">" .$row5["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>

                <div class="col">
                  <label for="Categoria3">Categoria 3</label>
                    <select class="form-control" id="Categoria3" name="Categoria3" >
                    <option value="<?php echo $Categoria3; ?>" selected> <?php echo $NombreCategoria3;?> </option>
                    <?php 
                        //MOSTRADOR DE CATEGORIAS EN EDICION DE PRODUCTOS
                        $sql6 ="SELECT * FROM TERRA_Categorias WHERE ID!='$Categoria3'";
                        $result6= $conn->query($sql6);
                        if ($result6->num_rows > 0) {
                            // output data of each row
                            while($row6 = $result6->fetch_assoc()) {
                              echo "<option value=".$row6["ID"].">" .$row6["Nombre"]. "</option>";
                            }
                          } else {
                            echo "<option> - </option>";
                          }
                    ?>
                    </select>
                </div>
                </div>
                <div class="form-row">
                <div class="col">
                  <label for="Costo">Costo</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="Costo" name="Costo" value="<?php echo $Costo; ?>" onchange="CalculoPrecio()" >
                  </div>
                </div>
                
                <div class="col">
                  <label for="MargenML">Margen</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Margen" name="Margen" value="<?php echo $Margen; ?>" onchange="CalculoPrecio()">
                  </div>
                </div>
             
                <div class="col">
                  <label for="Precio">Oferta</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">%</div>
                    </div>
                    <input type="text" class="form-control" id="Oferta" name="Oferta" value="<?php echo $Oferta; ?>"  onchange="CalculoPrecio()">
                  </div>
                </div>

                <div class="col">
                  <label for="Precio">Precio</label>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">$</div>
                    </div>
                    <input type="text" class="form-control" id="Precio" name="Precio" value="<?php echo $Precio; ?>">
                  </div>
                </div>
                </div>

                <div class="form-row">
                <div class="col">
                <div class="form-check">
                  <input class="form-check-input" name="Mostrar" type="checkbox" value="1" id="defaultCheck1" <?php if($Mostrar==1){echo "checked"; }; ?>>
                  <label class="form-check-label" for="defaultCheck1">
                    Mostrar en el Ecomerce 
                  </label>
                </div>
                </div>
                </div>

<!-- FOTOS EN EDICION DE PRODUCTO -->
<div class="card-deck">
  
<div class="card">
    <div class="card-header">Imagen 1</div>
      <?php if($Imagen1==NULL){ ?>        
        <div class="card-body">
          <h5 class="card-title">Sin Asignar</h5>
          <div class="form-row">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file">
            <label class="custom-file-label" for="customFile">Elegir Imagen</label>
          </div>
          </div>
        </div>
      <?php } else{ ?>
      <div class="card-img-overlay">
      <br><br>
        <button class="btn btn-light" name="EliminarImagen1"><span data-feather="trash-2"></span></button>
      </div>
      <img class="card-img-bottom" src="<?php echo $PWDConsola . $Imagen1;?>" alt="Card image cap">
      <?php } ?>
    </div>  



    <div class="card">
    <div class="card-header">Imagen 2</div>
      <?php if($Imagen2==NULL){ ?>        
        <div class="card-body">
          <h5 class="card-title">Sin Asignar</h5>
          <div class="form-row">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file">
            <label class="custom-file-label" for="customFile">Elegir Imagen</label>
          </div>
          </div>
        </div>
      <?php } else{ ?>
      <div class="card-img-overlay">
      <br><br>
        <button class="btn btn-light" name="EliminarImagen2"><span data-feather="trash-2"></span></button>
      </div>
      <img class="card-img-bottom" src="<?php echo $PWDConsola.$Imagen2;?>" alt="Card image cap">
      <?php } ?>
    </div>
   
    <div class="card">
    <div class="card-header">Imagen 3</div>
      <?php if($Imagen3==NULL){ ?>        
        <div class="card-body">
          <h5 class="card-title">Sin Asignar</h5>
          <div class="form-row">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file">
            <label class="custom-file-label" for="customFile">Elegir Imagen</label>
          </div>
          </div>
        </div>
      <?php } else{ ?>
      <div class="card-img-overlay">
      <br><br>
        <button class="btn btn-light" name="EliminarImagen3"><span data-feather="trash-2"></span></button>
      </div>
      <img class="card-img-bottom" src="<?php echo $PWDConsola.$Imagen3;?>" alt="Card image cap">
      <?php } ?>
    </div>

    <div class="card">
    <div class="card-header">Imagen 4</div>
      <?php if($Imagen4==NULL){ ?>        
        <div class="card-body">
          <h5 class="card-title">Sin Asignar</h5>
          <div class="form-row">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file">
            <label class="custom-file-label" for="customFile">Elegir Imagen</label>
          </div>
          </div>
        </div>
      <?php } else{ ?>
      <div class="card-img-overlay">
      <br><br>
        <button class="btn btn-light" name="EliminarImagen4"><span data-feather="trash-2"></span></button>
      </div>
      <img class="card-img-bottom" src="<?php echo $PWDConsola.$Imagen4;?>" alt="Card image cap">
      <?php } ?>
    </div>

    <div class="card">
    <div class="card-header">Imagen 5</div>
      <?php if($Imagen5==NULL){ ?>        
        <div class="card-body">
          <h5 class="card-title">Sin Asignar</h5>
          <div class="form-row">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="file">
            <label class="custom-file-label" for="customFile">Elegir Imagen</label>
          </div>
          </div>
        </div>
      <?php } else{ ?>
      <div class="card-img-overlay">
      <br><br>
        <button class="btn btn-light" name="EliminarImagen5"><span data-feather="trash-2"></span></button>
      </div>
      <img class="card-img-bottom" src="<?php echo $PWDConsola . $Imagen5;?>" alt="Card image cap">
      <?php } ?>
    </div>
</div>     


                  <button type="submit" class="btn btn-primary mb-2" name="EditarProducto" onclick="">Guardar Cambios</button>
                

            </form>
            </div>
          
          <!-- FIN DEL FORMULARIO DE EDICION DE PRODUCTOS -->


          <!--CATEGORIAS -->
          <div class="Ocultar" id="CategoriasTitulo">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-2">
            <h1 class="h2">Categorias</h1>
            <!-- FORM DE CATEGORIA 
            
            SI SE HABILITA LA FUNCIONALIDAD DE CARGA Y EDICION DE CATEGORIAS HAY QUE SACAR LOS "DISABLED" y modificar "TITTLE" DE LOS INPUTS,SPANS Y FORMULARIOS POSTERIORES
            
            -->
            <form method="POST" class="form-inline mb-0">
            <input disabled title="Deshabilitado en esta versión"     type="text" class="form-control mr-sm-2" id="NombreCategoria" name="CategoriaNombre" required placeholder="NombreCategoria">
           <button disabled title="Deshabilitado en esta versión"     type="submit" class="btn btn-success" name="SubirCategoria">Agregar</button>
            </form>
            <!-- FIN DE FORM DE CATEGORIA -->
            </div>
              
            <!-- LISTADO DE CATEGORIAS-->
            <div class="table-responsive">
                              <table class="table table-striped table-sm">
                                <thead>
                                  <tr>                          
                                    <th>Nombre</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                  <?php 
                        $sql ="SELECT * FROM ".$DBN."_Categorias";
                        $result= $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              //HAY QUE AGREGAR ENCABEZADO PARA QUE SI NO HAY CATEGORIAS NO LO MUESTRE
                              ?> 
                        <tr>
                             <form action="index.php#Categorias" class="mb-0" method="post" id="EditarCategoria<?php echo $row["ID"]; ?>">
                              <td>                                
                                    <input disabled title="Deshabilitado en esta versión" class="FormLista" style="max-width: fit-content;" name="CategoriaEditNombre" type="text" required value="<?php echo $row["Nombre"]; ?>" aria-label="..." onchange="document.getElementById('EditarCategoria<?php echo $row['ID']; ?>').submit()">
                                    <input disabled type="hidden" name="IDCategoria" value="<?php echo $row["ID"]; ?>" />
                                    <input disabled type="hidden" name="EditarCategoria" value="set" />                                
                            </td> 
                                </form>
                                 
                            <td>                 
                                <form title="Deshabilitado en esta versión" class="mb-0" action="index.php#Categorias" method="post">
                                    <input type="hidden" name="IDCategoria" value="<?php echo $row["ID"]; ?>" />
                                    <button disabled title="Deshabilitado en esta versión"     class="btn btn-light" name="EliminarCategoria" onclick="this.form.submit()"><span title="Deshabilitado en esta versión" data-feather="trash-2"></span></button>
                                </form>                                    
                            </td> 
                                                                                                    
                        </tr>
                        </tbody>
                        
                         <?php   } } else {  ?>
                            <tr>
                            NO HAY CATEGORIAS
                            </tr>
                      <?php     }   ?>
                      </table>
              </div>
              </div> 

          <!-- REPORTES -->
          <div class="Ocultar" id="ReportesTitulo">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Reportes</h1>
            </div>
             En desarrollo
              </div> 

          <!-- Configuracion -->
          <div class="Ocultar" id="ConfiguracionTitulo">
              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Usuarios</h1>
                 <!-- FORM DE Ususarios -->
                    <form method="POST" class="form-inline mb-0">
                        <input type="text" class="form-control mr-sm-2" id="UsuarioNombre" name="UsuarioNombre" required placeholder="Nombre">
                        <input type="email" class="form-control mr-sm-2" id="UsuarioEmail" name="UsuarioEmail" required placeholder="Email">
                        <input type="text" class="form-control mr-sm-2" id="UsuarioContrasena" name="UsuarioContrasena" required placeholder="Contraseña">                        
                        <button type="submit" class="btn btn-success" name="SubirUsuario">Agregar</button>
                   </form>
                    <!-- FIN DE FORM DE Ususarios-->
                </div>
                    <div class="table-responsive">
                                  <table class="table table-striped table-sm">
                                    <thead>
                                      <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Contraseña</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                      <?php 
                            //MOSTRADOR DE PRODUCTOS (LISTADO)
                            $class="FormLista";
                            $sql ="SELECT * FROM ".$DBN."_Usuarios";
                            $result= $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                   ?>                     
                                        <tr>
                                           <td><?php echo $row["ID"]; ?></td>
                                            <form action="index.php#Configuracion" method="post" id="EditarUsuario<?php echo $row["ID"]; ?>">                    
                                                <td><input name="UsuarioNombre" type="text"  onchange="document.getElementById('EditarUsuario<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Nombre"]; ?>"></td>
                                                <td><input name="UsuarioEmail" type="email"  onchange="document.getElementById('EditarUsuario<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Email"]; ?>"></td>
                                                <td><input name="UsuarioContrasena" type="password"  onchange="document.getElementById('EditarUsuario<?php echo $row['ID']; ?>').submit()" class="FormLista" value="<?php echo $row["Contrasena"]; ?>"></td>                      
                                                <input type="hidden" name="IDUsuario" value="<?php echo $row["ID"]; ?>" />
                                                <input type="hidden" name="UsuarioContrasenaOld" value="<?php echo $row["Contrasena"]; ?>" />
                                                <input type="hidden" name="EditarUsuario" value="set" />
                                            </form>                                            
                                            <td>                 
                                                <form action="index.php#Configuracion" method="post">
                                                    <input type="hidden" name="IDUsuario" value="<?php echo $row["ID"]; ?>" />
                                                    <button class="btn btn-light" name="EliminarUsuario" onclick="this.form.submit()"><span data-feather="trash-2"></span></button>
                                                </form>                                    
                                            </td> 
                                        </tr>
                             <?php   } } else {  ?>
                                <tr>
                                No hay Usuarios
                                <tr>
                          <?php     }   ?>             
                      </tbody>
                    </table>
                  </div>
          </div> 


        </main>
      </div>
    </div>



    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- PDF Ventas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Edic. Global Prod. -->
    <script type="text/template" id="addContentDialogTemplate">
  <div class="mdl-dialog__addContent mdl-shadow--2dp">
    <h3 class="mdl-dialog__title">Add {{title}}</h3>
    <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="text" id="content" {{pattern}}>
        <label class="mdl-textfield__label" for="content"></label>
        <span class="mdl-textfield__error">{{error}} </span>
      </div>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="save mdl-button mdl-button--colored mdl-color-text--red-500">Save</button>
      <button type="button" class="close mdl-button mdl-button--colored mdl-color-text--red-500">Cancel</button>
    </div>
  </div>
</script>


<!-- partial -->
  <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://code.getmdl.io/1.1.3/material.min.js'></script><script  src="./js/edicprod.js"></script>


  </body>



</html>