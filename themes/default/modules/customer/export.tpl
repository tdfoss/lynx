<!-- BEGIN: option -->
<form id="frm-export">
    <input type="hidden" value="1" name="submit" />
    <!-- BEGIN: data -->
    <input type="hidden" value="{DATA.value}" name="data[{DATA.index}]" />
    <!-- END: data -->
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-8">{LANG.export}</div>
        <div class="col-xs-16 col-sm-16 col-md-16">
            <!-- BEGIN: type -->
            <label class="show"><input type="radio" name="type" value="{TYPE.index}" {TYPE.checked} />{TYPE.value}</label>
            <!-- END: type -->
        </div>
    </div>
    <div class="text-center">
        <hr />
        <input type="submit" value="{LANG.export}" class="btn btn-primary" />
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#frm-export').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type : 'POST',
                url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=export&nocache=' + new Date().getTime(),
                data : $(this).serialize(),
                success : function(json) {
                    if (!json.error) {
                        window.open(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=export&download=1', '_blank');
                        $('#sitemodal').modal('toggle');
                    }
                }
            });
        });
    });
</script>
<!-- END: option -->