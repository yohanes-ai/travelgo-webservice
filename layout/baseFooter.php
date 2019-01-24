				<!-- Sticky Footer -->
				<footer class="sticky-footer">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright © Your Website 2018</span>
						</div>
					</div>
				</footer>

			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- Bootstrap core JavaScript-->
		<script src="../vendor/jquery/jquery.min.js"></script>
		<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

		<!-- Page level plugin JavaScript-->
		<!-- <script src="../vendor/chart.js/Chart.min.js"></script> -->
		<script src="../vendor/datatables/jquery.dataTables.js"></script>
		<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="../js/sb-admin.min.js"></script>

		<!-- Demo scripts for this page-->
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<!-- <script src="../js/demo/chart-area-demo.js"></script> -->

		<script type="text/javascript">
			$(document).ready(function(){
				$('table').DataTable();
				$('.btn-danger').click(function(e){
					if(!confirm("Are you sure?"))
						e.preventDefault()
				})

				$('.deletePhoto').click(function(){
					var id = $(this).attr('id');

					var r = confirm("Are you sure, you would like to delete?");
					if (r == true) {
						$.ajax({
							url:"../controller/deletePhoto.php",
							async: false,
							type: 'post',
							dataType: 'JSON',
							cache: false,
							data: { id: id },
							success: function(data){
								location.reload();
							}
						});
					}
				})

				$('.deletePhotoPlace').click(function(){
					var id = $(this).attr('id');

					var r = confirm("Are you sure, you would like to delete?");
					if (r == true) {
						$.ajax({
							url:"../controller/deletePhotoPlace.php",
							async: false,
							type: 'post',
							dataType: 'JSON',
							cache: false,
							data: { id: id },
							success: function(data){
								location.reload();
							}
						});
					}
				})

				$('.filePhotoUpload').change(function(){
					readOther(this);
				});

				var arrayFiles=[], idPhoto, counter = 0;
				function readOther(input) {
					for(var i=0; i<input.files.length; i++){
						if(input.files[i]['size'] > 5242880)
							alert("File size to big");
					}

					return false;
				}

			})
		</script>

	</body>

</html>