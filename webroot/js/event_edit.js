$(document).ready(function() {


	// $('#date-start').pickadate({
	// 	format: 'yyyy-mm-dd',
	// 	setdate:'2017-01-01',
	// 	lang: 'ja'
	// });
	$("#date-start").datepicker();


	// $('#date-end').pickadate({
	// 	format: 'yyyy-mm-dd',
	// 	lang: 'ja'
	// });
	$("#date-end").datepicker();

	var start_day = $("#date-start").val();
	var start_time = $("#time-start").val();
	var start_fixed = start_day +' '+start_time;

	var end_day = $("#date-end").val();
	var end_time = $("#time-end").val();
	var end_fixed = end_day +' '+end_time;

	$("<input>", {
	type: 'hidden',
	name: 'start',
	value: start_fixed
	}).appendTo('#created_event');

	$("<input>", {
	type: 'hidden',
	name: 'end',
	value: end_fixed
	}).appendTo('#created_event');



});
