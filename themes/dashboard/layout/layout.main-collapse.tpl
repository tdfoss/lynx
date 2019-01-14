<!-- BEGIN: main -->
{FILE "header_only.tpl"}
{FILE "header_extended1.tpl"}
    <section class="content">
        [SOCIAL_ICONS]
        {MODULE_CONTENT}
        <div class="row">
        <div class="col-xs-12">
        [HOME_LEFT]
        </div>
        <div class="col-xs-12">
        [HOME_RIGHT]
        </div>
        </div>
    </section>
  </div>
<!--   <button class="btn btn-default"> -->
<!--              Save -->
<!--         </button> -->
        <script>
        $(function(){
            $("#EDM").hover(
              function () {
                $(this).toggleClass('hovered');
              }, 
              function () {
                $(this).toggleClass('hovered');
              }
            );
        });
        </script>
{FILE "footer_extended.tpl"}
{FILE "footer_only.tpl"}
<!-- END: main -->
<script >
        $('#EDM').hover(
                function(){ $(this).addClass('menu-hover') },
                function(){ $(this).removeClass('menu-hover') }
         )
        </script>
