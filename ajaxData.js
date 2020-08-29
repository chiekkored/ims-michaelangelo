$(document).ready(function(){
$(document).on('click', '#getEmployee', function(e){
e.preventDefault();
var empid = $(this).data('id');
$('#employee-detail').hide();
$('#employee_data-loader').show();
$.ajax({
url: 'empData.php',
type: 'POST',
data: 'empid='+empid,
dataType: 'json',
cache: false
})
.done(function(data){
console.log(data.employee_name);
$('#employee-detail').hide();
$('#employee-detail').show();
$('#empid').html(data.id);
$('#emp_name').html(data.employee_name);
$('#emp_age').html(data.employee_age);
$('#emp_salary').html("$"+data.employee_salary);
$('#employee_data-loader').hide();
})
.fail(function(){
$('#employee-detail').html('Error, Please try again...');
$('#employee_data-loader').hide();
});
});
});