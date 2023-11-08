<!-- Add New -->
<div class="modal fade" id="allocate_<?php echo $row['allocate_id'] ;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Issue Item</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="./actions/__dept_allocate_itemModel.php">
                        
                                <input type="hidden" class="form-control" maxlength="20" name="allocate_id"  value="<?php echo $row['allocate_id'] ;?>">
                           <input type="hidden" class="form-control" name="item_id" value="<?php echo $row['item_id']; ?>">
                        
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">QTY:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="10" placeholder="Enter Qty" name="dept_qty_issue" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">ISSUE TO:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" maxlength="30" placeholder="Issue to" name="dept_issue_to" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label modal-label">DATE OF ISSUE:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" maxlength="30" placeholder="doi" name="doi" required>
                            </div>
                        </div>
                       
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Allocate</a></button>
                    </form>
            </div>

        </div>
    </div>
</div>