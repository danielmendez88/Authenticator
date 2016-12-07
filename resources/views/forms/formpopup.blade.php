<style>
#container {
    margin: 0px auto;
    width: 500px;
    height: 375px;
    border: 5px #333 solid;
}
.elementVideo {
    width: 490px;
    height: 365px;
    background-color: #666;
}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="container">
						<video id="videoElement" autoplay="true" class="elementVideo">
							
						</video>
					</div>
					<script>
						var video = document.querySelector("#videoElement");
						 
						navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
						 
						if (navigator.getUserMedia) {       
						    navigator.getUserMedia({video: true}, handleVideo, videoError);
						}
						 
						function handleVideo(stream) {
						    video.src = window.URL.createObjectURL(stream);
						}
						 
						function videoError(e) {
						    // do something
						}						
					</script>
				</div>
			</div>
		</div>
	</div>
</div>