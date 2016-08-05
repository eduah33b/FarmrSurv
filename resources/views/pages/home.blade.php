<div class="row box-1">
    <div class="col-xs-12 panel-list">
        <div class="col-lg-6 col-sm-12">
            <div class="box-2">
                <h1>Welcome to Farmer Surv</h1>
                <p>An Online Survey App</p>
                <div class="box-3">
                    <br>
                    <div class="box-4" onclick="partialNav('#MainWindow','AddSheet','Add New Form Sheet')" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Add New Survey">
                        <a>
                            <span class="glyphicon glyphicon-plus text-danger"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($FormSheets as $FormSheet)
            <div class="col-lg-3 col-sm-4 col-md-5">
                <div class="box-2">
                    <h3><a onclick="partialNav('#MainWindow','TakeSurv/{{ $FormSheet->FormSheetID }}','{{ $FormSheet->FormSheetTitle }}')">{{ $FormSheet->FormSheetTitle }}</a></h3>

                    <p>{{ $FormSheet->FormSheetDesc }}</p>
                    <div class="box-3">
                        <div class="box-4" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Take Survey" onclick="partialNav('#MainWindow','TakeSurv/{{ $FormSheet->FormSheetID }}','{{ $FormSheet->FormSheetTitle }}')"><a><span class="glyphicon glyphicon-list-alt text-warning"></span></a></div>
                        <br>
                        <div class="box-4" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Review Survey" onclick="partialNav('#MainWindow','SurvResults/{{ $FormSheet->FormSheetID }}','{{ $FormSheet->FormSheetTitle }}')"><a><span class="glyphicon glyphicon-file text-success"></span></a></div>
                        <br>
                        <div class="box-4" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Delete Survey" onclick="deleteSheet({{ $FormSheet->FormSheetID }})"><a><span class="glyphicon glyphicon-trash text-danger"></span></a></div>
                    </div>
                </div>
            </div>
        @endforeach
       
    </div>
</div>
<script type="text/javascript">
    $(function () {
      $('[data-toggle="popover"').popover();
    })
</script>