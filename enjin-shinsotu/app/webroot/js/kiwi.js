 $(document).ready(function () {
 	$('.i-checks').iCheck({
 		checkboxClass: 'icheckbox_square-green',
 		radioClass: 'iradio_square-green'
 	});

 	// datepicker dd/mm/yyyy
 	$('.data_1 .input-group.date').datepicker({
 		todayBtn: "linked",
 		keyboardNavigation: false,
 		forceParse: false,
 		calendarWeeks: true,
 		autoclose: true,
 		format: 'yyyy/mm/dd',
 	});

 	//datepicker yyyy/mm
 	$('.data_4 .input-group.date').datepicker({
 		minViewMode: 1,
 		keyboardNavigation: false,
 		forceParse: false,
 		autoclose: true,
 		todayHighlight: true,
 		format: "yyyy/mm"
 	});

 	$('#p17-show-fr-edit').click(function () {
 		$(".show-data").addClass("fr-hiden");
 		$(".show-fr-input").removeClass("fr-hiden");
 		$(".show-return").removeClass("fr-hiden");
 	});

 	$('#p17-return-edit').click(function () {
 		$(".show-return").addClass("fr-hiden");
 		$(".hiden-return").removeClass("fr-hiden");
 		$(".show-fr-input").removeClass("fr-hiden");
 	});
 	$('.p4-show-fr-edit').click(function () {
 		$(".show-data").addClass("fr-hiden");
          //$(".show-fr-input").removeClass("fr-hiden");
          $(".show-return").removeClass("fr-hiden");
      });

 	$('.p4-save-edit').click(function () {
 		$(".show-return").addClass("fr-hiden");
 		$(".edit-return").removeClass("fr-hiden");
          //$(".hiden-return").removeClass("fr-hiden");
          //$(".show-fr-input").removeClass("fr-hiden");    
      });
 	$('.p4-edit-return').click(function () {
 		$(".edit-return").addClass("fr-hiden");
 		$(".hiden-return").removeClass("fr-hiden");
          //$(".show-fr-input").removeClass("fr-hiden");    
      });
    

 });
