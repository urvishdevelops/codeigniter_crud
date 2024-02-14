<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CI crud</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
	<nav class="navbar navbar-expand-lg bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Navbar</a>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-link text-light" href="#">Products</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="container mt-5 col-6 md-5">
		<div class="card p-5">
			<div class="card-body">
				<form onsubmit="return false" method="POST" id="my-form" enctype="multipart/form-data">
					<input type="hidden" name="hidden_id" id="hidden_id">
					<div class="mb-3">
						<label for="name">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
					</div>

					<div class="mb-3">
						<label for="book">Book</label>
						<input type="text" class="form-control" name="book" id="book" placeholder="Enter book">
					</div>

					<div class="mb-3">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
					</div>

					<div class="mb-3">
						<button type="submit" class="btn btn-primary mt-3" id="submit"
							value="Add Student">Submit</button>
					</div>
				</form>
			</div>
			<span id="output"></span>
		</div>
	</div>

	<div class="container mt-5">
		<h2>Author's Table</h2>
		<table class="table table-bordered" id='table'>
			<thead>
				<tr>
					<th>Sr.no</th>
					<th>Name</th>
					<th>Course</th>
					<th>Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="tbody">
</body>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.js"></script>
<script>
	$(document).ready(function () {
		$("#my-form").submit(function (e) {
			e.preventDefault();

			$.ajax({
				type: "POST",
				url: 'http://localhost:8000/welcome/insert',
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				success: function (data) {

					$('#output').text(data)
					$('#my-form')[0].reset();

				},
			})
		})

		var table = $('#table').DataTable({
			searching: true,
			paging: true,
			pageLength: 10,
			ajax: {
				url: 'http://localhost:8000/welcome/listing',
				type: 'GET',
				dataType: 'json',
			},
			columns: [{
				data: 'id'
			},
			{
				data: 'name'
			},
			{
				data: 'book'
			},
			{
				data: 'email'
			},
			{
				data: 'action'
			},
			]

		});


		$(document).on('click', '.edit', function () {
			let editId = this.getAttribute('id');
		
		})


		$(document).on('click', '.delete', function () {
			let deleteId = this.getAttribute('id');
			$.ajax({
				type: "POST",
				url: 'http://localhost:8000/welcome/delete',
				data: deleteId,
				success: function (data) {
					$('#output').text(data)
					$('#my-form')[0].reset();
				},
			})
		})


	})
</script>

</html>