		        	<nav class="navbar navbar-inverse">
		          		<div class="container-fluid">
		            		<div class="navbar-header">
		                		<img src="img/RC.png" width="100" height="50">
		            		</div>
		            		<ul class="nav navbar-nav">
			              		<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>   Inicio</a></li>
			              		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-sunglasses"></span>Tipos de ropa <span class="caret">
				    				</span></a>
				                	<ul class="dropdown-menu">
                                        <li><a href="consultarRopa.php?var=<?php echo $caba; ?>&action=<?php echo ''; ?>">Caballeros</a></li>
                                        <li><a href="consultarRopa.php?var=<?php echo $dama; ?>&action=<?php echo ''; ?>">Damas</a></li>
				                	</ul>
			             		</li>
			              		<li><a href="nosotros.php"><span class="glyphicon glyphicon-user"></span> Nosotros</a></li>
			              		<li><a href="tiendas.php"><span class="glyphicon glyphicon-briefcase"></span> Tiendas</a></li>
			                	<li><a href="contacto.php"><span class="glyphicon glyphicon-envelope"></span> Contacto</a></li>
		            		</ul>
                            <?php if(isset($_SESSION['user']['id'])) 
                            { ?>
		    				<ul class="nav navbar-nav navbar-right">
                                <li><a href="carro.php?id=0&action='mostrar'"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a></li>
				    			<li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['name']; ?></a></li>
				    			<li><a href="logout.php" title="Cerrar Sesion"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesion</a></li>
			    			</ul>
                            <?php } 

                                else
                                {
                                    ?>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="carro.php?id=0&action='mostrar'"><span class="glyphicon glyphicon-shopping-cart"></span> Carrito</a></li>
                                    <li><a href="registro.php"><span class="glyphicon glyphicon-user"></span> Registrarse</a></li>
                                    <li><a href="iniciar_sesion.php" title="Iniciar Sesion"><span class="glyphicon glyphicon-log-in"></span> Iniciar Sesion</a></li>
                                </ul>
                            <?php
                                }

                            ?>
		          		</div>
		          	</nav> 