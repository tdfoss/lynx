<!-- BEGIN: main -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <caption>{LANG.score_history_of}</caption>
        <thead>
            <tr>
                <th>{LANG.customerid}</th>
                <th>{LANG.score}</th>
                <th>{LANG.money}</th>
                <th>{LANG.invoiceid}</th>
                <th>{LANG.useradd}</th>
                <th>{LANG.addtime}</th>
                <th>{LANG.note}</th>
            </tr>
        </thead>
        <!-- BEGIN: generate_page -->
        <tfoot>
            <tr>
                <td class="text-center" colspan="10">{NV_GENERATE_PAGE}</td>
            </tr>
        </tfoot>
        <!-- END: generate_page -->
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td>{VIEW.customerid}</td>
                <td>{VIEW.score}</td>
                <td>{VIEW.money}</td>
                <td>{VIEW.invoiceid}</td>
                <td>{VIEW.useradd}</td>
                <td>{VIEW.addtime}</td>
                <td>{VIEW.note}</td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: main -->