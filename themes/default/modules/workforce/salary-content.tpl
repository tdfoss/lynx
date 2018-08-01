<!-- BEGIN: main -->
<link rel="stylesheet" media="screen" href="{NV_ASSETS_DIR}/js/handsontable/handsontable.full.css">
<h1 class="text-center title">{TITLE}</h1>
<div id="salary-table"></div>
<script src="{NV_ASSETS_DIR}/js/handsontable/handsontable.full.js"></script>
<script>
$(document).ready(function () {
    var data = {DATA};
    var $container = $("#salary-table"); 
	var hotElementContainer = $container.parentNode;
	$container.handsontable( {
        data : data,
        rowHeaders : true,
        colHeaders : true,
        filters : true,
        columns : [ {
            data : 'fullname',
            type : 'text',
            readOnly : true
        }, {
            data : 'salary',
            type : 'text',
            readOnly : true
        }, {
            data : 'allowance',
            type : 'numeric',
            readOnly : true
        }, {
            data : 'workday',
            type : 'numeric',
            numericFormat: {
                pattern: '0.00'
            }
        }, {
            data : 'overtime',
            type : 'numeric',
            numericFormat: {
                pattern: '0.00'
            }
        }, {
            data : 'advance',
            type : 'numeric'
        }, {
            data : 'bonus',
            type : 'numeric'
        }, {
            data : 'total',
            type : 'numeric',
            readOnly : true,
            numericFormat: {
                pattern: '0,'
            }
        }, {
            data : 'deduction',
            type : 'numeric',
            numericFormat: {
                pattern: '0,'
            }
        }, {
            data : 'received',
            type : 'numeric',
            readOnly : true,
            numericFormat: {
                pattern: '0,'
            }
        } ],
        stretchH : 'all',
        colHeaders : [ 'Họ & tên', 'Lương cơ bản', 'Phụ cấp', 'Ngày công', 'Ngày làm thêm', 'Tạm ứng', 'Thưởng', 'Tổng lương', 'Các khoản trừ', 'Thực nhận' ],
        afterChange: function (changes, source) {
            if (source === 'loadData' || source === 'populateFromArray' || changes[0][1] === 'total' || changes[0][1] === 'received') {
                return;
            }
            
            $.each(changes, function(index){
                var rowThatHasBeenChanged = changes[index][0],
                columnThatHasBeenChanged = changes[index][1];
                var sourceRow = hotElement.getSourceDataAtRow(rowThatHasBeenChanged);
              
                $.ajax({
                    url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=salary-content&nocache=' + new Date().getTime(),
                    type : "POST",
                    data : {
                        save_change: 1,
                        data : sourceRow
                    },
                    success : function(json) {
                        $container.handsontable('setDataAtCell', changes[index][0], 7, json.total);
                        $container.handsontable('setDataAtCell', changes[index][0], 9, json.received);
                    }
                });                
            });
            
            $col = hotElement.getDataAtCol(7);
            var sum = $col.reduce(function(a, b) {return a + b; });
            var index = hotElement.getData().length;
            hotElement.setDataAtCell(index - 1, 7, sum);
		},
		cells: function(row, col, prop) {
		    var cellProperties = {};
		    if (row === data.length - 1) {
		        cellProperties.readOnly = true;
	        }
		    return cellProperties;
	    },
	    mergeCells: [
            {row: data.length - 1, col: 0, rowspan: 1, colspan: 5}
        ]
    });
	var hotElement = $container.data('handsontable');
});
</script>
<!-- END: main -->