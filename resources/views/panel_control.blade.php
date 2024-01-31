@extends('layouts.master')
@section('titulo', 'panel_control')
@section('contenido')
<h1>Hola mundo</h1>


<div class="main-container">

					<!-- Row start -->
					<div class="row gutters">
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
							<div class="info-stats4">
								<div class="info-icon">
									<i class="icon-file-text"></i>
								</div>
								<div class="sale-num">
									<?php require '../../backend/config/Conexion.php'; ?>
									<?php 
									        $sql = "SELECT COUNT(*) total FROM habitaciones";
									        $result = $connect->query($sql); //$pdo sería el objeto conexión
									        $total = $result->fetchColumn();

									         ?>
									<h3><?php echo  $total; ?></h3>
									<p>ALUMNOS</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
							<div class="info-stats4">
								<div class="info-icon">
									<i class="icon-tag"></i>
								</div>
								<div class="sale-num">


									<h3><?php echo  $total; ?></h3>
									<p>RECIBO ALUMNOS</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
							<div class="info-stats4">
								<div class="info-icon">
									<i class="icon-shopping-bag1"></i>
								</div>
								<div class="sale-num">

									<h3><?php echo  $total; ?></h3>
									<p>RECIBO S</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
							<div class="info-stats4">
								<div class="info-icon">
									<i class="icon-activity"></i>
								</div>
								<div class="sale-num">
									<?php 
									        $sql = "SELECT COUNT(*) total FROM habitaciones WHERE estadha ='3'";
									        $result = $connect->query($sql); //$pdo sería el objeto conexión
									        $total = $result->fetchColumn();

									         ?>
									<h3><?php echo  $total; ?></h3>
									<p>LIMPIEZA</p>
								</div>
							</div>
						</div>
					</div>
@endsection
