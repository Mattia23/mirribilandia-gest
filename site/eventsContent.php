<?php
	echo '<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Add new event</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
			<!-- text input -->
               <div class="form-group">
                  <label>Event title</label>
                  <input type="text" class="form-control" placeholder="Enter title...">
              </div>
              <div class="form-group">
                <label>Attraction</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
              
            </div>
            <!-- /.col -->
            <div class="col-md-6">
			<div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="3" placeholder="Enter description..."></textarea>
                </div>
              <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
			  <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Time:</label>

                  <div class="input-group">
                    <input type="text" class="form-control timepicker">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          footer
        </div>
      </div>
      <!-- /.box -->

    </section>';
?>