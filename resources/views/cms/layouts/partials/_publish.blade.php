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

                <div class="form-group status-bar">
                    <label><span class="fa fa-calendar pub-icon"></span>Publish On:</label>
                    <span class="publish-time" id="date-info"></span><a class="edit-btn" href="javascript:void(0)">Edit</a>

                    <span class="edit-news">
                        {!! Form::select('month',getMonths(),null,['class'=>'form-control month','id'=>'month']) !!}


                        {!! Form::select('day',getDays(),null,['class'=>'form-control days','id'=>'day']) !!}


                        {!! Form::text('year',null,['class'=>'form-control years','id'=>'year']) !!}


                        <span class="form-control time-count">&#64;</span>
                        {!! Form::text('hour',null,['class'=>'form-control times','id'=>'hour','size'=>4,'maxlenght'=>4]) !!}

                        <span class="form-control time-count">:</span>

                        {!! Form::text('minute',null,['class'=>'form-control times','id'=>'minute','size'=>4,'maxlenght'=>4]) !!}

                        <a href="#" title="Ok" class="btn btn-primary ok-btn" id="publishDate-ok">Ok</a>
                    <a href="javascript:void(0)" class="close-edit-btn">Cancel</a>
                  </span>
                    {{--<span class="update-box"><a href="#" title="Update" class="btn btn-primary">Update</a></span>--}}
                </div>
                <!-- /.form-group -->

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->

</div>
<!-- /.box -->