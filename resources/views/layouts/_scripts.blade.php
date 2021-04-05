{{-- <script src="js/3.1.1.jquery.min.js"></script> --}}

{{-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script>
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
	    $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
		    todayBtn: "linked",
		    language: "es",
		    // startDate: today,
		    daysOfWeekDisabled: "0",
		    autoclose: true

    });

    	$ ('. datetimepicker'). datetimepicker ({
        formato: 'HH: mm: ss'
    });
</script>
