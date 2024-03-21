<link rel="stylesheet" type="text/css" href="dt/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="dt/jquery-1.12.0.min.js"></script>
<script type="text/javascript" language="javascript" src="dt/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
		$('#example').dataTable( {
		"oLanguage": {
		"sLengthMenu": "แสดง _MENU_ เร็คคอร์ด ต่อหน้า",
		"sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
		"sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
		"sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
		"sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
		"sSearch": "ค้นหา :",
		"aaSorting" :[[0,'desc']],
		"oPaginate": {
		"sFirst":    "หน้าแรก",
		"sPrevious": "ก่อนหน้า",
		"sNext":     "ถัดไป",
		"sLast":     "หน้าสุดท้าย"
		},
		}
		} );
		} );
</script>

<script src="../js/bootstrap.min.js"></script>
<!--https://datatables.net/plug-ins/i18n/Thai-->

<script>
$(document).ready(function() {
$('#example').DataTable( {
"aaSorting" :[[0,'desc']],
//"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
});
} );
</script>