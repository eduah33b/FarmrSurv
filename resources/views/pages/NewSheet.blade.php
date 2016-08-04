<div class="singleFormBox row">
    <form class="homeForms" onsubmit="return SaveNewForm();" >
        
        <div class="form-group col-xs-12">
            <input class="form-control" id="FormTitle" name="FormTitle" placeholder="Form Title" required type="text">
        </div>

        <div class="form-group col-xs-12">
            <textarea class="form-control" rows="4" placeholder="Form Description" id="FormDesc" name="FormDesc"></textarea>
        </div>

        <div id="questions"></div>
        
        <div class="form-group">
            <div class="col-sx-12">
                <input value="Done" class="btn btn-primary" type="submit">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    startQ_Create();
</script>