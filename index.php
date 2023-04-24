<?php
	session_start();
	// Redirect the user to login page if he is not logged in.
	if(!isset($_SESSION['loggedIn'])){
		header('Location: login.php');
		exit();
	}
	
	require_once('Admin/inc/config/constants.php');
	require_once('Admin/inc/config/db.php');
	require_once('inc/header.html');


?>
  <body>
<?php
	require 'inc/navigation.php';
?>
    <!-- Page Content -->
    <div class="container-fluid">
	  <div class="row">
		<div class="col-lg-2">
		<h1 class="my-4"></h1>
        <div class="nav flex-column nav-pills" id="v-pills-tab.," role="tablist" aria-orientation="vertical">
				
				<a class="nav-link active" id="v-pills-sale-tab"  href="#v-pills-sale" role="tab" aria-controls="v-pills-sale" aria-selected="false">Sale</a>

		</div>
		<img src="mlogo.png" alt="" width="80%">
		</div>
		 <div class="col-lg-10">
		<div class="card card-outline-secondary my-4">
				  <div class="card-header">Sale Details</div>
				  <div class="card-body">
					<div id="saleDetailsMessage"></div>
					<form>
					  <div class="form-row">
					  <div class="form-group col-md-2">
						  <label for="saleDetailsUser">User In Charge</label>
						  <input type="text" class="form-control invTooltip" id="saleDetailsUser" name="saleDetailsUser" readonly value="<?php echo $_SESSION['user_name'] ?>">
						  
						</div>
							<div class="form-group col-md-2">
							<label for="saleDetailsItemNumber">Select Item<span class="requiredIcon">*</span></label>
										<select id="saleDetailsItemNumber" name="saleDetailsItemNumber" class="form-control chosenSelect">
										<option value="">Select Item</option>
											<?php include('model/item/itemDropdownList.php'); ?>
										</select>
							
							</div>
					
						<div class="form-group col-md-2">
						  <label for="saleDetailsSaleID">Sale ID</label>
						  <input type="text" class="form-control invTooltip" id="saleDetailsSaleID" name="saleDetailsSaleID" title="This will be auto-generated when you add a new record" autocomplete="off">
						  <div id="saleDetailsSaleIDSuggestionsDiv" class="customListDivWidth"></div>
						</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsCategoryName">Category</label>
						  <input type="text" class="form-control invTooltip" id="saleDetailsCategory" name="saleDetailsCategory" readonly>
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-2">
							<label for="saleDetailsItemName">Item Name</label>
							
							<input type="text" class="form-control invTooltip" id="saleDetailsItemName" name="saleDetailsItemName" readonly>
						  </div>
						  <!-- <div class="form-group col-md-2">
							  <label for="saleDetailsSaleDate">Sale Date<span class="requiredIcon">*</span></label>
							  <input type="text" class="form-control datepicker" id="saleDetailsSaleDate" value="2018-05-24" name="saleDetailsSaleDate" readonly>
						  </div> -->
						  <div class="form-group col-md-2">
								  <label for="saleDetailsTotalStock">Total Stock</label>
								  <input type="text" class="form-control" name="saleDetailsTotalStock" id="saleDetailsTotalStock" readonly>
								</div>
					  </div>
					  <div class="form-row">
						
						
						<div class="form-group col-md-2">
						  <label for="saleDetailsQuantity">Quantity<span class="requiredIcon">*</span></label>
						  <input type="number" class="form-control" id="saleDetailsQuantity" name="saleDetailsQuantity" value="0">
						</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsUnitPrice">Unit Price<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="saleDetailsUnitPrice" name="saleDetailsUnitPrice" value="0" readonly>
						</div>
						<div class="form-group col-md-2">
						  <label for="saleDetailsTotal">Total</label>
						  <input type="text" class="form-control" id="saleDetailsTotal" name="saleDetailsTotal">
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-3">
							<div id="saleDetailsImageContainer"></div>
						  </div>
					 </div>
					  <button type="button" id="addSaleButton" class="btn btn-success">Add Sale</button>
					  <button type="button" id="updateSaleDetailsButton" class="btn btn-primary">Update</button>
					  <button type="reset" id="saleClear" class="btn">Clear</button>
					</form>
				  </div> 
				</div>
                </div>
	  </div>
	</div>
	
		</div>
	  </div>
	  <div class="form-row">
		<div class="col-lg-2"></div>
		<div class="col-lg-10">
		<div class="card card-outline-secondary my-4">
		<div class="card-header">Sales <button id="searchTablesRefresh" name="searchTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
		<div class="card-body">
		<div class="table-responsive" id="saleDetailsTableDiv"></div>
		</div>
		</div>
		</div>
	  </div>
	  
<?php
	require 'inc/footer.php';
?>
  </body>
</html>
