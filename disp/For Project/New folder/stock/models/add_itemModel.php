<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Item</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="./actions/__add_itemModel.php">
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">ITEM:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="50" name="item" placeholder="Enter item name" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">CATEGORY</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="20" name="category" placeholder="Enter category" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Qty</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="20" name="qty" placeholder="Enter qty" required>
                            </div>
                        </div>
						  <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Cost/Unit</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="20" name="cost_per" placeholder="Enter Cost" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">QLP No</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="255" placeholder="Enter QLP No" name="details" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">CIV No</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="30" placeholder="Enter CIV no" name="bill_no">
                            </div>
                        </div>
						 <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">DATE OF PUR</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" maxlength="30" placeholder="Date of pur" name="date_pur">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">Vendor:</label>
                            </div>
                            <div class="col-sm-10">
                                 <!--begin option-->
                                     <?php
                                     //code for fetching the suppliers' information
                                     require_once './db.php';
                                     $sql = "SELECT * FROM `supplier`";

                                     $query = $conn->query($sql);
                                     echo "<select class='form-control id='supplierName' name='supplierName'>";
                                     while($row = $query->fetch_assoc()){
                                         echo"<option value='".$row['supplier_name']."'>".$row['supplier_name']."</option>";
                                     }
                                     echo"</select>";
                                     $conn->close();
                                     ?>
                                     <!--end-->
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Add</a>
                    </form>
            </div>

        </div>
    </div>
</div>