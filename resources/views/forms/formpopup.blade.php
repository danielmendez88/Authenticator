<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<!--navegación-->
					<div class="navbar-form">
	 					<button title="Reproducir" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip">
	 							<span class="glyphicon glyphicon-play"></span>
	 					</button>
	                    <button title="Pausar" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip">
	                    		<span class="glyphicon glyphicon-pause"></span>
	                    </button>
	                    <button title="Detener Transmisión" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"></span></button>	
					</div>
				</div>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="well" width="320" height="240" style="position: relative; display: inline-block;">
		                    <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
		                    <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
		                    <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
		                    <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
		                    <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>							
						</div>
						<p id="scanned-QR"></p>
					</div>
					<!--contenedor-->
					<!--<div id="container">
						<video id="videoElement" autoplay="true" class="elementVideo">
							
						</video>
					</div>-->
				</div>
			</div>
		</div>
	</div>
</div>