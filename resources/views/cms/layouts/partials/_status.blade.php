<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Publish</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><span class="fa fa-key pub-icon"></span>Status:</label>
                    <span class="publish-time" id="status-info"></span><a class="status-btn" href="javascript:void(0)">Edit</a>
                    <span class="status-box">

                        {!! Form::select('publish',[1=>"Publish",0=>"Un-Publish"],1,['class'=>'form-control','style'=>"width: 60%;display:inline-block;",'id'=>'publish']) !!}

                        <a href="#" title="Ok" class="btn btn-primary ok-btn" id="status-ok">Ok</a>

                    <a class="close-btn" href="javascript:void(0)" class="edit-btn close-now">Cancel</a>
                  </span>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->

</div>
<!-- /.box -->